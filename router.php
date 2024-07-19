<?php

// Error handling
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Access Control Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Check for vendor autoload
if (!file_exists(__DIR__.'/vendor/autoload.php')) {
    throw new Exception('vendor/autoload.php not found. Did you run composer install?');
}

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/api/utils/utils.php';

// Define routing functions
function get($route, $path_to_include) {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        route($route, $path_to_include);
    }
}

function post($route, $path_to_include) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        route($route, $path_to_include);
    }
}

function put($route, $path_to_include) {
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        route($route, $path_to_include);
    }
}

function patch($route, $path_to_include) {
    if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
        route($route, $path_to_include);
    }
}

function delete($route, $path_to_include) {
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        route($route, $path_to_include);
    }
}

function any($route, $path_to_include) {
    route($route, $path_to_include);
}

function route($route, $path_to_include) {
    $callback = $path_to_include;

    // Normalize route and request URL
    $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
    $request_url = rtrim($request_url, '/');
    $request_url = strtok($request_url, '?');

    // Check if the route contains dynamic parameters or wildcards
    if (strpos($route, '$') !== false || strpos($route, '*') !== false) {
        // Handle wildcards
        if (strpos($route, '*') !== false) {
            $route_pattern = str_replace('*', '.*', $route);
            if (preg_match('#^' . $route_pattern . '$#', $request_url, $matches)) {
                // Handle dynamic parameters in the route
                $route_parts = explode('/', $route);
                array_shift($route_parts); // Remove leading empty string
                foreach ($route_parts as $i => $part) {
                    if (preg_match("/^\$/", $part)) {
                        $param_name = ltrim($part, '$');
                        $$param_name = $matches[$i + 1]; // $i + 1 because $matches[0] is the full match
                    }
                }
                if (is_callable($callback)) {
                    call_user_func_array($callback, array_slice($matches, 1));
                    exit();
                }
                include_once __DIR__ . "/$path_to_include";
                exit();
            }
            return; // If not matched, exit function
        }

        // Handle dynamic parameters
        $route_parts = explode('/', $route);
        $request_url_parts = explode('/', $request_url);
        array_shift($route_parts); // Remove leading empty string
        array_shift($request_url_parts); // Remove leading empty string
        
        if (count($route_parts) != count($request_url_parts)) {
            return;
        }
        
        $parameters = [];
        for ($i = 0; $i < count($route_parts); $i++) {
            $route_part = $route_parts[$i];
            if (preg_match("/^\$/", $route_part)) {
                $param_name = ltrim($route_part, '$');
                array_push($parameters, $request_url_parts[$i]);
                $$param_name = $request_url_parts[$i];
            } else if ($route_parts[$i] != $request_url_parts[$i]) {
                return;
            }
        }
        
        if (is_callable($callback)) {
            call_user_func_array($callback, $parameters);
            exit();
        }
        include_once __DIR__ . "/$path_to_include";
        exit();
    }

    // Handle static routes
    if ($route == $request_url) {
        if (is_callable($callback)) {
            call_user_func_array($callback, []);
            exit();
        }
        include_once __DIR__ . "/$path_to_include";
        exit();
    }
}

function out($text) {
    echo htmlspecialchars($text);
}

function set_csrf() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION["csrf"])) {
        $_SESSION["csrf"] = bin2hex(random_bytes(50));
    }
    echo '<input type="hidden" name="csrf" value="' . $_SESSION["csrf"] . '">';
}

function is_csrf_valid() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['csrf']) || !isset($_POST['csrf'])) {
        return false;
    }
    if ($_SESSION['csrf'] != $_POST['csrf']) {
        return false;
    }
    return true;
}

// Custom error handler to nicely format errors
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
        return;
    }
    switch ($errno) {
        case E_USER_ERROR:
            echo "<b>ERROR</b> [$errno] $errstr<br />\n";
            echo "  Fatal error on line $errline in file $errfile";
            echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
            echo "Aborting...<br />\n";
            exit(1);
            break;

        case E_USER_WARNING:
            echo "<b>WARNING</b> [$errno] $errstr<br />\n";
            break;

        case E_USER_NOTICE:
            echo "<b>NOTICE</b> [$errno] $errstr<br />\n";
            break;

        default:
            echo "Unknown error type: [$errno] $errstr<br />\n";
            break;
    }

    /* Don't execute PHP internal error handler */
    return true;
});

// Custom exception handler to nicely format exceptions
set_exception_handler(function($exception) {
    echo "<b>Exception:</b> " . $exception->getMessage() . "<br />";
    echo "In file: " . $exception->getFile() . " on line " . $exception->getLine() . "<br />";
});

// Function to handle shutdown and catch fatal errors
register_shutdown_function(function() {
    $error = error_get_last();
    if ($error && ($error['type'] === E_ERROR || $error['type'] === E_PARSE)) {
        echo "<b>Fatal Error:</b> " . $error['message'] . "<br />";
        echo "In file: " . $error['file'] . " on line " . $error['line'] . "<br />";
    }
});

function serve_static_file($directory, $mimeType, $path) {
    $filePath = __DIR__ . $directory . '/' . $path;
    if (file_exists($filePath)) {
        header('Content-Type: ' . $mimeType);
        readfile($filePath);
        exit();
    } else {
        include_once __DIR__ . '/frontend/pages/404.html';
        exit();
    }
}
