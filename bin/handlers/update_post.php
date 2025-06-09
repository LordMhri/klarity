<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/klarity/config/database.php';

$conn = new_PDO_connection();

$id = $_POST['post_id'] ?? null;
$title = $_POST['post_title'] ?? null;
$content = $_POST['post_content'] ?? null;


$update_stmt = "UPDATE posts SET title = :title, content = :content WHERE id = :id";

try {

    $stmt = $conn->prepare($update_stmt);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Location: /klarity/bin/views/posts/single_post.php?id={$id}");
} catch (PDOException $exception) {
    file_put_contents('/home/mhri/issue.log', $exception->getMessage());
}



?>