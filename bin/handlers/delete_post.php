<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/klarity/config/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/klarity/bin/handlers/session_handler.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = ['text' => 'You must be logged in to delete a post.', 'type' => 'error'];
    header('Location: /klarity/login.php');
    exit;
}

$post_id = $_GET['id'] ?? null;
if (empty($post_id)) {
    $post_id = $_POST['post_id'] ?? null;
}

if (empty($post_id)) {
    $_SESSION['message'] = ['text' => 'Post ID is missing.', 'type' => 'error'];
    header('Location: /klarity/bin/feed.php');
    exit;
}

$conn = new_PDO_connection();
try {
    $conn->beginTransaction();


    $stmt = $conn->prepare("SELECT author_id FROM posts WHERE id = :post_id");
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->execute();
    $post_author = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post_author || $post_author['author_id'] != $_SESSION['user_id']) {
        $conn->rollBack();
        $_SESSION['message'] = ['text' => 'You are not authorized to delete this post.', 'type' => 'error'];
        header('Location: /klarity/bin/views/posts/single_post.php?id=' . $post_id);
        exit;
    }

    $stmt_delete_post_tags = $conn->prepare("DELETE FROM post_tags WHERE post_id = :post_id");
    $stmt_delete_post_tags->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt_delete_post_tags->execute();


    $stmt_delete_post = $conn->prepare("DELETE FROM posts WHERE id = :post_id");
    $stmt_delete_post->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt_delete_post->execute();

    $conn->commit();
    $_SESSION['message'] = ['text' => 'Post deleted successfully.', 'type' => 'success'];
    header('Location: /klarity/bin/feed.php');
    exit;

} catch (PDOException $e) {
    $conn->rollBack();
    error_log("Database error during post deletion: " . $e->getMessage());
    $_SESSION['message'] = ['text' => 'An error occurred while deleting the post. Please try again.', 'type' => 'error'];
    header('Location: /klarity/bin/feed.php');
    exit;
}
?>