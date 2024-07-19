<?php
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Démarrage de la session
session_start();

// Vérification si l'utilisateur est connecté, sinon redirection vers la page de connexion
if ((!isset($gPublic) || !$gPublic) && !isset($_SESSION["usager"])) {
    header("Location: login.php");
    exit;
} elseif (isset($_SESSION["usager"])) {
    // Obtention de l'ID de l'utilisateur connecté
    $gUserId = $_SESSION["usager"];
} else { // Usager pas authentifié mais la page est publique
    $gUserId = 0;
}

if (isset($_GET["logout"])) {
    unset($_SESSION['usager']);
    header("Location: login.php");
    exit;
}

// Configuration et connexion à la base de données
$host = $_ENV['DB_HOST'];
$db   = $_ENV['MYSQL_DATABASE'];
$user = $_ENV['MYSQL_USER'];
$pass = $_ENV['MYSQL_PASSWORD'];
$charset = 'utf8mb4';

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

// Example query to test the connection
try {
    $stmt = $pdo->query('SELECT * FROM some_table');
    while ($row = $stmt->fetch()) {
        echo $row['column_name'] . '<br>';
    }
} catch (\PDOException $e) {
    echo "Error executing query: " . $e->getMessage();
}
