<?php

require_once 'config/config.php';

spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});

// Simple Router
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri == '/register' && $requestMethod == 'GET') {
    $controller = new UserController();
    $controller->register();
} elseif ($requestUri == '/register/store' && $requestMethod == 'POST') {
    $controller = new UserController();
    $controller->store();
} elseif ($requestUri == '/login' && $requestMethod == 'GET') {
    $controller = new UserController();
    $controller->login();
} elseif ($requestUri == '/login/authenticate' && $requestMethod == 'POST') {
    $controller = new UserController();
    $controller->authenticate();
} elseif ($requestUri == '/logout' && $requestMethod == 'GET') {
    $controller = new UserController();
    $controller->logout();
} else {
    // 404 Page
    echo "404 Not Found";
}
