<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
session_start();

clearAuthCookie();
session_destroy();
clearAuthCookie();

header('Location:index.php');
exit;

 ?>
