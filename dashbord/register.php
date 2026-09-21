<?php
/**
 * Создание учётной записи админки. Доступно только администратору:
 * раньше страница была открыта всем и позволяла завести себе доступ в админку.
 * Ответ — JSON строкой (форма разбирает его через JSON.parse).
 */
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

function registerReply($status, $message = null)
{
    echo '{
            "status":"' . $status . '"' . ($message === null ? '' : ',
            "mes":"' . $message . '"') . '
        }';
    exit;
}

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'admin') {
    http_response_code(403);
    registerReply('error', 'Создавать пользователей может только администратор');
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);
    registerReply('error', 'Метод не поддерживается');
}

$login = isset($_POST['login']) ? trim((string)$_POST['login']) : '';
$email = isset($_POST['email']) ? trim((string)$_POST['email']) : '';
$passwd = isset($_POST['passwd']) ? (string)$_POST['passwd'] : '';
$typeUser = isset($_POST['type_user']) ? trim((string)$_POST['type_user']) : '';
// Роль в админке: admin — полный доступ, km — сотрудник
$type = isset($_POST['type']) && $_POST['type'] === 'admin' ? 'admin' : 'km';

if ($login === '' || $passwd === '' || strlen($login) > 20 || strlen($email) > 50 || strlen($passwd) > 100) {
    registerReply('error', 'Проверьте логин, почту и пароль');
}

$db = getDbInstance();

$db->where('login', $login);
if ($db->getOne('user_accaunt')) {
    registerReply('error', 'Логин уже занят!');
}

$db->insert('user_accaunt', array(
    'login' => $login,
    'email' => $email,
    'passwd' => $passwd,
    'date_creat' => date('Y-m-d H:i:s'),
    'device' => 'создан пользователем ' . (isset($_SESSION['login']) ? $_SESSION['login'] : ''),
    'ip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '',
    'type_user' => $typeUser !== '' ? $typeUser : 'true',
    'type' => $type,
));

registerReply('success');
