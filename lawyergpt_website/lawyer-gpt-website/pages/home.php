<?php


session_start();
include '../includes/db.php'; // Database connection

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/sign-in.php?message=Please%20log%20in%20to%20continue");
    exit();
}

// Fetch chat history for the logged-in user
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT id, chat_name FROM chats WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$chats = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- SEO Title & Meta Description -->
<title>AI Legal Chat - Get Instant Legal Answers | GPT Lawyer</title>
<meta name="description" content="Chat with GPT Lawyer, an AI-powered legal assistant, to get instant legal guidance on business, contracts, and personal legal matters.">
<meta name="keywords" content="AI legal chat, instant legal help, GPT lawyer chatbot, AI-powered legal assistance">
<meta name="robots" content="home, follow">
<meta name="author" content="GPT Lawyer Team">

<!-- Open Graph Meta Tags -->
<meta property="og:title" content="GPT Lawyer - AI Legal Chatbot">
<meta property="og:description" content="Chat with an AI-powered legal assistant and get instant legal guidance on various topics.">
<meta property="og:url" content="http://lawyergpt.online/home.php">
    <meta property="og:type" content="website">
<meta property="og:type" content="website">

    
    <link rel="stylesheet" href="../assets/css/styles.css">
    
</head>
<body class="home-page">

<?php include '../includes/header-auth.php'; ?>

<main class="chat-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <button id="add-chat-btn">+ Add New Chat</button>
        <h3>History</h3>
        <ul class="chat-history" id="chat-history">
            <?php if ($chats): ?>
                <?php foreach ($chats as $chat): ?>
                    <li data-chat-id="<?php echo $chat['id']; ?>">
                        <span><?php echo htmlspecialchars($chat['chat_name']); ?></span>
                        <button class="edit-btn" data-chat-id="<?php echo $chat['id']; ?>">✏️</button>
                        <button class="delete-btn" data-chat-id="<?php echo $chat['id']; ?>">🗑️</button>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No chat history found.</li>
            <?php endif; ?>
        </ul>
    </aside>

    <!-- Chat Section -->
    <section class="chat-section">
        <div class="chat-box" id="chat-box">
            <div>Please select a chat from the sidebar to view messages.</div>
        </div>
        <div class="chat-input" id="chat-input">
            <input type="text" placeholder="Type your inquiry" id="user-message" />
            <button id="send-message" disabled>➡️</button>
        </div>
    </section>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const chatHistory = document.getElementById('chat-history');
        const chatBox = document.getElementById('chat-box');
        const sendMessageButton = document.getElementById('send-message');
        const messageInput = document.getElementById('user-message');

        // Enable Enter key for sending messages
        messageInput.addEventListener("keypress", function (event) {
            if (event.key === "Enter" && !sendMessageButton.disabled) {
                event.preventDefault();
                sendMessageButton.click();
            }
        });

        // Auto-scroll chat box
        function scrollChatToBottom() {
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        // Highlight active chat and load messages
        chatHistory.addEventListener('click', function (e) {
            let listItem = e.target.closest('li');
            if (!listItem) return;

            document.querySelectorAll('.chat-history li').forEach(item => item.classList.remove('active-chat'));
            listItem.classList.add('active-chat');

            sendMessageButton.disabled = false; // Enable send button
            const chatId = listItem.dataset.chatId;
            loadChatMessages(chatId);
        });

        // Load chat messages with a loading effect
        function loadChatMessages(chatId) {
            chatBox.innerHTML = `<div class="loading">Loading...</div>`;

            fetch(`../process/get_chat_messages.php?chat_id=${chatId}`)
                .then(response => response.json())
                .then(data => {
                    chatBox.innerHTML = '';
                    if (data.success) {
                        data.messages.forEach(message => {
                            const messageDiv = document.createElement('div');
                            messageDiv.classList.add('message', message.role);
                            messageDiv.innerText = `${message.role === 'user' ? 'User' : 'AI'}: ${message.content}`;
                            chatBox.appendChild(messageDiv);
                        });
                    } else {
                        chatBox.innerHTML = '<div>No messages in this chat.</div>';
                    }
                    scrollChatToBottom();
                })
                .catch(() => chatBox.innerHTML = '<div>Error loading messages.</div>');
        }

        // Add new chat functionality
        document.getElementById('add-chat-btn').addEventListener('click', function () {
            fetch('../process/add_chat.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ chat_name: 'New Chat' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const newChat = document.createElement('li');
                    newChat.dataset.chatId = data.chat_id;
                    newChat.innerHTML = `
                        <span>New Chat</span>
                        <button class="edit-btn" data-chat-id="${data.chat_id}">✏️</button>
                        <button class="delete-btn" data-chat-id="${data.chat_id}">🗑️</button>
                    `;
                    chatHistory.appendChild(newChat);
                } else {
                    alert(data.message || 'Error adding chat');
                }
            });
        });

        // Edit and Delete chat functionality
        chatHistory.addEventListener('click', function (e) {
            const chatId = e.target.getAttribute('data-chat-id');

            if (e.target.classList.contains('edit-btn')) {
                const chatItem = e.target.parentElement;
                const currentName = chatItem.querySelector('span').innerText;
                const newChatName = prompt("Enter new chat name", currentName);

                if (newChatName && newChatName !== currentName) {
                    fetch('../process/edit_chat.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `chat_id=${chatId}&chat_name=${encodeURIComponent(newChatName)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            chatItem.querySelector('span').innerText = newChatName;
                        } else {
                            alert(data.message || 'Error editing chat');
                        }
                    });
                }
            }

            if (e.target.classList.contains('delete-btn')) {
                if (confirm("Are you sure you want to delete this chat?")) {
                    fetch('../process/delete_chat.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `chat_id=${chatId}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            e.target.parentElement.remove();
                        } else {
                            alert(data.message || 'Error deleting chat');
                        }
                    });
                }
            }
        });

        // Send message functionality
        sendMessageButton.addEventListener('click', function () {
            const message = messageInput.value;
            const activeChat = document.querySelector('.chat-history .active-chat');
            if (!message || !activeChat) return;

            const chatId = activeChat.dataset.chatId;
            messageInput.value = '';

            const userMessage = document.createElement('div');
            userMessage.classList.add('message', 'user');
            userMessage.innerText = `User: ${message}`;
            chatBox.appendChild(userMessage);
            scrollChatToBottom();

            fetch('../process/send_message.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message: message, chat_id: chatId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const aiMessage = document.createElement('div');
                    aiMessage.classList.add('message', 'ai');
                    aiMessage.innerText = `AI: ${data.ai_response}`;
                    chatBox.appendChild(aiMessage);
                    scrollChatToBottom();
                } else {
                    alert(data.message || 'Error sending message');
                }
            });
        });
    });
</script>

</body>
</html>
