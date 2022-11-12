<?php
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

    $db = getDbInstance();

    $order = "";

    if(isset($_POST["id"])){
        $idOrder = $_POST["id"];
    }

    $order = $db->query("SELECT * FROM orders WHERE id = $idOrder;");

    $json = '{
        "status":"success"
    }';

    echo json_encode($order);