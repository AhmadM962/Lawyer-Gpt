<?php


session_start();
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // Password should not be sanitized; it's hashed and compared

    if (empty($email) || empty($password)) {
        echo "Please fill in all fields!";
        exit();
    }

    try {
        // Fetch user from the database
        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password and handle login
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; // Store user ID in session
            header("Location: ../pages/home.php");
            exit();
        } else {
            echo "Invalid email or password!";
            exit();
        }
    } catch (PDOException $e) {
        // Log error and display user-friendly message
        error_log("Database error: " . $e->getMessage());
        echo "An error occurred. Please try again later.";
        exit();
    }
}
?>
