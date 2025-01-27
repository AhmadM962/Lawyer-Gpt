<?php


session_start();
include '../includes/db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to view messages.']);
    exit();
}

// Get chat_id from GET parameters
$chat_id = $_GET['chat_id'];
$user_id = $_SESSION['user_id'];

// Fetch all messages for the chat
$stmt = $pdo->prepare("SELECT role, content FROM messages WHERE chat_id = ? ORDER BY created_at ASC");
$stmt->execute([$chat_id]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if messages exist
if ($messages) {
    echo json_encode(['success' => true, 'messages' => $messages]);
} else {
    echo json_encode(['success' => false, 'message' => 'No messages found for this chat.']);
}
?>
