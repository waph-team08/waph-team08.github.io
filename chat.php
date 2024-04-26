<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        
        <div class="chat-area">
            <div class="chat-header">
                <h2>Web Chat</h2>
            </div>
            <div class="message-container">
                <!-- Messages will be displayed here -->
            </div>
            <form class="message-input" method="post" action="send_message.php">
                <input type="text" id="message" name="message" placeholder="Type a message...">
                <select id="receiver" name="receiver">
                    <!-- Dropdown options will be populated dynamically -->
                    
                </select>
                <button type="submit">Send</button>
            </form>
        </div>
        <form method="get" action="view_messages.php">
        <button id="view">View Messages</button>
        </form>
    </div>
    <script>
        // Function to fetch usernames and populate the dropdown menu
        function populateDropdown() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_usernames.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var usernames = JSON.parse(xhr.responseText);
                    var select = document.getElementById('receiver');
                    usernames.forEach(function (username) {
                        var option = document.createElement('option');
                        option.value = username;
                        option.textContent = username;
                        select.appendChild(option);
                    });
                }
            };
            xhr.send();
        }

        // Call the populateDropdown function when the page loads
        window.onload = function () {
            populateDropdown();
        };
    </script>
</body>
</html>
