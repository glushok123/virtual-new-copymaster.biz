<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');


if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === TRUE)
{
	session_destroy();
	if(isset($_COOKIE['series_id']) && isset($_COOKIE['remember_token'])){
		clearAuthCookie();
	}
	//header('Location:index.php');
}
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
    $email = $_POST["email"];
    $passwd = $_POST["passwd"];
	$type_user = $_POST["type_user"];

    $db = getDbInstance();
    $error_login = $db->query("SELECT COUNT(*) FROM user_accaunt WHERE login = '$login' GROUP BY (login) ");
    if (count($error_login) !=0){
        $json = '{
            "status":"error",
            "mes":"Логин уже занят!"
        }';
        echo $json;
    }
    else{

        $agent = $_SERVER['HTTP_USER_AGENT'];
        preg_match("/(MSIE|Opera|Firefox|Chrome|Version)(?:\/| )([0-9.]+)/", $agent, $bInfo);
        $browserInfo = array();
        $browserInfo['name'] = ($bInfo[1]=="Version") ? "Safari" : $bInfo[1];
        $browserInfo['version'] = $bInfo[2];
        $datat = date('Y-m-d H:i:s');
        $ip = client_ip();
            $db->query("INSERT INTO user_accaunt
            ( `login`, `email`, `passwd`,  `date_creat`, `device`,`ip`, `type_user`)
            VALUES
            ('".$login."','".$email."','".$passwd."','".$datat."','".$browserInfo['name']."/".$browserInfo['version']."/".gethostbyaddr($_SERVER['REMOTE_ADDR'])."','".$ip."','".$type_user."')");



		$info_user = $db->query("SELECT * FROM user_accaunt WHERE login = '$login' OR email = '$login'  ");

		$_SESSION['user_logged_in'] = TRUE;
		$_SESSION['id_user'] = $info_user[0]['id'];
		$_SESSION['login'] = $login;
		$_SESSION['email'] = $info_user[0]['email'];
		$_SESSION['type_user'] = $info_user[0]['type_user'];
		$_SESSION['IP'] = $ip;

		$json = '{
            "status":"success"
        }';
        echo $json;

		//header('Location:index.php');
    }



}
