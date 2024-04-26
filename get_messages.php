<!-- get_messages.php -->
<?php
session_start();

include 'db_config.php';

if (isset($_SESSION['username'])) {
    $receiver = $_SESSION['username'];

    $stmt = $db->prepare("SELECT * FROM messages WHERE receiver = :receiver ORDER BY sent_at DESC");
    $stmt->execute(['receiver' => $receiver]);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($messages);
}
?>
