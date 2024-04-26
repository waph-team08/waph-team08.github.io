<?php
require_once('database.php');

// Fetch usernames from the database
$usernames = [];
$query = "SELECT username FROM users";
$result = $mysqli->query($query);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $usernames[] = $row['username'];
    }
    $result->free();
}

// Send the usernames as JSON response
header('Content-Type: application/json');
echo json_encode($usernames);
?>
