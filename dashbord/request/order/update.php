<?php
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

    $db = getDbInstance();

    $textOrder = "";
    $comment = "";
    $status = "";
    $id = "";

    if(isset($_POST["textOrder"])){
        $textOrder = $_POST["textOrder"];
    }

    if(isset($_POST["comment"])){
        $comment = $_POST["comment"];
    }

    if(isset($_POST["status"])){
        $status = $_POST["status"];
    }

    if(isset($_POST["id"])){
        $id = $_POST["id"];
    }

    $db->query("UPDATE orders
        SET text_order='" . $textOrder . "', comment='" . $comment . "', status='" . $status . "'
        WHERE id='" . $id . "' ");

    $json = '{
        "status":"success"
    }';

    echo $json;