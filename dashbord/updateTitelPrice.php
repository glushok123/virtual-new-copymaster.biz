<?php
/**
 * Сохранение названий позиций калькулятора.
 * POST info — JSON {name: titel}, calc — ключ калькулятора из helpers/titelCalcConfig.php (по умолчанию ФИЗ).
 * Обновляет только уже существующие строки, новых не создаёт.
 */
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

header('Content-Type: application/json; charset=utf-8');

function titelSaveFail($code, $message)
{
    http_response_code($code);
    echo json_encode(['success' => false, 'error' => $message], JSON_UNESCAPED_UNICODE);
    exit;
}

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin') {
    titelSaveFail(403, 'Доступ запрещён');
}

$configs = require __DIR__ . '/helpers/titelCalcConfig.php';
$calcKey = titelCalcKey($configs, isset($_POST['calc']) ? $_POST['calc'] : '');
if (isset($_POST['calc']) && $_POST['calc'] !== $calcKey) {
    titelSaveFail(400, 'Неизвестный калькулятор');
}
$table = $configs[$calcKey]['table'];

$json = isset($_POST['info']) && is_string($_POST['info']) ? str_replace(',}', '}', $_POST['info']) : '';
$arr = json_decode($json, true);
if (!is_array($arr)) {
    titelSaveFail(400, 'Некорректные данные');
}

$db = getDbInstance();

try {
    if (!$db->tableExists($table)) {
        titelSaveFail(404, 'Таблица ' . $table . ' не найдена');
    }
    $existing = [];
    foreach ($db->get($table, null, ['name']) as $row) {
        $existing[(string)$row['name']] = true;
    }
} catch (Exception $e) {
    titelSaveFail(500, 'Ошибка базы данных');
}

$saved = 0;
$rejected = [];

foreach ($arr as $key => $value) {
    $key = (string)$key;
    $value = is_scalar($value) ? trim((string)$value) : null;

    if (!isset($existing[$key]) || $value === null || !titelCalcValidTitle($value)) {
        $rejected[] = $key;
        continue;
    }

    try {
        $db->where('name', $key);
        if ($db->update($table, ['titel' => $value])) {
            $saved++;
        } else {
            $rejected[] = $key;
        }
    } catch (Exception $e) {
        $rejected[] = $key;
    }
}

echo json_encode([
    'success' => empty($rejected),
    'saved' => $saved,
    'rejected' => $rejected,
], JSON_UNESCAPED_UNICODE);
