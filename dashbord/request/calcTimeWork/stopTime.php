<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
$db = getDbInstance();

if (isset($_POST["start"]) && $_POST["start"] === 'true') {
    $userId = $_SESSION['id_user'];
}


$timeStop = date('Y-m-d H:i:s');

$db->query("UPDATE log_time_work
        SET time_end='" . $timeStop . "'
        WHERE user_id='" . $userId . "' AND time_end IS NULL");

$json = '{
        "status":"success"
    }';

echo $json;
