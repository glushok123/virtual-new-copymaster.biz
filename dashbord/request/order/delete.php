<?php
	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

    $db = getDbInstance();

    $idOrder = "";

    if(isset($_POST["id"])){
        $idOrder = $_POST["id"];
    }

    $db->query("DELETE FROM orders WHERE id = $idOrder;");

    $json = '{
        "status":"success"
    }';

    echo $json;