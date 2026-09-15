<?php
/**
 * Цены калькулятора в виде JSON-объекта {name: "price"}.
 * ?calc=fiz (или без параметра) — таблица pricecalc, ?calc=ur — pricecalc_ur (см. helpers/priceCalcConfig.php).
 * Если таблицы нет или запрос к БД не удался — пустой объект {}: калькулятор возьмёт цены по умолчанию.
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
$calcs = require __DIR__ . '/helpers/priceCalcConfig.php';

header('Content-Type: application/json; charset=utf-8');

$calc = priceCalcKey($calcs, isset($_GET['calc']) ? $_GET['calc'] : null);
if ($calc === null) {
    http_response_code(400);
    echo '{}';
    exit;
}
$table = $calcs[$calc]['priceTable'];

$prices = [];
try {
    $db = getDbInstance();
    if ($calc === 'fiz' || $db->tableExists($table)) {
        foreach ($db->get($table, null, ['name', 'price']) as $row) {
            $prices[(string)$row['name']] = (string)$row['price'];
        }
    }
} catch (Exception $e) {
    $prices = [];
}

$json = json_encode($prices, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT | JSON_PARTIAL_OUTPUT_ON_ERROR);
echo $json === false ? '{}' : $json;
