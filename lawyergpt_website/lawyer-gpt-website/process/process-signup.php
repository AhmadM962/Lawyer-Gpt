<?php


session_start();
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $firstName = filter_input(INPUT_POST, 'first-name', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'last-name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // Password is hashed later, so no sanitization needed here

    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        echo "All fields are required!";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Check if the email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            echo "Email already exists!";
            exit;
        }

        // Insert new user
        $stmt = $pdo->prepare(
            "INSERT INTO users (first_name, last_name, email, password) 
            VALUES (:first_name, :last_name, :email, :password)"
        );

        $isInserted = $stmt->execute([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        if ($isInserted) {
            $_SESSION['user_id'] = $pdo->lastInsertId(); // Set session variable for the logged-in user
            header("Location: ../pages/home.php");
            exit;
        } else {
            echo "Error: Unable to register";
        }
    } catch (PDOException $e) {
        // Log the error and display a generic message to the user
        error_log("Database error: " . $e->getMessage());
        echo "An error occurred. Please try again later.";
        exit;
    }
}
?>
