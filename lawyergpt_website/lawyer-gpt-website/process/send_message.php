<?php


session_start();
include '../includes/db.php'; // Include database connection
include 'api_functions.php'; // Include API functions

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to send a message.']);
    exit();
}

// Get data from POST request
$data = json_decode(file_get_contents("php://input"), true);
$chat_id = $data['chat_id'];
$message = $data['message'];
$user_id = $_SESSION['user_id'];

// Insert the user message into the database
$stmt = $pdo->prepare("INSERT INTO messages (chat_id, user_id, role, content) VALUES (?, ?, 'user', ?)");
$stmt->execute([$chat_id, $user_id, $message]);

// Get AI response
$aiResponse = getAIResponse($message);

// Check if the response from AI is valid (it's an array)
if (isset($aiResponse['choices'][0]['message']['content'])) {
    $ai_response_content = $aiResponse['choices'][0]['message']['content'];
} else {
    $ai_response_content = "No valid response from AI.";
}

// Insert the AI's response into the database
$stmt = $pdo->prepare("INSERT INTO messages (chat_id, user_id, role, content) VALUES (?, ?, 'ai', ?)");
$stmt->execute([$chat_id, $user_id, $ai_response_content]);

// Return the AI response
echo json_encode(['success' => true, 'ai_response' => $ai_response_content]);
?>
