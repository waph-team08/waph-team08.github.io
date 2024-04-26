<?php
session_start();

// Check if the user is logged in as a super user
if (!isset($_SESSION['super_user']) || $_SESSION['super_user'] !== true) {
    // If not, redirect to the login page
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["action"])) {
    require_once "database.php";

    $username = $_POST["username"];
    $action = $_POST["action"];

    // Update user status based on the action
    if ($action === "enable") {
        $sql = "UPDATE users SET status = 1 WHERE username = ?";
    } elseif ($action === "disable") {
        $sql = "UPDATE users SET status = 0 WHERE username = ?";
    }

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $username);
    if ($stmt->execute()) {
        // Redirect back to dashboard after successful update
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $mysqli->error;
    }

    $stmt->close();
    $mysqli->close();
} else {
    // Redirect back to dashboard if accessed directly without POST request or missing parameters
    header("Location: dashboard.php");
    exit();
}
?>
