<?php
session_start();
include __DIR__.'/../config.php';

function loginUser($username, $password) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_loggedin'] = $user['id'];
        $_SESSION['user_details'] = [
            'username' => $user['username'],
            'email' => $user['email'],
            'phone' => $user['phone'],
            'role' => $user['role']
        ];
        return true;
    }
    return false;
}

function registerUser($username, $password, $email, $phone, $role) {
    global $pdo;
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO users (username, password, email, phone, role) VALUES (?, ?, ?, ?, ?)');
    return $stmt->execute([$username, $passwordHash, $email, $phone, $role]);
}

function isUserLoggedIn() {
    return isset($_SESSION['user_loggedin']);
}

function logoutUser() {
    session_unset();
    session_destroy();
}

function redirectIfNotLoggedIn() {
    if (!isUserLoggedIn()) {
        header('Location: ../login.html');
        exit();
    }
}

function isAdmin() {
    if (isset($_SESSION['user_details']) && $_SESSION['user_details']['role'] === 'admin') {
        return true;
    }
    return false;
}

?>
