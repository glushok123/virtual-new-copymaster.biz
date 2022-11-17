<?php
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

    $db = getDbInstance();

    $id = "";

    if(isset($_POST["id"])){
        $id = $_POST["id"];
    }

    $db->query("UPDATE orders
        SET status='Выполнена'
        WHERE id='" . $id . "' ");

    $json = '{
        "status":"success"
    }';

    echo $json;