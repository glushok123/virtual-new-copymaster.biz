<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
define('BASE_PATH', dirname(dirname(__FILE__)));
define('APP_FOLDER', 'simpleadmin');
define('CURRENT_PAGE', basename($_SERVER['REQUEST_URI']));

require_once BASE_PATH . '/lib/MysqliDb/MysqliDb.php';
require_once BASE_PATH . '/dashbord/helpers/helpers.php';


/*
|--------------------------------------------------------------------------
| DATABASE CONFIGURATION
|--------------------------------------------------------------------------
 */

define('DB_HOST', "localhost:3306");
define('DB_USER', "a0458868_dashbord2_copymaster"); #
define('DB_PASSWORD', "!140199!"); #
define('DB_NAME', "a0458868_dashbord2_copymaster"); #

/**
 * Get instance of DB object
 */
function getDbInstance()
{
	return new MysqliDb(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
}