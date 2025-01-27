

<?php


session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];

    try {
        // Begin transaction
        $pdo->beginTransaction();

        // Delete all chats related to the user
        $stmt = $pdo->prepare("DELETE FROM chats WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);

        // Delete the user account
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :user_id");
        $stmt->execute(['user_id' => $user_id]);

        // Commit transaction
        $pdo->commit();

        // Destroy session and redirect to signup/login page
        session_destroy();
        header("Location: ../pages/sign-up.php?message=Account deleted successfully.");
        exit();
    } catch (Exception $e) {
        // Rollback transaction on error
        $pdo->rollBack();
        die("Error deleting account: " . $e->getMessage());
    }
}
?>
