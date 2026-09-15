<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

header('Content-Type: application/json; charset=utf-8');

function savePriceFail($code, $message)
{
    http_response_code($code);
    echo json_encode(['success' => false, 'error' => $message], JSON_UNESCAPED_UNICODE);
    exit;
}

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin') {
    savePriceFail(403, 'Доступ запрещён');
}

// calc=fiz (по умолчанию) | ur — POST-поле или параметр запроса (см. helpers/priceCalcConfig.php)
$calcs = require __DIR__ . '/helpers/priceCalcConfig.php';
$rawCalc = isset($_POST['calc']) ? $_POST['calc'] : (isset($_GET['calc']) ? $_GET['calc'] : null);
$calc = priceCalcKey($calcs, $rawCalc);
if ($calc === null) {
    savePriceFail(400, 'Неизвестный калькулятор');
}
$table = $calcs[$calc]['priceTable'];

$sections = require __DIR__ . '/helpers/' . $calcs[$calc]['config'];
$allowed = array_flip(priceChangeKeys($sections));

$json = isset($_POST['info']) && is_string($_POST['info']) ? str_replace(',}', '}', $_POST['info']) : '';
$arr = json_decode($json, true);

if (!is_array($arr)) {
    savePriceFail(400, 'Некорректные данные');
}

$db = getDbInstance();

if ($calc !== 'fiz') {
    try {
        $tableExists = $db->tableExists($table);
    } catch (Exception $e) {
        $tableExists = false;
    }
    if (!$tableExists) {
        savePriceFail(404, 'Таблица ' . $table . ' не найдена — выполните миграцию');
    }
}

$saved = 0;
$rejected = [];

foreach ($arr as $key => $value) {
    $key = (string)$key;
    $value = is_scalar($value) ? str_replace(',', '.', trim((string)$value)) : null;

    if (!isset($allowed[$key]) || $value === null || ($value !== '' && !is_numeric($value))) {
        $rejected[] = $key;
        continue;
    }

    $db->where('name', $key);
    if ($db->has($table)) {
        $db->where('name', $key);
        $db->update($table, ['price' => $value]);
    } else {
        $db->insert($table, ['name' => $key, 'price' => $value]);
    }
    $saved++;
}

echo json_encode([
    'success' => empty($rejected),
    'saved' => $saved,
    'rejected' => $rejected,
], JSON_UNESCAPED_UNICODE);
