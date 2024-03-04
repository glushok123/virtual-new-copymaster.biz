<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
$db = getDbInstance();

$userId = $_SESSION['id_user'];

$times = $db->query("SELECT * FROM log_time_work  WHERE user_id='" . $userId . "'");

if (!empty($times)){

    $data = [];
    foreach ($times as $time){
        if(empty($time['time_end'])) {
            $time['dif'] = null;
            $data[] = $time;
            continue;
        };
        $time_start = $time['time_start'];
        $time_start = new DateTime($time_start);

        $time_end = $time['time_end'];
        $time_end = new DateTime($time_end);

        $dif = $time_start->diff($time_end);
        $time['dif'] = $dif->h . ' ч ' .  $dif->i . ' мин ';
        $data[] = $time;
    }

    $response = [
        "status" => "success",
        "message"  => "success",
        "time"  => true,
        "times"  => $data,
    ];

    echo json_encode(["data" => $data]);
}else{
    echo json_encode([
        "status" => "success",
        "message"  => "success",
        "time"  => false,
    ]);
}



