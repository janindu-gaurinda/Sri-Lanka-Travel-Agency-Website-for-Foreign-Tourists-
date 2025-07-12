<?php
session_start();
require_once 'config/config.php';

// Get controller and action from URL (defaults to Home/index)
$controller = isset($_GET['controller']) ? ucfirst(strtolower($_GET['controller'])) : 'Home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Construct controller file path
$controllerFile = __DIR__ . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . $controller . 'Controller.php';

// Check if controller file exists
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    $controllerClass = $controller . 'Controller';

    // Check if class exists
    if (class_exists($controllerClass)) {
        $controllerObject = new $controllerClass();

        // Check if action method exists
        if (method_exists($controllerObject, $action)) {
            $controllerObject->$action();
            exit;
        } else {
            // Method not found
            require_once __DIR__ . '/views/404.php';
            exit;
        }
    } else {
        // Controller class not found
        require_once __DIR__ . '/views/404.php';
        exit;
    }
} else {
    // Controller file not found
    require_once __DIR__ . '/views/404.php';
    exit;
}
