<?php
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: form.php");
    exit;
}

require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if postID is set and is a number
    if (isset($_POST["postID"]) && is_numeric($_POST["postID"])) {
        $postID = $_POST["postID"];

        // Check if the logged-in user is the owner of the post
        $username = $_SESSION["username"];
        $post = getPostByID($postID);
        if ($post && $post["owner"] == $username) {
            // Delete the post from the database
            if (deletePost($postID)) {
                // Redirect to view_posts.php
                header("Location: view_posts.php");
                exit;
            } else {
                echo "Error deleting post.";
            }
        } else {
            echo "You do not have permission to delete this post.";
        }
    } else {
        echo "Invalid postID.";
    }
} else {
    echo "Invalid request method.";
}
?>
