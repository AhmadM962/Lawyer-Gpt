

<?php


session_start();
include '../includes/db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please log in to continue']);
    exit();
}

$chat_id = $_POST['chat_id'] ?? null;
$user_id = $_SESSION['user_id'];

if (!$chat_id || !is_numeric($chat_id)) {
    echo json_encode(['success' => false, 'message' => 'Invalid or missing chat ID']);
    exit();
}

// Debugging log
error_log("Deleting chat: Chat ID: $chat_id, User ID: $user_id");

try {
    // Delete related messages first
    $stmt = $pdo->prepare("DELETE FROM messages WHERE chat_id = ? AND chat_id IN (SELECT id FROM chats WHERE user_id = ?)");
    $stmt->execute([$chat_id, $user_id]);

    // Now delete the chat
    $stmt = $pdo->prepare("DELETE FROM chats WHERE id = ? AND user_id = ?");
    $stmt->execute([$chat_id, $user_id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Chat deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No chat found or permission issue']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>
