<?php
/**
 * Аналитика чеков калькуляторов ФИЗ и ЮР (у каждого своя БД с таблицами check_id + offers).
 *
 * Проведённые чеки — cher = '0' (1 и 2 — черновики).
 * check_id.cost — сумма чека после скидки, check_id.discount — скидка в рублях.
 * offers.cost — цена за единицу, offers.price — сумма строки (до скидки чека).
 */
class Analytics
{
    /** Разделы калькулятора (первая буква id услуги в dashbord/calc/main.js). */
    const CATEGORIES = [
        'a' => 'Печать',
        'b' => 'Переплёт',
        'c' => 'Прочее',
        'd' => 'Дизайн',
        'e' => 'Багетка',
        'x' => 'Не определено',
    ];

    /** Подразделы (две первые буквы id), названия как в калькуляторе. */
    const GROUPS = [
        'aa' => 'Цветная печать', 'ab' => 'Черно-белая печать',
        'ba' => 'Пластиковая пружина', 'bb' => 'Металлическая пружина', 'bc' => 'Твёрдый переплёт',
        'bd' => 'Вставка конверта', 'be' => 'Вставка файла',
        'ca' => 'Сканирование', 'cb' => 'Ламинирование', 'ce' => 'Работа на компьютере',
        'cf' => 'Набор текста', 'cg' => 'Доработка файлов', 'ch' => 'Распознавание текста',
        'ci' => 'Запись на CD/DVD', 'cj' => 'Сшивание / расшивание', 'ck' => 'Перфорация',
        'cl' => 'Резка', 'cm' => 'Ручная резка', 'cn' => 'Степлер', 'co' => 'Фальцовка',
        'cp' => 'Биговка', 'cq' => 'Тиснение', 'cr' => 'Отправка / приём файлов', 'cs' => 'Доставка',
        'ct' => 'Папка-скоросшиватель', 'cu' => 'Файл A4', 'cv' => 'Файл A3', 'cw' => 'Печать на кружках',
        'da' => 'Услуги дизайнера', 'db' => 'Вёрстка визитки', 'dc' => 'Печать визиток',
        'dd' => 'Дизайнерская бумага', 'de' => 'Фото на документы', 'df' => 'Печати', 'dg' => 'Оснастки',
        'dh' => 'Краски', 'di' => 'Фоторетушь', 'dj' => 'Вёрстка макета', 'dk' => 'Разработка логотипа',
        'dl' => 'Печать фото',
        'ea' => 'Накатка на пенокартон', 'eb' => 'Накатка для студентов',
    ];

    /** @var PDO */
    private $db;
    private $cacheDir;
    private $categories;
    private $groups;
    /** SQL-условие «какие записи считаем»: для ФИЗ — проведённые чеки, для ЮР — ещё и черновики */
    private $cherSql;
    private $cherSqlC;

    /**
     * @param array $options cher — значения check_id.cher, которые учитываются;
     *                       categories / groups — названия разделов и подразделов калькулятора
     */
    public function __construct(PDO $db, $cacheDir, array $options = [])
    {
        $this->db = $db;
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->exec("SET NAMES utf8");
        $this->cacheDir = $cacheDir;
        $this->categories = isset($options['categories']) ? $options['categories'] : self::CATEGORIES;
        $this->groups = isset($options['groups']) ? $options['groups'] : self::GROUPS;

        $cher = isset($options['cher']) ? $options['cher'] : ['0'];
        $list = implode(', ', array_map(function ($v) { return "'" . preg_replace('/\D/', '', $v) . "'"; }, $cher));
        $this->cherSql = "cher IN ($list)";
        $this->cherSqlC = "c.cher IN ($list)";
    }

    /** Меняется с каждым новым или удалённым чеком — по нему сбрасывается кэш. */
    public function version()
    {
        $row = $this->db->query("SELECT COUNT(*) AS n, MAX(id) AS m FROM check_id")->fetch(PDO::FETCH_ASSOC);
        return $row['n'] . '-' . $row['m'];
    }

    /** Все сводки за период [from; to] (даты Y-m-d включительно) и за такой же период перед ним. */
    public function summary($from, $to)
    {
        $days = (int)round((strtotime($to) - strtotime($from)) / 86400) + 1;
        $prevTo = date('Y-m-d', strtotime($from . ' -1 day'));
        $prevFrom = date('Y-m-d', strtotime($prevTo . ' -' . ($days - 1) . ' days'));

        return [
            'period' => ['from' => $from, 'to' => $to, 'days' => $days],
            'prev' => ['from' => $prevFrom, 'to' => $prevTo],
            'daily' => $this->daily($from, $to),
            'prevDaily' => $this->daily($prevFrom, $prevTo),
            'heatmap' => $this->heatmap($from, $to),
            'services' => $this->services($from, $to),
            'clients' => $this->clients($from, $to),
            'categories' => $this->categories,
            'groups' => $this->groups,
        ];
    }

    /**
     * Клиенты (название компании / имя из чека) за период.
     * Написание нормализуется: «ООО "СтайлГрупп"» и «СТАЙЛГРУПП» — один клиент.
     */
    public function clients($from, $to)
    {
        $st = $this->db->prepare("
            SELECT c.id, c.cost, c.createtime, MAX(TRIM(o.name_komp)) AS client, MAX(TRIM(o.tel)) AS tel
            FROM check_id c
            LEFT JOIN offers o ON o.item = c.id
            WHERE {$this->cherSqlC} AND c.createtime >= ? AND c.createtime < ?
            GROUP BY c.id, c.cost, c.createtime
        ");
        $st->execute($this->range($from, $to));

        $clients = [];
        $withClient = 0;
        $total = 0;
        foreach ($st->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $total++;
            $name = trim((string)$row['client']);
            $tel = trim((string)$row['tel']);
            $key = $this->clientKey($name);
            if ($key === '') {
                $key = preg_replace('/\D/', '', $tel);
                if (strlen($key) < 6) {
                    continue;
                }
                $key = 'tel:' . substr($key, -10);
            }
            $withClient++;
            if (!isset($clients[$key])) {
                $clients[$key] = ['names' => [], 'tel' => '', 'checks' => 0, 'revenue' => 0, 'first' => $row['createtime'], 'last' => $row['createtime']];
            }
            $c = &$clients[$key];
            $label = $name !== '' ? $name : $tel;
            $c['names'][$label] = (isset($c['names'][$label]) ? $c['names'][$label] : 0) + 1;
            if ($tel !== '') {
                $c['tel'] = $tel;
            }
            $c['checks']++;
            $c['revenue'] += (float)$row['cost'];
            $c['first'] = min($c['first'], $row['createtime']);
            $c['last'] = max($c['last'], $row['createtime']);
            unset($c);
        }

        $list = [];
        foreach ($clients as $c) {
            arsort($c['names']);
            $list[] = [
                'name' => key($c['names']),
                'tel' => $c['tel'],
                'checks' => $c['checks'],
                'revenue' => round($c['revenue'], 2),
                'first' => substr($c['first'], 0, 10),
                'last' => substr($c['last'], 0, 10),
            ];
        }
        usort($list, function ($a, $b) { return $b['revenue'] < $a['revenue'] ? -1 : ($b['revenue'] > $a['revenue'] ? 1 : 0); });

        return ['total' => $total, 'withClient' => $withClient, 'list' => array_slice($list, 0, 300)];
    }

    private function clientKey($name)
    {
        $key = mb_strtoupper($name, 'UTF-8');
        $key = preg_replace('/(?<!\p{L})(ООО|ОАО|ЗАО|ПАО|АО|ИП|ГУП|ГБУ|МУП|ФГУП)(?!\p{L})/u', ' ', $key);
        $key = preg_replace('/[^\p{L}\p{N}]+/u', '', $key);
        return $key;
    }

    /** Итоги по дням: количество, выручка, скидки, разбивка по способу оплаты. */
    public function daily($from, $to)
    {
        $st = $this->db->prepare("
            SELECT DATE(createtime) AS d,
                COUNT(*) AS n,
                SUM(cost) AS revenue,
                SUM(discount) AS discount,
                SUM(discount > 0) AS discounted,
                SUM(pay_type = 'cash') AS cash_n, SUM(IF(pay_type = 'cash', cost, 0)) AS cash,
                SUM(pay_type = 'card') AS card_n, SUM(IF(pay_type = 'card', cost, 0)) AS card,
                SUM(pay_type = 'yr') AS yr_n, SUM(IF(pay_type = 'yr', cost, 0)) AS yr,
                SUM(pay_type NOT IN ('cash', 'card', 'yr')) AS other_n,
                SUM(IF(pay_type NOT IN ('cash', 'card', 'yr'), cost, 0)) AS other
            FROM check_id
            WHERE {$this->cherSql} AND createtime >= ? AND createtime < ?
            GROUP BY d
            ORDER BY d
        ");
        $st->execute($this->range($from, $to));

        $rows = [];
        foreach ($st->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $item = ['d' => $row['d']];
            unset($row['d']);
            foreach ($row as $key => $value) {
                $item[$key] = round((float)$value, 2);
            }
            $rows[] = $item;
        }
        return $rows;
    }

    /** Чеки по дню недели (0 — пн) и часу: [день, час, чеков, выручка]. */
    public function heatmap($from, $to)
    {
        $st = $this->db->prepare("
            SELECT WEEKDAY(createtime) AS wd, HOUR(createtime) AS h, COUNT(*) AS n, SUM(cost) AS s
            FROM check_id
            WHERE {$this->cherSql} AND createtime >= ? AND createtime < ?
            GROUP BY wd, h
        ");
        $st->execute($this->range($from, $to));

        return array_map(function ($r) {
            return [(int)$r['wd'], (int)$r['h'], (int)$r['n'], (float)$r['s']];
        }, $st->fetchAll(PDO::FETCH_ASSOC));
    }

    /** Продажи по услугам за период с разделом из калькулятора. */
    public function services($from, $to)
    {
        $st = $this->db->prepare("
            SELECT o.name, SUM(o.price) AS revenue, SUM(o.count) AS qty, COUNT(DISTINCT o.item) AS checks
            FROM offers o
            JOIN check_id c ON c.id = o.item
            WHERE {$this->cherSqlC} AND c.createtime >= ? AND c.createtime < ?
            GROUP BY o.name
            ORDER BY revenue DESC
        ");
        $st->execute($this->range($from, $to));

        $map = $this->serviceMap();
        $rows = [];
        foreach ($st->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $name = trim($row['name']);
            $code = isset($map[$name]) ? $map[$name] : $this->codeByName($name);
            $rows[] = [
                'name' => $name,
                'cat' => mb_substr($code, 0, 1, 'UTF-8'),
                'group' => mb_strlen($code, 'UTF-8') > 1 ? mb_substr($code, 0, 2, 'UTF-8') : '',
                'revenue' => round((float)$row['revenue'], 2),
                'qty' => (int)$row['qty'],
                'checks' => (int)$row['checks'],
            ];
        }
        return $rows;
    }

    /** Итоги по месяцам за всё время. */
    public function months()
    {
        $rows = $this->db->query("
            SELECT YEAR(createtime) AS y, MONTH(createtime) AS m, COUNT(*) AS n, SUM(cost) AS s
            FROM check_id
            WHERE {$this->cherSql}
            GROUP BY y, m
            ORDER BY y, m
        ")->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($r) {
            return [(int)$r['y'], (int)$r['m'], (int)$r['n'], (float)$r['s']];
        }, $rows);
    }

    /** Чеки за день с позициями. */
    public function checksByDay($date)
    {
        $st = $this->db->prepare("
            SELECT id, createtime, cost, discount, discount_percent, pay_type, prepayment
            FROM check_id
            WHERE {$this->cherSql} AND createtime >= ? AND createtime < ?
            ORDER BY createtime DESC
        ");
        $st->execute($this->range($date, $date));
        return $this->withOffers($st->fetchAll(PDO::FETCH_ASSOC));
    }

    /** Один чек по номеру (включая черновики — чтобы найти любой номер). */
    public function checkById($id)
    {
        $st = $this->db->prepare("
            SELECT id, createtime, cost, discount, discount_percent, pay_type, prepayment, cher
            FROM check_id WHERE id = ?
        ");
        $st->execute([(int)$id]);
        return $this->withOffers($st->fetchAll(PDO::FETCH_ASSOC));
    }

    private function withOffers(array $checks)
    {
        if (!$checks) {
            return [];
        }
        $ids = array_map(function ($c) { return (int)$c['id']; }, $checks);
        $offers = $this->db->query("
            SELECT item, name, cost, price, count, name_komp, tel, srok
            FROM offers
            WHERE item IN (" . implode(',', $ids) . ")
            ORDER BY item, offer_item
        ")->fetchAll(PDO::FETCH_ASSOC);

        $byCheck = [];
        $contact = [];
        foreach ($offers as $o) {
            $byCheck[$o['item']][] = [
                'name' => trim($o['name']),
                'unit' => (float)$o['cost'],
                'qty' => (int)$o['count'],
                'sum' => (float)$o['price'],
            ];
            foreach (['client' => 'name_komp', 'tel' => 'tel', 'srok' => 'srok'] as $to => $from) {
                if (trim((string)$o[$from]) !== '') {
                    $contact[$o['item']][$to] = trim($o[$from]);
                }
            }
        }

        return array_map(function ($c) use ($byCheck, $contact) {
            return [
                'id' => (int)$c['id'],
                'time' => $c['createtime'],
                'cost' => (float)$c['cost'],
                'discount' => (float)$c['discount'],
                'pay' => $c['pay_type'],
                'draft' => isset($c['cher']) && $c['cher'] !== '0',
                'items' => isset($byCheck[$c['id']]) ? $byCheck[$c['id']] : [],
                'contact' => isset($contact[$c['id']]) ? $contact[$c['id']] : null,
            ];
        }, $checks);
    }

    /**
     * Словарь «название услуги → id в калькуляторе».
     * id берётся из objtest (сериализованный чек: lst = [id, кол-во, цена, сумма] в порядке позиций).
     * Обновляется инкрементально по новым позициям, поэтому ничего не нужно править руками.
     */
    public function serviceMap()
    {
        $file = $this->cacheDir . '/service_map.json';
        $cache = is_file($file) ? json_decode(file_get_contents($file), true) : null;
        if (!is_array($cache) || !isset($cache['lastId'], $cache['map'])) {
            $cache = ['lastId' => 0, 'map' => []];
        }

        $maxId = (int)$this->db->query("SELECT MAX(id) FROM offers")->fetchColumn();
        if ($maxId <= $cache['lastId']) {
            return $cache['map'];
        }

        $st = $this->db->prepare("
            SELECT id, name, cost, count, offer_item, objtest
            FROM offers
            WHERE id > ? AND objtest IS NOT NULL AND objtest <> ''
            ORDER BY id
        ");
        $st->execute([$cache['lastId']]);

        while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
            $code = $this->codeFromObjtest($row);
            if ($code !== null) {
                $cache['map'][trim($row['name'])] = $code;
            }
        }
        $cache['lastId'] = $maxId;

        if (is_dir($this->cacheDir) || @mkdir($this->cacheDir, 0775, true)) {
            @file_put_contents($file, json_encode($cache, JSON_UNESCAPED_UNICODE), LOCK_EX);
        }
        return $cache['map'];
    }

    /** Для старых позиций без objtest (2020–2022) — раздел по началу названия. */
    private function codeByName($name)
    {
        $rules = [
            '/^цветная (печать|копия|копир)/u' => 'aa',
            '/^ч[её]рно[\s-]?белая (печать|копия|копир)/u' => 'ab',
            '/визитк/u' => 'dc',
            '/(печат[иь] или штамп|круглой печати|штамп|факсимиле|экслибрис)/u' => 'df',
            '/оснастк/u' => 'dg',
            '/^фото на документ/u' => 'de',
            '/^(печать фото|фото \d)/u' => 'dl',
            '/металлическ\S* пружин/u' => 'bb',
            '/пружин/u' => 'ba',
            '/переплет|переплёт/u' => 'bc',
            '/ламинир/u' => 'cb',
            '/сканир/u' => 'ca',
            '/накатк/u' => 'ea',
            '/кружк/u' => 'cw',
        ];
        $lower = mb_strtolower($name, 'UTF-8');
        foreach ($rules as $pattern => $code) {
            if (preg_match($pattern, $lower)) {
                return $code;
            }
        }
        return 'x';
    }

    private function codeFromObjtest(array $row)
    {
        // Элемент lst: a:4:{i:0;s:5:"abaac";i:1;i:5;i:2;i:41;i:3;i:205;} — числа бывают i:, d: или s:N:"…"
        $number = '(?:[id]:([\d.]+)|s:\d+:"([\d.]*)")';
        if (!preg_match_all('/a:4:\{i:0;s:\d+:"([a-zа-яё]+)";i:1;' . $number . ';i:2;' . $number . ';/u', $row['objtest'], $found, PREG_SET_ORDER)) {
            return null;
        }
        $m = array_map(function ($f) {
            return [
                1 => $f[1],
                2 => $f[2] !== '' ? $f[2] : (isset($f[3]) ? $f[3] : ''),
                3 => isset($f[4]) && $f[4] !== '' ? $f[4] : (isset($f[5]) ? $f[5] : ''),
            ];
        }, $found);
        // Позиции чека идут в том же порядке, что и offer_item (с 1).
        $index = (int)$row['offer_item'] - 1;
        if (isset($m[$index]) && abs((float)$m[$index][3] - (float)$row['cost']) < 0.01) {
            return $m[$index][1];
        }
        foreach ($m as $entry) {
            if (abs((float)$entry[3] - (float)$row['cost']) < 0.01 && (int)$entry[2] === (int)$row['count']) {
                return $entry[1];
            }
        }
        return null;
    }

    /** [начало дня from; начало дня после to) */
    private function range($from, $to)
    {
        return [$from . ' 00:00:00', date('Y-m-d', strtotime($to . ' +1 day')) . ' 00:00:00'];
    }
}
