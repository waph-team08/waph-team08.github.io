<?php
// Function to sanitize input
function sanitize_input($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Include database connection
require_once 'database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitize_input($_POST["name"]);
    $username = sanitize_input($_POST["username"]);
    $email = sanitize_input($_POST["email"]);
    $password = sanitize_input($_POST["password"]);
    $confirm_password = sanitize_input($_POST["confirm_password"]);

    // Check if any fields are empty
    if (empty($name) ||empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "All fields are required.";
        exit;
    }

    // Check if password and confirm password match
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the password before storing in database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Call addnewuser function from database.php to insert new user
    if (addnewuser($name, $username, $hashed_password, $email)) {
        echo "User registered successfully.";

        // Redirect to login page
        header("Location: form.php");
        exit;
    } else {
        echo "Error registering user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Mini Facebook</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
</body>
</html>   