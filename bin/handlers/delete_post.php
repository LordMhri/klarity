<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/klarity/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    $id = $_POST['post_id'];

    $conn = new_PDO_connection();
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: /klarity/bin/feed.php");
        exit;
    } else {
        echo "Failed to delete post.";
    }
} else {

    header("Location: /klarity/feed.php");
    exit;
}
?>
