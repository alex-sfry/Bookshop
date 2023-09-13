<?php
// namespace App\Core;
use Vic\Router\Router;

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once(dirname(__FILE__) . '/config/constants.php');
require_once(ROOT . '/components/Autoload.php');
require_once (ROOT . '/config/reg_autoloader.php');

$router = new Router('App\Core');
$router->run();
