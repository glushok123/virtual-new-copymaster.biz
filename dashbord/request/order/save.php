<?php
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

    $db = getDbInstance();

    $textOrder = "";
    $comment = "";
    $status = "Активна";

    if(isset($_POST["textOrder"])){
        $textOrder = $_POST["textOrder"];
    }

    if(isset($_POST["comment"])){
        $comment = $_POST["comment"];
    }

    $db->query("INSERT INTO orders ( `name_user`, `text_order`, `comment`, `status`,`created_at`)
        VALUES
    ('" . $_SESSION['login'] . "', '" . $textOrder . "', '" . $comment . "', '" . $status . "', '" . date('Y-m-d H:i:s') . "')");

    $json = '{
        "status":"success"
    }';

    echo $json;