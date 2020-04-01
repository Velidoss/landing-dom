<?php

include_once 'app/core/route.php';

// use app\core\Router;

// spl_autoload_register(function($class) {
//     $path = str_replace('\\', '/', $class.'.php');
//     file_put_contents('chyeckin.json', $path);
//     if (file_exists($path)) {
//         require $path;
//     }
// });

session_start();
include_once 'app/boot.php';
$_SESSION['count'] = $_SESSION['count'] +1;

ini_set('display_errors', 1);

$router = new Route;
$router->run;

// $router = new Router;
// $router->run();
