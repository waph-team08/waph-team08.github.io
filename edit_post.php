<?php
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: form.php");
    exit;
}

require "database.php";

// Get postID from URL
if (!isset($_GET['postID'])) {
    header("Location: view_posts.php");
    exit;
}

$postID = $_GET['postID'];

// Fetch post details
$post = getPostByID($postID);

// Check if post owner matches logged-in user
if ($_SESSION['username'] !== $post['owner']) {
    header("Location: view_posts.php");
    exit;
}

// Update post if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_post"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    updatePost($postID, $title, $content);
    header("Location: view_posts.php");
    exit;
}

// Delete post if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_post"])) {
    deletePost($postID);
    header("Location: view_posts.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $post['title']; ?>" required><br>

        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="4" required><?php echo $post['content']; ?></textarea><br><br>

        <button type="submit" name="update_post">Update Post</button>
        <button type="submit" name="delete_post">Delete Post</button>
    </form>
</body>
</html>
