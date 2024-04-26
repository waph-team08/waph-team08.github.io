<?php
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve sender, receiver, and message from the form submission
    // Ensure that the sender's username is retrieved correctly
    session_start(); // Start the session to access logged-in user information
    if (isset($_SESSION['username'])) {
        $sender = $_SESSION['username'];
    } else {
        // Handle case where sender's username is not available
        echo "<script>alert('Error: Sender information not available');</script>";
        exit; // Terminate script execution
    }
    
    $receiver = $_POST['receiver'];
    $message = $_POST['message'];

    // Insert message into the messages table
    $query = "INSERT INTO messages (sender, receiver, message) VALUES ('$sender', '$receiver', '$message')";
    $result = mysqli_query($connection, $query); // Use $connection instead of $mysqli

    if ($result) {
        echo "<script>alert('Message sent successfully');</script>";
    } else {
        echo "<script>alert('Error: Unable to send message');</script>";
    }
}
?>
