// JavaScript code for sending and receiving messages
// Define functions for sending and receiving messages
function sendMessage() {
    // Retrieve selected receiver and message content
    var receiver = document.getElementById('receiver').value;
    var message = document.getElementById('message').value;

    // Send an AJAX request to the backend to save the message
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'send_message.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Message sent successfully, clear the input field
            document.getElementById('message').value = '';
            fetchMessages(); // Fetch updated messages after sending
        }
    };
    xhr.send('receiver=' + receiver + '&message=' + message);
}

// Function to update the chat box with incoming messages
function updateChat(messages) {
    var chatBox = document.getElementById('receivedMessages');
    chatBox.innerHTML = ''; // Clear previous messages

    messages.forEach(function (message) {
        var messageDiv = document.createElement('div');
        messageDiv.textContent = message.sender + ': ' + message.message;
        chatBox.appendChild(messageDiv);
    });
}

// Fetch and display messages periodically (you can implement this using AJAX polling or WebSocket)
// Example: setInterval(fetchMessages, 3000); // Fetch messages every 3 seconds

// Function to fetch messages from the server
function fetchMessages() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_messages.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var messages = JSON.parse(xhr.responseText);
            updateChat(messages);
        }
    };
    xhr.send();
}

// Call the fetchMessages function when the page loads
window.onload = function () {
    fetchMessages();
};
