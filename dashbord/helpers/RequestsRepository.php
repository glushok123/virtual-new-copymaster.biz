<?php
/**
 * Заявки с сайта (таблица zayavki) для страницы «Заявки → Обработка» (dashbord/index.php).
 * Все запросы — подготовленные (MysqliDb::rawQuery с параметрами). Совместимо с PHP 7.1.
 *
 * Особенности данных:
 *  - created_at — строка: у старых заявок «Y-m-d H:i:s», у новых «d.m.y H:i» (так пишет registerz.php);
 *  - порядок id совпадает с порядком создания, поэтому сортируем по id;
 *  - статус «Новая» вычисляется: status = «Активна» и заявку ещё не сохраняли (updated_at IS NULL).
 */
class RequestsApiError extends Exception
{
	public $httpStatus;
	public $payload;

	public function __construct($message, $httpStatus = 400, array $payload = [])
	{
		parent::__construct($message);
		$this->httpStatus = $httpStatus;
		$this->payload = $payload;
	}
}

class RequestsRepository
{
	const TABLE = 'zayavki';
	const MAX_LIMIT = 100;
	const MAX_BULK = 5000;

	/** @var MysqliDb */
	private $db;
	private $config;
	private $docRoot;
	private $tipToKey = [];

	public function __construct($db, array $config, $docRoot = null)
	{
		$this->db = $db;
		$this->config = $config;
		$this->docRoot = $docRoot ? rtrim(str_replace('\\', '/', $docRoot), '/') : null;
		foreach ($config['types'] as $key => $type) {
			$this->tipToKey[$type['tip']] = $key;
		}
	}

	// ── фильтры ─────────────────────────────────────────────

	/** Приводит параметры запроса к допустимым значениям (всё неизвестное — отбрасывается). */
	public function normalizeFilters(array $in)
	{
		$status = isset($in['status']) ? (string)$in['status'] : 'all';
		if ($status !== 'all' && $status !== 'open' && $status !== 'done' && !isset($this->config['statuses'][$status])) {
			$status = 'all';
		}
		$type = isset($in['type']) ? (string)$in['type'] : '';
		if ($type !== '' && $type !== 'other' && !isset($this->config['types'][$type])) {
			$type = '';
		}
		$search = isset($in['search']) ? trim(self::cleanText((string)$in['search'])) : '';
		if (self::length($search) > 100) {
			$search = '';
		}
		return [
			'status' => $status,
			'type' => $type,
			'search' => $search,
			'from' => self::validDate(isset($in['from']) ? $in['from'] : ''),
			'to' => self::validDate(isset($in['to']) ? $in['to'] : ''),
			'sort' => isset($in['sort']) && $in['sort'] === 'old' ? 'old' : 'new',
		];
	}

	private static function validDate($value)
	{
		$value = (string)$value;
		$date = DateTime::createFromFormat('!Y-m-d', $value);
		return $date && $date->format('Y-m-d') === $value ? $value : null;
	}

	/** Дата создания как DATETIME (два формата строки в created_at). */
	private function createdSql()
	{
		return "(CASE WHEN created_at LIKE '____-__-__%' THEN STR_TO_DATE(LEFT(created_at, 19), '%Y-%m-%d %H:%i:%s')"
			. " ELSE STR_TO_DATE(created_at, '%d.%m.%y %H:%i') END)";
	}

	/** Ключ статуса (new/active/wait/…) выражением SQL. Значения — константы из конфига. */
	private function statusSql()
	{
		$sql = 'CASE';
		foreach ($this->config['statuses'] as $key => $status) {
			if ($status['db'] !== $this->config['statuses']['new']['db']) {
				$sql .= " WHEN status = '" . addslashes($status['db']) . "' THEN '" . addslashes($key) . "'";
			}
		}
		return $sql . " WHEN updated_at IS NULL THEN 'new' ELSE 'active' END";
	}

	private function openKeys($open)
	{
		$keys = [];
		foreach ($this->config['statuses'] as $key => $status) {
			if ($status['open'] === $open) {
				$keys[] = $key;
			}
		}
		return $keys;
	}

	/**
	 * WHERE по фильтрам. $skip — какой фильтр не учитывать (для счётчиков чипов).
	 * @return array [sql, params]
	 */
	private function buildWhere(array $f, $skip = null)
	{
		$parts = [];
		$params = [];

		if ($skip !== 'status' && $f['status'] !== 'all') {
			$keys = $f['status'] === 'open' ? $this->openKeys(true) : ($f['status'] === 'done' ? $this->openKeys(false) : [$f['status']]);
			$parts[] = $this->statusSql() . ' IN (' . implode(',', array_fill(0, count($keys), '?')) . ')';
			$params = array_merge($params, $keys);
		}

		if ($skip !== 'type' && $f['type'] !== '') {
			$tips = array_keys($this->tipToKey);
			if ($f['type'] === 'other') {
				$parts[] = 'tip NOT IN (' . implode(',', array_fill(0, count($tips), '?')) . ')';
				$params = array_merge($params, $tips);
			} else {
				$parts[] = 'tip = ?';
				$params[] = $this->config['types'][$f['type']]['tip'];
			}
		}

		if ($f['from']) {
			$parts[] = $this->createdSql() . ' >= ?';
			$params[] = $f['from'] . ' 00:00:00';
		}
		if ($f['to']) {
			$parts[] = $this->createdSql() . ' < ?';
			$params[] = date('Y-m-d', strtotime($f['to'] . ' +1 day')) . ' 00:00:00';
		}

		if ($f['search'] !== '') {
			list($sql, $searchParams) = $this->searchWhere($f['search']);
			$parts[] = $sql;
			$params = array_merge($params, $searchParams);
		}

		return [$parts ? 'WHERE ' . implode(' AND ', $parts) : '', $params];
	}

	private static function like($value)
	{
		return '%' . addcslashes($value, '%_\\') . '%';
	}

	/** Поиск: номер заявки, телефон (по цифрам), имя, email, комментарий, цена, параметры заказа. */
	private function searchWhere($search)
	{
		$compact = preg_replace('/[\s()+\-.#№]/u', '', $search);
		if ($compact !== '' && ctype_digit($compact)) {
			$or = [];
			$params = [];
			if (strlen($compact) <= 7) {
				$or[] = 'id = ?';
				$params[] = (int)$compact;
			}
			if (strlen($compact) >= 3) {
				$digits = strlen($compact) >= 10 ? substr($compact, -10) : $compact;
				$or[] = "REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(phon, ' ', ''), '-', ''), '(', ''), ')', ''), '+', ''), '.', '') LIKE ?";
				$params[] = self::like($digits);
				$or[] = 'comment LIKE ?';
				$params[] = self::like($compact);
				$or[] = 'price LIKE ?';
				$params[] = self::like($compact);
			}
			return ['(' . implode(' OR ', $or) . ')', $params];
		}

		$and = [];
		$params = [];
		$words = preg_split('/\s+/u', $search, 5, PREG_SPLIT_NO_EMPTY);
		foreach (array_slice($words, 0, 4) as $word) {
			$like = self::like($word);
			$and[] = '(name LIKE ? OR email LIKE ? OR phon LIKE ? OR comment LIKE ? OR price LIKE ? OR kwiz_vid LIKE ? OR info LIKE ?)';
			array_push($params, $like, $like, $like, $like, $like, $like, $like);
		}
		return ['(' . implode(' AND ', $and) . ')', $params];
	}

	private function query($sql, array $params = [])
	{
		$rows = $params ? $this->db->rawQuery($sql, $params) : $this->db->rawQuery($sql);
		$error = $this->db->getLastError();
		if ($error) {
			throw new Exception('DB: ' . $error);
		}
		return is_array($rows) ? $rows : [];
	}

	// ── чтение ──────────────────────────────────────────────

	public function listRequests(array $filters, $page, $limit)
	{
		$f = $this->normalizeFilters($filters);
		$limit = max(10, min(self::MAX_LIMIT, (int)$limit ?: 40));
		$page = max(1, (int)$page);

		list($where, $params) = $this->buildWhere($f);
		$total = $this->query('SELECT COUNT(*) AS n FROM ' . self::TABLE . ' ' . $where, $params);
		$total = $total ? (int)$total[0]['n'] : 0;

		$order = $f['sort'] === 'old' ? 'ASC' : 'DESC';
		$rows = $this->query(
			'SELECT * FROM ' . self::TABLE . ' ' . $where . ' ORDER BY id ' . $order . ' LIMIT ?, ?',
			array_merge($params, [($page - 1) * $limit, $limit])
		);

		return [
			'items' => array_map([$this, 'formatRow'], $rows),
			'total' => $total,
			'page' => $page,
			'limit' => $limit,
			'pages' => (int)ceil($total / $limit),
			'filters' => $f,
			'counts' => $this->counts($f),
			'maxId' => $this->maxId(),
			'now' => date('Y-m-d H:i:s'),
		];
	}

	/** Счётчики для чипов: по статусам (с учётом остальных фильтров) и по типам. */
	public function counts(array $f)
	{
		$status = array_fill_keys(array_keys($this->config['statuses']), 0);
		list($where, $params) = $this->buildWhere($f, 'status');
		foreach ($this->query('SELECT ' . $this->statusSql() . ' AS s, COUNT(*) AS n FROM ' . self::TABLE . ' ' . $where . ' GROUP BY s', $params) as $row) {
			if (isset($status[$row['s']])) {
				$status[$row['s']] += (int)$row['n'];
			}
		}
		$status['open'] = 0;
		$status['done'] = 0;
		foreach ($this->config['statuses'] as $key => $info) {
			$status[$info['open'] ? 'open' : 'done'] += $status[$key];
		}
		$status['all'] = $status['open'] + $status['done'];

		$types = array_fill_keys(array_keys($this->config['types']), 0);
		$types['other'] = 0;
		list($where, $params) = $this->buildWhere($f, 'type');
		foreach ($this->query('SELECT tip, COUNT(*) AS n FROM ' . self::TABLE . ' ' . $where . ' GROUP BY tip', $params) as $row) {
			$key = isset($this->tipToKey[$row['tip']]) ? $this->tipToKey[$row['tip']] : 'other';
			$types[$key] += (int)$row['n'];
		}
		$types['all'] = array_sum($types);

		return ['status' => $status, 'type' => $types];
	}

	public function maxId()
	{
		$row = $this->query('SELECT MAX(id) AS m FROM ' . self::TABLE);
		return $row ? (int)$row[0]['m'] : 0;
	}

	/** Новые заявки после $since — для автообновления. */
	public function poll($since)
	{
		$since = max(0, (int)$since);
		$count = $this->query('SELECT COUNT(*) AS n FROM ' . self::TABLE . ' WHERE id > ?', [$since]);
		$latest = $this->query('SELECT id, tip, name FROM ' . self::TABLE . ' WHERE id > ? ORDER BY id DESC LIMIT 5', [$since]);
		$items = [];
		foreach ($latest as $row) {
			$type = $this->typeOf($row['tip']);
			$items[] = ['id' => (int)$row['id'], 'typeLabel' => $type['label'], 'name' => trim((string)$row['name'])];
		}
		return ['maxId' => $this->maxId(), 'fresh' => $count ? (int)$count[0]['n'] : 0, 'latest' => $items, 'now' => date('Y-m-d H:i:s')];
	}

	/** Все id по фильтрам — для «выбрать всё» перед массовой сменой статуса. */
	public function ids(array $filters)
	{
		$f = $this->normalizeFilters($filters);
		list($where, $params) = $this->buildWhere($f);
		$rows = $this->query('SELECT id FROM ' . self::TABLE . ' ' . $where . ' ORDER BY id DESC LIMIT ' . self::MAX_BULK, $params);
		return array_map(function ($row) { return (int)$row['id']; }, $rows);
	}

	public function findRow($id)
	{
		$rows = $this->query('SELECT * FROM ' . self::TABLE . ' WHERE id = ? LIMIT 1', [(int)$id]);
		return $rows ? $rows[0] : null;
	}

	public function find($id)
	{
		$row = $this->findRow($id);
		return $row ? $this->formatRow($row) : null;
	}

	/** Строки для CSV по фильтрам. */
	public function exportRows(array $filters)
	{
		$f = $this->normalizeFilters($filters);
		list($where, $params) = $this->buildWhere($f);
		$order = $f['sort'] === 'old' ? 'ASC' : 'DESC';
		$rows = $this->query('SELECT * FROM ' . self::TABLE . ' ' . $where . ' ORDER BY id ' . $order . ' LIMIT 20000', $params);
		$out = [['№', 'Создана', 'Тип', 'Статус', 'Имя', 'Телефон', 'Email', 'Цена', 'Комментарий', 'Параметры', 'Изменена']];
		foreach ($rows as $row) {
			$item = $this->formatRow($row);
			$params = [];
			foreach ($item['fields'] as $field) {
				if ($field['value'] !== '') {
					$params[] = ($field['group'] ? $field['group'] . ', ' : '') . $field['label'] . ': ' . $field['value'];
				}
			}
			$out[] = [
				$item['id'], $item['created'] ?: $item['createdRaw'], $item['typeLabel'], $this->config['statuses'][$item['status']]['label'],
				$item['name'], $item['phone'], $item['email'], $item['price'], $item['comment'], implode('; ', $params), (string)$item['updated'],
			];
		}
		return $out;
	}

	// ── запись ──────────────────────────────────────────────

	/**
	 * Сохранение заявки: status (ключ, кроме new), price, comment, fields{key: value} — только редактируемые параметры типа.
	 * expectedUpdated — updated_at, который видел сотрудник; если заявку уже изменили — 409.
	 */
	public function update($id, array $input)
	{
		$id = (int)$id;
		$row = $id > 0 ? $this->findRow($id) : null;
		if (!$row) {
			throw new RequestsApiError('Заявка не найдена', 404);
		}

		if (array_key_exists('expectedUpdated', $input)) {
			$expected = $input['expectedUpdated'] === null ? '' : (string)$input['expectedUpdated'];
			if ($expected !== (string)$row['updated_at']) {
				throw new RequestsApiError('Заявку уже изменил другой сотрудник — загружена свежая версия', 409, ['item' => $this->formatRow($row)]);
			}
		}

		$set = [];
		$params = [];

		if (isset($input['status']) && $input['status'] !== '') {
			$status = (string)$input['status'];
			if ($status === 'new' || !isset($this->config['statuses'][$status])) {
				throw new RequestsApiError('Недопустимый статус', 422);
			}
			$set[] = 'status = ?';
			$params[] = $this->config['statuses'][$status]['db'];
		}

		foreach (['price' => 100, 'comment' => 1000] as $column => $max) {
			if (!array_key_exists($column, $input) || $input[$column] === null) {
				continue;
			}
			if (!is_scalar($input[$column])) {
				throw new RequestsApiError('Некорректное поле ' . $column, 422);
			}
			$value = trim(self::cleanText((string)$input[$column], $column === 'comment'));
			if (self::length($value) > $max) {
				throw new RequestsApiError(($column === 'price' ? 'Цена' : 'Комментарий') . ': не больше ' . $max . ' символов', 422);
			}
			$set[] = $column . ' = ?';
			$params[] = $value;
		}

		if (isset($input['fields'])) {
			if (!is_array($input['fields'])) {
				throw new RequestsApiError('Некорректные параметры заказа', 422);
			}
			$info = $this->mergeInfo($row, $input['fields']);
			if ($info !== null) {
				$set[] = 'info = ?';
				$params[] = $info;
			}
		}

		$set[] = 'updated_at = ?';
		$params[] = date('Y-m-d H:i:s');
		$params[] = $id;

		$this->query('UPDATE ' . self::TABLE . ' SET ' . implode(', ', $set) . ' WHERE id = ?', $params);
		return $this->find($id);
	}

	/** Новое значение колонки info с изменёнными параметрами (null — параметры не менялись). */
	private function mergeInfo(array $row, array $fields)
	{
		$type = $this->typeOf($row['tip']);
		$info = self::parseInfo($row['info']);
		if (!is_array($info)) {
			$info = [];
		}
		$changed = false;

		foreach ($fields as $key => $value) {
			$def = null;
			foreach ($type['fields'] as $field) {
				if ($field['key'] === (string)$key) {
					$def = $field;
				}
			}
			if (!$def || empty($def['edit']) || $def['src'][0] !== 'info') {
				throw new RequestsApiError('Параметр «' . self::cleanText((string)$key) . '» нельзя изменить', 422);
			}
			if (!is_scalar($value) && $value !== null) {
				throw new RequestsApiError('Некорректное значение: ' . $def['label'], 422);
			}
			$value = trim(self::cleanText((string)$value));
			$index = $def['src'][1];
			$current = isset($info[$index]) ? (string)$info[$index] : '';

			if ($def['kind'] === 'select') {
				if ($value !== $current && !isset($def['options'][$value])) {
					throw new RequestsApiError('Недопустимое значение: ' . $def['label'], 422);
				}
			} elseif ($def['kind'] === 'number') {
				if (!preg_match('/^\d{0,7}$/', $value)) {
					throw new RequestsApiError($def['label'] . ': только целое число', 422);
				}
			} elseif (self::length($value) > 200) {
				throw new RequestsApiError($def['label'] . ': не больше 200 символов', 422);
			}

			if ($value !== $current || !array_key_exists($index, $info)) {
				$info[$index] = $value;
				$changed = true;
			}
		}

		if (!$changed) {
			return null;
		}
		// Массив без «дыр», порядок индексов как при создании заявки.
		$max = max(array_keys($info));
		for ($i = 0; $i <= $max; $i++) {
			if (!array_key_exists($i, $info)) {
				$info[$i] = '';
			}
		}
		ksort($info);
		$serialized = serialize($info);
		if (strlen($serialized) > 5000) {
			throw new RequestsApiError('Слишком длинные параметры заказа', 422);
		}
		return $serialized;
	}

	/** Массовая смена статуса. */
	public function bulkStatus($ids, $status)
	{
		$status = (string)$status;
		if ($status === 'new' || !isset($this->config['statuses'][$status])) {
			throw new RequestsApiError('Недопустимый статус', 422);
		}
		if (!is_array($ids) || !$ids) {
			throw new RequestsApiError('Не выбраны заявки', 422);
		}
		$clean = [];
		foreach ($ids as $id) {
			if (!is_int($id) && !(is_string($id) && ctype_digit($id))) {
				throw new RequestsApiError('Некорректный номер заявки', 422);
			}
			if ((int)$id > 0) {
				$clean[(int)$id] = true;
			}
		}
		$clean = array_keys($clean);
		if (!$clean || count($clean) > self::MAX_BULK) {
			throw new RequestsApiError('Можно изменить от 1 до ' . self::MAX_BULK . ' заявок за раз', 422);
		}

		$updated = 0;
		$now = date('Y-m-d H:i:s');
		foreach (array_chunk($clean, 500) as $chunk) {
			$this->query(
				'UPDATE ' . self::TABLE . ' SET status = ?, updated_at = ? WHERE id IN (' . implode(',', array_fill(0, count($chunk), '?')) . ')',
				array_merge([$this->config['statuses'][$status]['db'], $now], $chunk)
			);
			$updated += max(0, (int)$this->db->count);
		}
		return $updated;
	}

	public function delete($id)
	{
		$id = (int)$id;
		if ($id <= 0 || !$this->findRow($id)) {
			throw new RequestsApiError('Заявка не найдена', 404);
		}
		$this->query('DELETE FROM ' . self::TABLE . ' WHERE id = ?', [$id]);
		return true;
	}

	// ── форматирование ──────────────────────────────────────

	private function typeOf($tip)
	{
		$tip = (string)$tip;
		if (isset($this->tipToKey[$tip])) {
			$key = $this->tipToKey[$tip];
			return ['key' => $key] + $this->config['types'][$key];
		}
		return ['key' => 'other', 'tip' => $tip, 'label' => trim(strip_tags($tip)) ?: 'Без типа', 'icon' => 'bx-help-circle', 'fields' => [], 'summary' => []];
	}

	private static function parseInfo($info)
	{
		if (!is_string($info) || strncmp($info, 'a:', 2) !== 0) {
			return null;
		}
		$value = @unserialize($info, ['allowed_classes' => false]);
		return is_array($value) ? $value : null;
	}

	public function formatRow(array $row)
	{
		$type = $this->typeOf($row['tip']);
		$info = self::parseInfo(isset($row['info']) ? $row['info'] : null);
		$comment = (string)$row['comment'];

		$fields = [];
		$urgent = false;
		$byKey = [];
		foreach ($type['fields'] as $def) {
			$raw = $this->sourceValue($def['src'], $row, $info, $comment);
			$value = $raw;
			if (isset($def['options'][$raw])) {
				$value = $def['options'][$raw];
			}
			if ($value !== '' && isset($def['suffix'])) {
				$value .= $def['suffix'];
			}
			if ($value !== '' && isset($def['prefix'])) {
				$value = $def['prefix'] . $value;
			}
			if (!empty($def['urgent']) && in_array($raw, $def['urgent'], true)) {
				$urgent = true;
			}
			$field = [
				'key' => $def['key'],
				'label' => $def['label'],
				'group' => isset($def['group']) ? $def['group'] : '',
				'value' => $value,
				'raw' => $raw,
			];
			$fields[] = $field;
			$byKey[$def['key']] = $field;
		}

		$summary = [];
		foreach ($type['summary'] as $key) {
			if (isset($byKey[$key]) && $byKey[$key]['value'] !== '' && $byKey[$key]['value'] !== '0') {
				$summary[] = $byKey[$key]['value'];
			}
		}

		$files = [];
		if (!empty($type['files'])) {
			foreach ($type['files'] as $def) {
				$file = $this->fileInfo($def, $row, $info);
				if ($file) {
					$files[] = $file;
				}
			}
		}

		$phone = trim((string)$row['phon']);
		$email = trim((string)$row['email']);
		$statusKey = $this->statusKey($row['status'], $row['updated_at']);

		return [
			'id' => (int)$row['id'],
			'type' => $type['key'],
			'typeLabel' => $type['label'],
			'tip' => (string)$row['tip'],
			'name' => trim((string)$row['name']),
			'phone' => $phone,
			'phoneHref' => self::phoneHref($phone),
			'email' => $email,
			'emailValid' => (bool)filter_var($email, FILTER_VALIDATE_EMAIL),
			'status' => $statusKey,
			'statusRaw' => (string)$row['status'],
			'price' => (string)$row['price'],
			'comment' => $comment,
			'clientComment' => !empty($type['clientComment']),
			'created' => self::createdValue($row['created_at']),
			'createdRaw' => (string)$row['created_at'],
			'updated' => $row['updated_at'] ? substr((string)$row['updated_at'], 0, 19) : null,
			'urgent' => $urgent,
			'summary' => implode(' · ', $summary),
			'fields' => $fields,
			'files' => $files,
		];
	}

	private function statusKey($status, $updated)
	{
		foreach ($this->config['statuses'] as $key => $info) {
			if ($key !== 'new' && $key !== 'active' && $info['db'] === $status) {
				return $key;
			}
		}
		return $updated ? 'active' : 'new';
	}

	private function sourceValue(array $src, array $row, $info, $comment)
	{
		switch ($src[0]) {
			case 'info':
				return is_array($info) && isset($info[$src[1]]) && is_scalar($info[$src[1]]) ? trim((string)$info[$src[1]]) : '';
			case 'col':
				$value = isset($row[$src[1]]) ? trim((string)$row[$src[1]]) : '';
				return $value === '0' ? '' : $value;
			case 'assoc':
				return is_array($info) && isset($info[$src[1]]) && is_scalar($info[$src[1]]) ? trim((string)$info[$src[1]]) : '';
			case 'check':
				return preg_match('/№\s*(\d+)/u', $comment, $m) ? $m[1] : '';
		}
		return '';
	}

	/** Ссылка на файл заявки: только пути сайта или http(s); для локальных — есть ли файл и его размер. */
	private function fileInfo(array $def, array $row, $info)
	{
		$src = $def['src'];
		$path = '';
		if ($src[0] === 'info') {
			$path = is_array($info) && isset($info[$src[1]]) && is_string($info[$src[1]]) ? $info[$src[1]] : '';
		} elseif ($src[0] === 'assocList') {
			$path = is_array($info) && isset($info[$src[1]][$src[2]]) && is_string($info[$src[1]][$src[2]]) ? $info[$src[1]][$src[2]] : '';
		}
		$path = trim($path);
		if ($path === '') {
			return null;
		}
		if (!empty($def['png'])) {
			$path = preg_replace('/\.jpe?g$/i', '.png', $path);
		}

		$external = (bool)preg_match('~^https?://~i', $path);
		$url = $external ? $path : (isset($def['prefix']) ? $def['prefix'] : '') . $path;
		if (!$external) {
			$url = '/' . ltrim($url, '/');
		}
		if (strpos($url, '..') !== false || preg_match('/[\x00-\x1F"<>\\\\]/', $url)) {
			return null;
		}

		$ext = strtolower(pathinfo(parse_url($url, PHP_URL_PATH) ?: '', PATHINFO_EXTENSION));
		$exists = null;
		$size = null;
		if (!$external) {
			if ($ext === '' || $ext === 'undefined') {
				$exists = false;
			} elseif ($this->docRoot) {
				$file = $this->docRoot . $url;
				$exists = is_file($file) && filesize($file) > 0;
				$size = $exists ? filesize($file) : null;
			}
		}

		return [
			'label' => $def['label'],
			'url' => $url,
			'name' => basename(parse_url($url, PHP_URL_PATH) ?: $url),
			'ext' => $ext,
			'image' => in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true),
			'exists' => $exists,
			'size' => $size,
		];
	}

	private static function createdValue($value)
	{
		$value = trim((string)$value);
		if (preg_match('/^(\d{4})-(\d{2})-(\d{2})[ T](\d{2}):(\d{2})/', $value, $m)) {
			return "$m[1]-$m[2]-$m[3] $m[4]:$m[5]";
		}
		if (preg_match('/^(\d{2})\.(\d{2})\.(\d{2}) (\d{2}):(\d{2})/', $value, $m)) {
			return "20$m[3]-$m[2]-$m[1] $m[4]:$m[5]";
		}
		return null;
	}

	private static function phoneHref($phone)
	{
		$digits = preg_replace('/\D+/', '', $phone);
		$len = strlen($digits);
		if ($len === 11 && ($digits[0] === '8' || $digits[0] === '7')) {
			return '+7' . substr($digits, 1);
		}
		if ($len === 10 && $digits[0] === '9') {
			return '+7' . $digits;
		}
		if ($len >= 5 && $len <= 15) {
			return (strpos(ltrim($phone), '+') === 0 ? '+' : '') . $digits;
		}
		return '';
	}

	/** Убирает управляющие символы (кроме переводов строк, если $multiline) и невалидный UTF-8. */
	private static function cleanText($value, $multiline = false)
	{
		if (!preg_match('//u', $value)) {
			$value = function_exists('mb_convert_encoding') ? mb_convert_encoding($value, 'UTF-8', 'UTF-8') : '';
		}
		$pattern = $multiline ? '/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/u' : '/[\x00-\x1F\x7F]/u';
		return (string)preg_replace($pattern, $multiline ? '' : ' ', $value);
	}

	private static function length($value)
	{
		return preg_match_all('/./us', $value);
	}
}
