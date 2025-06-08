<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/klarity/config/database.php";

$id = $_GET['id']; // fetch id from GET, not POST

$conn = new_PDO_connection();
$fetch_post = "SELECT * FROM posts WHERE id = :id";

try {
    $stmt = $conn->prepare($fetch_post);
    $stmt->execute(['id' => $id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    file_put_contents('/home/mhri/issue.log', print_r($post, true) . "\n", FILE_APPEND);

    return $post;
} catch (PDOException $e) {
    file_put_contents('/home/mhri/issue.log', $e->getMessage() . "\n", FILE_APPEND);
    return [];
}
