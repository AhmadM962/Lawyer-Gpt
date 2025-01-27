<?php

session_start(); // Start the session

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: home.php"); // Redirect logged-in users to the home page
    exit(); // Make sure no further code is executed
}
?>
<?php
// Check if there is a message in the URL query string
if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']); // Sanitize message output
    echo "<div class='alert'>$message</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- SEO Title & Meta Description -->
<title>Sign Up for AI Legal Assistance | GPT Lawyer</title>
<meta name="description" content="Create an account on GPT Lawyer and start using AI-powered legal assistance to get instant legal guidance.">
<meta name="keywords" content="Sign up, register, create an account, GPT lawyer access, AI legal chatbot registration">
<meta name="robots" content="noindex, nofollow">
<meta name="author" content="GPT Lawyer Team">

<!-- Open Graph Meta Tags -->
<meta property="og:title" content="Sign Up - GPT Lawyer">
<meta property="og:description" content="Create an account and access GPT Lawyer's AI-powered legal chatbot for instant legal advice.">
<meta property="og:url" content="https://lawyergpt.rf.gd/sign-in.php">
    <meta property="og:type" content="website">
<meta property="og:type" content="website">

    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body class="sign-up-page" id="sign-up-page">

<?php include '../includes/header.php'; ?>
   
    
    <main class="sign-up" >
        <section class="form-container">
            <h1>Create Your Account</h1>
            <p>Join GPT Lawyer today and experience the future of legal assistance!</p>
            <form id="sign-up-form" action="../process/process-signup.php" method="POST">
                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="first-name" placeholder="Enter your first name" required>

                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="last-name" placeholder="Enter your last name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Create a password" minlength="6" required>
                <button type="submit" class="btn-primary">Sign Up</button>
            </form>
            <p>Already have an account? <a href="sign-in.php">Sign In</a></p>
        </section>
    </main>

<?php include('../includes/footer.php'); ?>
