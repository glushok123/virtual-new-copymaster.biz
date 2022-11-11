<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
$db = getDbInstance();

$res = $db->query("SELECT * FROM `titel_calc`");

$json = '{';

foreach ($res as $z){
  $json = $json.'"'.$z["name"].'":"'.$z["titel"].'",';
}

$json = $json.'}';
$json = str_replace(',}', '}', $json);

echo $json;

