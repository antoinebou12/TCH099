<?php
include __DIR__.'/../utils/utils.php';

header("Content-Type: application/json");

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';
    $email = $data['email'] ?? '';
    $role = $data['role'] ?? 'client';

    // Check if the username already exists
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        $response['status'] = 'error';
        $response['message'] = 'Username already taken';
    } else {
        // Register the new user
        if (registerUser($username, $password, $email, '', $role)) {
            $response['status'] = 'success';
            $response['message'] = 'Signup successful';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error creating account';
        }
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
?>
