<?php

session_start();

$username = $_SESSION['username'];
$author_id = $_SESSION['user_id'];
$content = $_POST['content'];
$post_id = $_GET['id'];
$type =isset($_POST['type'])?$_POST['type']:'answer';

require_once $_SERVER['DOCUMENT_ROOT'] . "/klarity/config/database.php";

$conn = new_PDO_connection();

$create_answer = "INSERT INTO responses (author_id,content, post_id,type) VALUES (:author_id, :content, :post_id,:type)";
$increase_count = "UPDATE posts SET response_count = response_count + 1 WHERE id = :post_id";

try {
    $stmt = $conn->prepare($create_answer);
    $stmt->bindParam(':author_id', $author_id);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':post_id', $post_id);
    $stmt->execute();

    $update_stmt = $conn->prepare($increase_count);
    $update_stmt->bindParam(':post_id', $post_id);
    $update_stmt->execute();

    header("Location: /klarity/bin/views/posts/single_post.php?id=$post_id");
    exit();
} catch (PDOException $e) {
    file_put_contents('/home/mhri/issue.log', $e->getMessage() . PHP_EOL, FILE_APPEND);
    header("Location: /klarity/bin/views/posts/single_post.php?id=$post_id&error=1");
    exit();
}
