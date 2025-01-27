
<?php


session_start();
include '../includes/db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to edit a chat.']);
    exit();
}

$chat_id = $_POST['chat_id'] ?? null;
$chat_name = $_POST['chat_name'] ?? null;
$user_id = $_SESSION['user_id'];

if (!$chat_id || !$chat_name) {
    echo json_encode(['success' => false, 'message' => 'Missing chat ID or name.']);
    exit();
}

// Debugging log
error_log("Editing chat: Chat ID: $chat_id, New Name: $chat_name, User ID: $user_id");

$stmt = $pdo->prepare("UPDATE chats SET chat_name = ? WHERE id = ? AND user_id = ?");
if ($stmt->execute([$chat_name, $chat_id, $user_id])) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database update failed']);
}
?>
