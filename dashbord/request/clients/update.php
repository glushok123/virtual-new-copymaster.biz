<?php
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

    $db = getDbInstance();

    $discount = "";

    $id = "";

    if(isset($_POST["discount"])){
        $discount = $_POST["discount"];
    }

    if(isset($_POST["id"])){
        $id = $_POST["id"];
    }

    $db->query("UPDATE customers_calculator
        SET discount='" . $discount . "'
        WHERE id=" . $id);

    $json = '{
        "status":"success"
    }';

    echo $json;