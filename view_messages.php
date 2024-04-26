<?php
include('db_connection.php');

// Replace "receiver_username" with the actual method of retrieving the receiver's username
$receiver = "chris"; // Placeholder for receiver's username

// Prepare the query using a prepared statement
$query = "SELECT sender, message, sent_at FROM messages WHERE receiver = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "s", $receiver);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<div class='message-container'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='message'>";
        echo "<div class='sender'>" . htmlspecialchars($row['sender']) . "</div>";
        echo "<div class='content'>" . htmlspecialchars($row['message']) . "</div>";
        echo "<div class='time'>" . $row['sent_at'] . "</div>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p>No messages received.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .message-container {
    max-width: 400px;
    margin: 20px auto;
}

.message {
    display: flex;
    align-items: center;
    background-color: #f0f2f5;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 10px;
}

.sender {
    font-weight: bold;
    color: #1877f2;
    margin-right: 10px;
}

.content {
    flex: 1;
    margin-right: 10px;
}

.time {
    font-size: 12px;
    color: #666;
}

    </style>    

</head>
<body>
   
    
</body>
</html>