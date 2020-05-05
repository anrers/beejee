<?php
//Подключение файла
session_start();
define ('ROOT', dirname(__FILE__));
require_once (ROOT.'/components/Autoload.php');
require_once (ROOT.'/components/router.php');
require_once (ROOT.'/components/DB.php');
//Запуск router

$router = new router();
$router->run();
