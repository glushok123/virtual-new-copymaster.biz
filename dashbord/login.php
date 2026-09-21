<?php
/**
 * Вход в админку. Ответ — JSON строкой (форма разбирает его через JSON.parse).
 *
 * Логин и пароль подставляются в запрос только через подготовленные значения MysqliDb,
 * пароль сверяется в PHP: в базе он пока хранится открытым текстом, но если появится
 * хеш (password_hash), он тоже поддерживается.
 */
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

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

function loginFailed()
{
    usleep(400000); // чуть тормозим перебор паролей
    echo '{
            "status":"error",
            "mes":"Не верный логин или пароль!"
        }';
    exit;
}

/** Браузер и версия для журнала входов. */
function loginDevice()
{
    $agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    if (!preg_match("/(MSIE|Opera|Firefox|Chrome|Version)(?:\/| )([0-9.]+)/", $agent, $bInfo)) {
        return 'unknown';
    }
    $name = $bInfo[1] == 'Version' ? 'Safari' : $bInfo[1];
    $host = isset($_SERVER['REMOTE_ADDR']) ? @gethostbyaddr($_SERVER['REMOTE_ADDR']) : '';
    return $name . '/' . $bInfo[2] . '/' . $host;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    loginFailed();
}

$login = isset($_POST['login']) ? trim((string)$_POST['login']) : '';
$passwd = isset($_POST['passwd']) ? (string)$_POST['passwd'] : '';

if ($login === '' || $passwd === '' || strlen($login) > 100 || strlen($passwd) > 200) {
    loginFailed();
}

$db = getDbInstance();

$db->where('login', $login);
$user = $db->getOne('user_accaunt');
if (!$user) {
    $db->where('email', $login);
    $user = $db->getOne('user_accaunt');
}

if (!$user) {
    loginFailed();
}

$stored = (string)$user['passwd'];
$isHash = strlen($stored) > 30 && preg_match('/^\$2[aby]\$/', $stored) === 1;
$passwordOk = $isHash ? password_verify($passwd, $stored) : hash_equals($stored, $passwd);

if (!$passwordOk) {
    loginFailed();
}

session_regenerate_id(true);

$_SESSION['user_logged_in'] = TRUE;
$_SESSION['login'] = $user['login'];
$_SESSION['email'] = $user['email'];
$_SESSION['type_user'] = $user['type_user'];
$_SESSION['id_user'] = $user['id'];
$_SESSION['type'] = $user['type'];
$_SESSION['IP'] = client_ip();

$series_id = randomString(16);
$remember_token = getSecureRandomToken(20);
$encryted_remember_token = password_hash($remember_token, PASSWORD_DEFAULT);
$expiry_time = date('Y-m-d H:i:s', strtotime(' + 60 days'));
$expires = strtotime($expiry_time);

$db->insert('user_accaunt_session', array(
    'id_user' => $user['id'],
    'date_in' => date('Y-m-d H:i:s'),
    'device' => loginDevice(),
    'ip' => client_ip(),
    'series_id' => $series_id,
    'remember_token' => $encryted_remember_token,
    'expires' => $expiry_time,
));

setcookie('series_id', $series_id, $expires, "/");
setcookie('remember_token', $remember_token, $expires, "/");

$db->where('id', $user['id']);
$db->update('user_accaunt', array(
    'series_id' => $series_id,
    'remember_token' => $encryted_remember_token,
    'expires' => $expiry_time,
));

echo '{
            "status":"success"
        }';
