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
    // No environment file found
}

// Determine the environment (local or cloud)
$isCloudEnv = getenv('CLOUD_ENV') ?: false;

// Local environment settings
$host = $_ENV['DB_HOST'] ?? null;
$db   = $_ENV['MYSQL_DATABASE'] ?? null;
$user = $_ENV['MYSQL_USER'] ?? null;
$pass = $_ENV['MYSQL_PASSWORD'] ?? null;


if ($isCloudEnv) {
    // Cloud environment settings
    $host = $_ENV['AZURE_MYSQL_DBHOST'];
    $db   = $_ENV['AZURE_MYSQL_DBNAME'];
    $user = $_ENV['AZURE_MYSQL_USERNAME'];
    $pass = $_ENV['AZURE_MYSQL_PASSWORD'];
}
$charset = 'utf8mb4';

if (!$host) {
    throw new InvalidPathException('DB_HOST is not set' . $isCloudEnv);
}
if (!$db) {
    throw new InvalidPathException('MYSQL_DATABASE is not set');
}
if (!$user) {
    throw new InvalidPathException('MYSQL_USER is not set');
}
if (!$pass) {
    throw new InvalidPathException('MYSQL_PASSWORD is not set');
}

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::MYSQL_ATTR_SSL_CA       => '/path/to/ca-cert.pem',
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false, // Set to true if you want to verify server certificate
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
