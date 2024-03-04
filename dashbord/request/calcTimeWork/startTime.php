<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
$db = getDbInstance();

if (isset($_POST["start"]) && $_POST["start"] === 'true') {
    $userId = $_SESSION['id_user'];
}

$timeStart = date('Y-m-d H:i:s');


$db->query("INSERT INTO log_time_work ( `user_id`, `time_start`) VALUES ('" . $userId . "', '" . $timeStart . "')");

$json = '{
        "status":"success"
    }';

echo $json;

