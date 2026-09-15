<?php
/**
 * REST API заявок для страницы «Заявки → Обработка» (dashbord/index.php). Только для авторизованных сотрудников.
 *
 *   GET    api/requests/?status=&type=&search=&from=&to=&sort=&page=&limit=  — список + счётчики
 *   GET    api/requests/{id}                 — одна заявка
 *   GET    api/requests/poll?since={id}      — сколько пришло новых заявок (автообновление)
 *   GET    api/requests/ids?фильтры          — все id по фильтрам (выбрать всё)
 *   GET    api/requests/export?фильтры       — CSV
 *   PUT    api/requests/{id}   JSON {status, price, comment, fields{}, expectedUpdated}
 *   POST   api/requests/bulk   JSON {ids: [], status}
 *   DELETE api/requests/{id}
 *
 * Изменяющие запросы требуют заголовок X-Requested-With: XMLHttpRequest (защита от CSRF: такой запрос
 * с чужого сайта невозможен без CORS-preflight, а CORS не разрешён).
 * Поиск передаётся параметром search: параметр q занят роутингом (api/.htaccess).
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require_once __DIR__ . '/../../helpers/RequestsRepository.php';

/**
 * Обработка запроса без побочного вывода — удобно тестировать.
 * @param callable $repoFactory function(): RequestsRepository
 * @return array [httpStatus, data] — data: массив для JSON или ['csv' => rows]
 */
function requestsHandle($method, array $urlData, array $query, $body, array $session, array $server, $repoFactory)
{
	if (empty($session['user_logged_in'])) {
		return [401, ['error' => 'Необходимо авторизоваться']];
	}
	if ($method !== 'GET') {
		$xrw = isset($server['HTTP_X_REQUESTED_WITH']) ? strtolower($server['HTTP_X_REQUESTED_WITH']) : '';
		if ($xrw !== 'xmlhttprequest') {
			return [403, ['error' => 'Запрос отклонён']];
		}
	}

	$action = isset($urlData[0]) ? (string)$urlData[0] : '';
	if (count($urlData) > 1) {
		return [404, ['error' => 'Не найдено']];
	}
	$isId = $action !== '' && ctype_digit($action) && strlen($action) <= 9;

	$json = null;
	if ($method === 'PUT' || $method === 'POST') {
		$json = json_decode((string)$body, true);
		if (!is_array($json)) {
			return [400, ['error' => 'Ожидается JSON']];
		}
	}

	try {
		/** @var RequestsRepository $repo */
		$repo = $repoFactory();

		if ($method === 'GET') {
			if ($action === '') {
				$page = isset($query['page']) ? (int)$query['page'] : 1;
				$limit = isset($query['limit']) ? (int)$query['limit'] : 40;
				return [200, $repo->listRequests($query, $page, $limit)];
			}
			if ($action === 'poll') {
				return [200, $repo->poll(isset($query['since']) ? $query['since'] : 0)];
			}
			if ($action === 'ids') {
				return [200, ['ids' => $repo->ids($query)]];
			}
			if ($action === 'export') {
				return [200, ['csv' => $repo->exportRows($query)]];
			}
			if ($isId) {
				$item = $repo->find((int)$action);
				return $item ? [200, ['item' => $item]] : [404, ['error' => 'Заявка не найдена']];
			}
			return [404, ['error' => 'Не найдено']];
		}

		if ($method === 'PUT' && $isId) {
			return [200, ['item' => $repo->update((int)$action, $json)]];
		}

		if ($method === 'POST' && $action === 'bulk') {
			$updated = $repo->bulkStatus(isset($json['ids']) ? $json['ids'] : null, isset($json['status']) ? $json['status'] : '');
			return [200, ['updated' => $updated]];
		}

		if ($method === 'DELETE' && $isId) {
			$repo->delete((int)$action);
			return [200, ['deleted' => (int)$action]];
		}

		return [405, ['error' => 'Метод не поддерживается']];
	} catch (RequestsApiError $e) {
		return [$e->httpStatus, ['error' => $e->getMessage()] + $e->payload];
	} catch (Exception $e) {
		error_log('api/requests: ' . $e->getMessage());
		return [500, ['error' => 'Ошибка сервера']];
	}
}

function route($method, $urlData, $formData)
{
	ini_set('display_errors', '0');
	if (session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	$session = isset($_SESSION) ? $_SESSION : [];
	session_write_close();

	list($status, $data) = requestsHandle(
		$method,
		array_values(array_filter((array)$urlData, 'strlen')),
		$_GET,
		file_get_contents('php://input'),
		$session,
		$_SERVER,
		function () {
			return new RequestsRepository(getDbInstance(), require __DIR__ . '/../../helpers/requestsConfig.php', $_SERVER['DOCUMENT_ROOT']);
		}
	);

	http_response_code($status);
	header('Cache-Control: no-store');
	header('X-Content-Type-Options: nosniff');

	if ($status === 200 && isset($data['csv'])) {
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename="zayavki-' . date('Y-m-d') . '.csv"');
		$out = fopen('php://output', 'w');
		fwrite($out, "\xEF\xBB\xBF");
		foreach ($data['csv'] as $line) {
			// Защита от формул в Excel: значения, начинающиеся с = + - @, экранируем апострофом.
			fputcsv($out, array_map(function ($cell) {
				$cell = (string)$cell;
				return preg_match('/^[=+\-@\t\r]/', $cell) ? "'" . $cell : $cell;
			}, $line), ';');
		}
		fclose($out);
		return;
	}

	header('Content-Type: application/json; charset=utf-8');
	$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | (defined('JSON_INVALID_UTF8_SUBSTITUTE') ? JSON_INVALID_UTF8_SUBSTITUTE : 0));
	echo $json === false ? '{"error":"Ошибка кодирования ответа"}' : $json;
}
