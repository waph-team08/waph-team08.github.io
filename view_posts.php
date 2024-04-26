<?php
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: form.php");
    exit;
}

require "database.php";

$username = $_SESSION['username'];
$posts = getPostsByUsername($username);

// Function to get comments for a specific post
function getCommentsForPost($postID) {
    global $mysqli;
    $prepared_sql = "SELECT * FROM comments WHERE postID = ?";
    $stmt = $mysqli->prepare($prepared_sql);
    $stmt->bind_param("i", $postID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Posts</title>
    <link rel="stylesheet" href="styless.css">
    <style>
        /* Additional styles for specific elements */
        .post {
            margin-bottom: 20px;
            border: 1px solid #dddddd;
            padding: 15px;
            border-radius: 5px;
        }

        .post-title {
            color: #333333;
            margin-top: 0;
        }

        .post-content {
            color: #555555;
        }

        .post-author {
            font-style: italic;
            color: #777777;
        }

        .post-time {
            color: #777777;
        }

        .edit-button, .delete-button {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #1877f2;
            border: 1px solid #1877f2;
            padding: 6px 12px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .edit-button:hover, .delete-button:hover {
            background-color: #1877f2;
            color: #ffffff;
        }

        .comment-form {
            margin-top: 15px;
        }

        .comment-textarea {
            width: 300px;
            height: 80px;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #dddddd;
            border-radius: 5px;
        }

        .comment-button {
            display: block;
            width: 100px;
            padding: 8px 0;
            border: none;
            border-radius: 5px;
            background-color: #1877f2;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        .view-button{
            display: block;
            width: 150px;
            padding: 8px 0;
            border: none;
            border-radius: 5px;
            background-color: #1877f2;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
         
        }

        .comment-button:hover {
            background-color: #0e5a9c;
        }

        .comments {
            margin-top: 20px;
        }

        .comment {
            margin-bottom: 10px;
            padding: 5px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            background-color: #f2f2f2;
        }

        .no-comment {
            color: #777777;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>View Posts</h1>

    <?php if ($posts): ?>
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h2 class="post-title"><?php echo $post['title']; ?></h2>
                <p class="post-content"><?php echo $post['content']; ?></p>
                <p class="post-author">Posted by: <?php echo $post['owner']; ?></p>
                <p class="post-time">Post Time: <?php echo $post['posttime']; ?></p>
                
                <!-- Edit and delete buttons for the owner -->
                <?php if ($post['owner'] === $username): ?>
                    <a href="edit_post.php?postID=<?php echo $post['postID']; ?>" class="edit-button">Edit</a>

                    <form action="delete_post.php" method="post" class="delete-form">
                        <input type="hidden" name="postID" value="<?php echo $post['postID']; ?>">
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                <?php endif; ?>
                
                <!-- Add comment form -->
                <form action="add_comment.php" method="POST" class="comment-form">
                    <input type="hidden" name="postID" value="<?php echo $post['postID']; ?>">
                    <textarea name="comment" class="comment-textarea" placeholder="Add your comment" required></textarea><br>
                    <button type="submit" class="comment-button">Add Comment</button>
                </form>

                <!-- Display comments -->
                <div class="comments">
                    <?php
                    $comments = getCommentsForPost($post['postID']);
                    if ($comments) {
                        foreach ($comments as $comment) {
                            echo "<p class='comment'><strong>{$comment['commenter']}</strong>: {$comment['comment']}</p>";
                        }
                    } else {
                        echo "<p class='no-comment'>No comments yet.</p>";
                    }
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No posts found.</p>
    <?php endif; ?>
    <button type="submit" class="comment-button"><a href="https://waph-team08.minifacebook.com/index.php">Back to Home</a></button>
</div>
</body>
</html>
