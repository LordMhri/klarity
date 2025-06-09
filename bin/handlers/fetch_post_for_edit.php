<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/klarity/config/database.php";

$id = $_GET['id'];


$conn = new_PDO_connection();
$fetch_post = "SELECT * FROM posts WHERE id = :id";


try {
    $stmt = $conn->prepare($fetch_post);
    $stmt->execute(['id' => $id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        $_SESSION['message'] = ['text' => 'Post not found.', 'type' => 'error'];
        return;
    }

    if ($_SESSION['user_id'] != $post['author_id']) {
        $_SESSION['message'] = ['text' => 'You are not authorized to edit this post.', 'type' => 'error'];
        return;
    }

    file_put_contents('/home/mhri/issue.log', print_r($post, true) . "\n", FILE_APPEND);

    return $post;
} catch (PDOException $e) {
    file_put_contents('/home/mhri/issue.log', $e->getMessage() . "\n", FILE_APPEND);
    return [];
}
