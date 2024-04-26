<?php
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: form.php");
    exit;
}

require "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comment"]) && isset($_POST["postID"])) {
    $comment = $_POST["comment"];
    $postID = $_POST["postID"];
    $commenter = $_SESSION["username"];

    if (addComment($postID, $commenter, $comment)) {
        echo "<script>alert('Comment added successfully');</script>";
        header("Location: view_posts.php");
        exit;
    } else {
        echo "<script>alert('Failed to add comment');</script>";
    }
}

function addComment($postID, $commenter, $comment) {
    global $mysqli;
    $prepared_sql = "INSERT INTO comments (postID, commenter, comment) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($prepared_sql);
    $stmt->bind_param("iss", $postID, $commenter, $comment);
    $stmt->execute();
    return $stmt->affected_rows == 1;
}
?>
