<?php
/**
 * JSON API для страницы dashbord/analytics.php (только для admin).
 *
 *   ?action=summary&from=Y-m-d&to=Y-m-d — сводка за период и предыдущий период
 *   ?action=months                      — итоги по месяцам за всё время
 *   ?action=checks&date=Y-m-d           — чеки за день с позициями
 *   ?action=check&id=N                  — один чек по номеру
 */
session_start();
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

function analyticsReply($data, $code = 200)
{
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin') {
    analyticsReply(['error' => 'Доступ запрещён'], 403);
}
session_write_close();

function analyticsDate($value)
{
    $date = DateTime::createFromFormat('Y-m-d', (string)$value);
    return $date && $date->format('Y-m-d') === $value ? $value : null;
}

require __DIR__ . '/../../calc/connect.php';
require __DIR__ . '/Analytics.php';

$cacheDir = __DIR__ . '/cache';
$analytics = new Analytics($dbh, $cacheDir);
$action = isset($_GET['action']) ? $_GET['action'] : '';

try {
    switch ($action) {
        case 'summary':
        case 'months':
            $params = [];
            if ($action === 'summary') {
                $from = analyticsDate(isset($_GET['from']) ? $_GET['from'] : '');
                $to = analyticsDate(isset($_GET['to']) ? $_GET['to'] : '');
                if (!$from || !$to || $from > $to) {
                    analyticsReply(['error' => 'Некорректный период'], 400);
                }
                $params = [$from, $to];
            }

            // Кэш живёт, пока не появится новый чек (и не дольше суток).
            $version = $analytics->version();
            $file = $cacheDir . '/' . $action . '_' . md5(implode('|', $params)) . '.json';
            if (is_file($file) && filemtime($file) > time() - 86400) {
                $cached = json_decode(file_get_contents($file), true);
                if (isset($cached['version']) && $cached['version'] === $version) {
                    analyticsReply($cached);
                }
            }

            $data = $action === 'summary'
                ? $analytics->summary($params[0], $params[1])
                : ['months' => $analytics->months()];
            $data['version'] = $version;
            $data['generatedAt'] = date('Y-m-d H:i:s');

            if (is_dir($cacheDir) || @mkdir($cacheDir, 0775, true)) {
                @file_put_contents($file, json_encode($data, JSON_UNESCAPED_UNICODE), LOCK_EX);
            }
            analyticsReply($data);

        case 'checks':
            $date = analyticsDate(isset($_GET['date']) ? $_GET['date'] : '');
            if (!$date) {
                analyticsReply(['error' => 'Некорректная дата'], 400);
            }
            analyticsReply(['checks' => $analytics->checksByDay($date)]);

        case 'check':
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            analyticsReply(['checks' => $id > 0 ? $analytics->checkById($id) : []]);

        default:
            analyticsReply(['error' => 'Неизвестное действие'], 400);
    }
} catch (Exception $e) {
    analyticsReply(['error' => 'Ошибка базы данных'], 500);
}
