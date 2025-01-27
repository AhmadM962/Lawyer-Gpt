<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../assets/css/styles.css">
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- SEO Title & Meta Description -->
<title>About GPT Lawyer - AI-Powered Legal Assistance</title>
<meta name="description" content="Learn about GPT Lawyer, an AI-powered legal assistant that provides instant legal guidance for individuals and businesses.">
<meta name="keywords" content="About GPT Lawyer, AI legal chatbot, AI-powered legal assistance">
<meta name="robots" content="index, follow">
<meta name="author" content="GPT Lawyer Team">

<!-- Open Graph Meta Tags -->
<meta property="og:title" content="About GPT Lawyer">
<meta property="og:description" content="Learn about GPT Lawyer's mission and how AI-powered legal assistance is changing the legal industry.">
<meta property="og:url" content="https://lawyergpt.rf.gd/about.php">
    <meta property="og:type" content="website">
<meta property="og:type" content="website">

</head>

<body class="about-page">
    
<?php


session_start(); // Start the session to check if the user is logged in

if (isset($_SESSION['user_id'])) {
    // If the user is logged in, include the logged-in header
    include('../includes/header-auth.php');
} else {
    // If the user is not logged in, include the logged-out header
    include('../includes/header.php');
}
?>

    <main class="about">
        <section class="about-hero">
            <h1>About GPT Lawyer</h1>
            <p>Your partner in redefining the legal landscape through the power of AI.</p>
        </section>

        <section class="about-content">
            <div class="content-block">
                <h2>Our Mission</h2>
                <p>To empower individuals and businesses with accessible, efficient, and reliable legal assistance through cutting-edge AI technology.</p>
            </div>

            <div class="content-block">
                <h2>Why Choose Us?</h2>
                <ul>
                    <li>Instant access to legal insights</li>
                    <li>Cost-effective solutions for legal needs</li>
                    <li>User-friendly, intuitive design</li>
                    <li>Powered by advanced GPT AI technology</li>
                </ul>
            </div>

            <div class="content-block">
                <h2>Our Vision</h2>
                <p>We envision a future where legal services are democratized, bridging the gap between people and justice with innovative solutions.</p>
            </div>
        </section>

        <section class="cta">
            <h2>Ready to Experience the Future of Legal Assistance?</h2>
            <a href="sign-up.php" class="btn-primary">Get Started</a>
        </section>
    </main>

    <?php include('../includes/footer.php'); ?>
