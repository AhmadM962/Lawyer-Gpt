

<?php


session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'You must be logged in to add a chat.']);
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $chat_name = $_POST['chat_name'] ?? 'New Chat';

    // Insert new chat
    $stmt = $pdo->prepare("INSERT INTO chats (user_id, chat_name) VALUES (?, ?)");
    if ($stmt->execute([$user_id, $chat_name])) {
        echo json_encode(['success' => true, 'chat_id' => $pdo->lastInsertId()]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add chat.']);
    }
}
?>
