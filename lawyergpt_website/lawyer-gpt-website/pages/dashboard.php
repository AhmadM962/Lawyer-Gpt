<?php


session_start();
include '../includes/db.php'; // Ensure the database connection file path is correct

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/sign-in.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch user data
$stmt = $pdo->prepare("SELECT first_name, last_name, email FROM users WHERE id = :user_id");
$stmt->execute(['user_id' => $userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found!";
    exit();
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
<title>User Dashboard - Manage Your Legal Assistance | GPT Lawyer</title>
<meta name="description" content="Access your user dashboard on GPT Lawyer to manage your AI-powered legal chats and history.">
<meta name="keywords" content="User dashboard, manage legal chats, AI legal chatbot dashboard">
<meta name="robots" content="noindex, nofollow">
<meta name="author" content="GPT Lawyer Team">

<!-- Open Graph Meta Tags -->
<meta property="og:title" content="GPT Lawyer - User Dashboard">
<meta property="og:description" content="Manage your AI-powered legal assistance and chat history in your GPT Lawyer dashboard.">
<meta property="og:url" content="https://lawyergpt.rf.gd/dashboard.php">
    <meta property="og:type" content="website">
<meta property="og:type" content="website">

    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body class="dashboard-page">
    
<?php include '../includes/header-auth.php'; ?>
    <main class="dashboard">
        <h1>Welcome, <?= htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?>!</h1>
        <section class="form-container">
            <form action="../process/update-profile.php" method="POST">
                <h2>Update Your Profile</h2>
                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="first_name" value="<?= htmlspecialchars($user['first_name']); ?>" required>

                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="last_name" value="<?= htmlspecialchars($user['last_name']); ?>" required>

                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter a new password">

                <button type="submit" class="btn-primary">Save Changes</button>
            </form>

            <form action="../process/delete-account.php" method="POST" class="delete-account-form">
                <h2>Delete Your Account</h2>
                <p><strong>Warning:</strong> This action is irreversible!</p>
                <button type="submit" class="btn-danger">Delete Account</button>
            </form>
        </section>
    </main>

    <?php include('../includes/footer.php'); ?>
</body>
</html>
