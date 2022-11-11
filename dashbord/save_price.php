<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
$db = getDbInstance();

$json=$_POST['info'];
$json = str_replace(',}', '}', $json);
$arr = json_decode($json, true);

foreach($arr as  $key => $value)
{
  $db->query("UPDATE `pricecalc` SET `price`='".$value."' WHERE name='".$key."'");
}

 ?>
