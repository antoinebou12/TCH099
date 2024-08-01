<?php
// Check for vendor autoload
if (!file_exists(__DIR__.'/vendor/autoload.php')) {
    throw new Exception('vendor/autoload.php not found. Did you run composer install?');
}

require_once __DIR__.'/vendor/autoload.php';

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
    die('Could not find the .env file. Please make sure it exists in the root directory.');
}

// Determine the environment (local or cloud)
$isCloudEnv = getenv('CLOUD_ENV') == 'true';

// Local environment settings
$host = getenv('DB_HOST');
$db   = getenv('MYSQL_DATABASE');
$user = getenv('MYSQL_USER');
$pass = getenv('MYSQL_PASSWORD');
$port = getenv('DB_PORT') ?: '3306';

if ($isCloudEnv) {
    // Cloud environment settings
    $host = getenv('AZURE_MYSQL_HOST') ?: $host;
    $db   = getenv('AZURE_MYSQL_DBNAME') ?: $db;
    $user = getenv('AZURE_MYSQL_USERNAME') ?: $user;
    $pass = getenv('AZURE_MYSQL_PASSWORD') ?: $pass;
    $port = getenv('AZURE_MYSQL_PORT') ?: '3306';
}
$charset = 'utf8mb4';

// Validate essential environment variables
if (!$host) {
    throw new InvalidPathException('DB_HOST is not set. Current environment: ' . ($isCloudEnv ? 'Cloud' : 'Local'));
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

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
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

// .env file has been loaded and database connection is established
