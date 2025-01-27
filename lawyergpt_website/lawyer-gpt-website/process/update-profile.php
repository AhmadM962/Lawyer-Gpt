<?php


session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$password = $_POST['password'];

// Update user data
$query = "UPDATE users SET first_name = :first_name, last_name = :last_name";
$params = [
    'first_name' => $firstName,
    'last_name' => $lastName,
    'user_id' => $userId
];

if (!empty($password)) {
    $query .= ", password = :password";
    $params['password'] = password_hash($password, PASSWORD_BCRYPT);
}

$query .= " WHERE id = :user_id";

$stmt = $pdo->prepare($query);
$stmt->execute($params);

header("Location: ../pages/dashboard.php");
exit();
