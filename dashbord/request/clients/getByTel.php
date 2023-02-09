<?php
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

    $db = getDbInstance();

    $phone = "";

    if(isset($_POST["phone"])){
        $phone = $_POST["phone"];
    }

    $client = $db->query("SELECT * FROM customers_calculator WHERE phone = '" . $phone . "';");

    if (count($client) > 0) {
        $json = '{
            "status":"success",
            "discount": ' . $client[0]['discount'] . '
        }';
    }
    else {
        $json = '{
            "status":"noFind"
        }';
    }

    echo json_encode($json);