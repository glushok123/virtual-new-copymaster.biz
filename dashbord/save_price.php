<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Доступ запрещён'], JSON_UNESCAPED_UNICODE);
    exit;
}

$sections = require __DIR__ . '/helpers/priceChangeConfig.php';
$allowed = array_flip(priceChangeKeys($sections));

$json = isset($_POST['info']) ? str_replace(',}', '}', $_POST['info']) : '';
$arr = json_decode($json, true);

if (!is_array($arr)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Некорректные данные'], JSON_UNESCAPED_UNICODE);
    exit;
}

$db = getDbInstance();
$saved = 0;
$rejected = [];

foreach ($arr as $key => $value) {
    $value = str_replace(',', '.', trim((string)$value));

    if (!isset($allowed[$key]) || ($value !== '' && !is_numeric($value))) {
        $rejected[] = $key;
        continue;
    }

    $db->where('name', $key);
    if ($db->has('pricecalc')) {
        $db->where('name', $key);
        $db->update('pricecalc', ['price' => $value]);
    } else {
        $db->insert('pricecalc', ['name' => $key, 'price' => $value]);
    }
    $saved++;
}

echo json_encode([
    'success' => empty($rejected),
    'saved' => $saved,
    'rejected' => $rejected,
], JSON_UNESCAPED_UNICODE);
