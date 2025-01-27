<?php


session_start(); // Start the session

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: pages/home.php"); // Redirect logged-in users to the home page
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  SEO Title & Meta Description (Customize for Each Page) -->
    <title>GPT Lawyer - AI-Powered Legal Assistance</title>
    <meta name="description" content="GPT Lawyer provides AI-powered legal assistance for quick and professional legal advice. Get instant legal guidance with AI technology.">
    <meta name="keywords" content="AI lawyer, legal chatbot, GPT lawyer, legal advice, instant legal help, online legal service">
    <meta name="robots" content="index, follow">
    <meta name="author" content="GPT Lawyer Team">

    <!--  Open Graph Meta Tags (For Social Media Sharing) -->
    <meta property="og:title" content="GPT Lawyer - AI-Powered Legal Help">
    <meta property="og:description" content="Need legal assistance? GPT Lawyer provides instant AI-powered legal guidance.">
    
    <meta property="og:url" content="https://lawyergpt.rf.gd">
    <meta property="og:type" content="website">

    


    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="main-page">


<header>
        <nav class="navbar">
            <div class="logo"><a href="index.php">GPT Lawyer</a></div>
            <ul class="nav-links">
                <li><a href="index.php">Main</a></li>
                <li><a href="pages/about.php">About</a></li>
                <li><a href="pages/sign-in.php">Sign-In</a></li>
            </ul>
            <a href="pages/sign-up.php" class="btn-upgrade">Try LawyerGPT Now</a>
        </nav>
    </header>


<main class="hero">
    <img src="assets/images/3.png" alt="GPT Lawyer Logo" class="hero-logo">
    <div class="hero-content">
        <h1>Experience the Future of Legal Assistance</h1>
        <p>GPT Lawyer is not just another legal tool – it’s an exceptional solution. Discover the power of AI and unlock a new era of legal assistance. Embrace simplicity, efficiency, and confidence in your legal journey.</p>
        <p>GPT Lawyer – Shaping the Future</p>
        
        <!-- Bootstrap Button  -->
        <a href="pages/sign-up.php" class="btn btn-primary btn-lg">Try it now</a>
    </div>
</main>

<?php include('includes/footer.php'); ?>


<!-- Bootstrap JS  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
