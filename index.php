<?php
// front controller

// 1. general settings
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
//unset($_SESSION['products']);

// 2. connect files
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/components/Autoload.php');

//echo ROOT;

// 3. connect to DB
    

// 4. call router

$router = new Router;
$router->run();


