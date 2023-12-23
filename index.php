<?php

namespace App\Core;
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use Vic\Router\Router;

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once dirname(__FILE__) . '/config/constants.php';
require_once ROOT . '/../bootstrap.php';
require_once ROOT . '/components/Autoload.php';
require_once ROOT . '/config/reg_autoloader.php';
include_once ROOT . '/debug/d.php';
require_once ROOT . '/helpers/exception_handler.php';

set_exception_handler('exception_handler');

$router = new Router('App\Core');
$router->run();
