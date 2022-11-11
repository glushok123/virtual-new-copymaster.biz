<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
$db = getDbInstance();

$res = $db->query("SELECT * FROM `pricecalc`");

$json = '{';

foreach ($res as $z){
  $json = $json.'"'.$z["name"].'":"'.$z["price"].'",';
}

$json = $json.'}';
$json = str_replace(',}', '}', $json);

echo $json;

