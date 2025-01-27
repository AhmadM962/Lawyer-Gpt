<?php


session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to sign-up page with a query string message
    header("Location: sign-up.php?message=Please%20log%20in%20to%20continue");
    exit();
}
?>
<?php
session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to the login page or home page
header("Location: sign-in.php"); 
exit;
?>
