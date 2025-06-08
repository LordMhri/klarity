<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/klarity/config/database.php";

$conn = new_PDO_connection();
$fetch_posts = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 10";

try {
    $stmt = $conn->query($fetch_posts);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    file_put_contents('/home/mhri/issue.log', print_r($posts, true) . "\n", FILE_APPEND);
    return $posts;
} catch (PDOException $e) {
    file_put_contents('/home/mhri/issue.log', $e->getMessage() . "\n", FILE_APPEND);
    return [];
}
