<?php
include('db_connection.php');

// Fetch usernames from the users table
$query = "SELECT username FROM users WHERE status = 1"; // Assuming status 1 means active users
$result = mysqli_query($connection, $query);

// Check if query was successful
if ($result) {
    // Iterate through each row and create an option for the dropdown menu
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['username'] . "'>" . $row['username'] . "</option>";
    }
} else {
    // Handle error
    echo "<option value=''>Error: Unable to fetch users</option>";
}
?>
