<?php
session_start();
require_once(__DIR__ . "/../utils/utils.php");

header("Content-Type: application/json");

if (isset($_SESSION['user_loggedin']) && $_SESSION['user_details']['role'] === 'admin') {
    try {
        global $pdo; // Ensure the global $pdo is accessible here
        $stmt = $pdo->prepare('SELECT * FROM Clients WHERE username = ?');
        $stmt->execute();
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'status' => 'success',
            'data' => $clients
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Database error: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Access denied',
        'redirect' => '/'
    ]);
}
?>
