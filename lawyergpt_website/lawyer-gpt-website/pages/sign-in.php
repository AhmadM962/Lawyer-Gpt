<?php


// Check if there is a message in the URL query string
if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']); // Sanitize message output
    echo "<div class='alert'>$message</div>";
}
?>
<?php


session_start(); // Start the session

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: home.php"); // Redirect logged-in users to the home page
    exit(); // Make sure no further code is executed
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
<title>Sign In - Access AI Legal Assistance | GPT Lawyer</title>
<meta name="description" content="Sign in to GPT Lawyer and start using AI-powered legal assistance for quick and professional legal guidance.">
<meta name="keywords" content="Sign in, login, GPT lawyer access, AI legal chatbot login">
<meta name="robots" content="noindex, nofollow">
<meta name="author" content="GPT Lawyer Team">

<!-- Open Graph Meta Tags -->
<meta property="og:title" content="Sign In - GPT Lawyer">
<meta property="og:description" content="Sign in to access GPT Lawyer's AI-powered legal chatbot for instant legal guidance.">
<meta property="og:url" content="https://lawyergpt.rf.gd/sign-in.php">
    <meta property="og:type" content="website">
<meta property="og:type" content="website">

    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body class="sign-in-page">
<?php include '../includes/header.php'; ?>

    <main class="sign-in">
        <section class="form-container">
            <h1>Welcome Back</h1>
            <p>Sign in to access your account and legal tools.</p>
            <form action="../process/process-signin.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>

                <button type="submit" class="btn-primary">Sign In</button>
            </form>
            <p>Don’t have an account? <a href="sign-up.php">Sign Up</a></p>
        </section>
    </main>

    <?php include('../includes/footer.php'); ?>