<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
$db = getDbInstance();

if (isset($_POST["start"]) && $_POST["start"] === 'true') {
    $userId = $_SESSION['id_user'];
}

$time = $db->query("SELECT * FROM log_time_work  WHERE user_id='" . $userId . "' AND time_end IS NULL");

if (!empty($time)){
    $time = $time[0]['time_start'];
    $start_date = new DateTime($time);
    $since_start = $start_date->diff(new DateTime(date('Y-m-d H:i:s')));

    $days = $since_start->days; //.' days total<br>';
    $y = $since_start->y; //.' years<br>';
    $m = $since_start->m; //.' months<br>';
    $d = $since_start->d; //.' days<br>';
    $h = $since_start->h; //.' hours<br>';
    $i = $since_start->i; //.' minutes<br>';
    $s = $since_start->s; //.' seconds<br>';

    $response = [
        "status" => "success",
        "message"  => "success",
        "time"  => true,
        "h"  => $h,
        "i"  => $i,
        "s"  => $s,
    ];

    echo json_encode($response);
}else{
    echo json_encode([
        "status" => "success",
        "message"  => "success",
        "time"  => false,
    ]);
}



