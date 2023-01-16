<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');



function client_ip() {
    $ipaddress = '';

    if (isset($_SERVER['HTTP_CF_CONNECTING_IP']))
        $ipaddress = $_SERVER['HTTP_CF_CONNECTING_IP'];
    else if(isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $login = $_POST["login"];
    $passwd = $_POST["passwd"];

    $db = getDbInstance();
    $error_login = $db->query("SELECT COUNT(*) FROM user_accaunt WHERE (login = '$login' OR email = '$login') AND  passwd = '$passwd' GROUP BY (login) ");
    if (count($error_login) != 1){
        $json = '{
            "status":"error",
            "mes":"Не верный логин или пароль!"
        }';
        echo $json;
    }
    else{
        $info_user = $db->query("SELECT * FROM user_accaunt WHERE login = '$login' OR email = '$login'  ");

        $_SESSION['user_logged_in'] = TRUE;
        $_SESSION['login'] = $info_user[0]['login'];
        $_SESSION['email'] = $info_user[0]['email'];
        $_SESSION['type_user'] = $info_user[0]['type_user'];
        $_SESSION['id_user'] = $info_user[0]['id'];
        $_SESSION['type'] = $info_user[0]['type'];
        $_SESSION['IP'] = client_ip();
        $id = $info_user[0]['id'];

        $agent = $_SERVER['HTTP_USER_AGENT'];
        preg_match("/(MSIE|Opera|Firefox|Chrome|Version)(?:\/| )([0-9.]+)/", $agent, $bInfo);
        $browserInfo = array();
        $browserInfo['name'] = ($bInfo[1]=="Version") ? "Safari" : $bInfo[1];
        $browserInfo['version'] = $bInfo[2];
        $datat = date('Y-m-d H:i:s');
        $ip = client_ip();

        $series_id = randomString(16);
        $remember_token = getSecureRandomToken(20);
        $encryted_remember_token = password_hash($remember_token, PASSWORD_DEFAULT);
        $expiry_time = date('Y-m-d H:i:s', strtotime(' + 60 days'));
        $expires = strtotime($expiry_time);

        $db->query("INSERT INTO user_accaunt_session
            ( `id_user`, `date_in`, `device`,`ip`,`series_id`,`remember_token`,`expires`)
            VALUES
            (
                '".$info_user[0]['id']."',
                '".$datat."',
                '".$browserInfo['name']."/".$browserInfo['version']."/".gethostbyaddr($_SERVER['REMOTE_ADDR'])."',
                '".$ip."',
                '".$series_id."',
                '".$encryted_remember_token."',
                '".$expiry_time."'
            )");

        setcookie('series_id', $series_id, $expires, "/");
		setcookie('remember_token', $remember_token, $expires, "/");

        $update_remember = array(
            'series_id'=> $series_id,
            'remember_token' => $encryted_remember_token,
            'expires' => $expiry_time
        );

        $db->where ('id',$id);
        $db->update("user_accaunt", $update_remember);

        $json = '{
            "status":"success"
        }'; 

        echo $json;
    }
}