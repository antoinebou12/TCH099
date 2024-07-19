<?php
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
} catch (InvalidPathException $e) {
    // Handle the case where .env file is not found
    error_log('No .env file found. Continuing without loading environment variables from .env file.');
}

$host = getenv('DB_HOST') ?: getenv('AZURE_MYSQL_HOST');
$db   = getenv('MYSQL_DATABASE') ?: getenv('AZURE_MYSQL_DBNAME');
$user = getenv('MYSQL_USER') ?: getenv('AZURE_MYSQL_USERNAME');
$pass = getenv('MYSQL_PASSWORD') ?: getenv('AZURE_MYSQL_PASSWORD');
$charset = 'utf8mb4';

if (!$host || !$db || !$user || !$pass) {
    throw new \Exception('Database connection information is not complete.');
}

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
