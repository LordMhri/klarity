<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/klarity/config/database.php";

$conn = new_PDO_connection();

try {
    $fetch_posts_with_tags = "
        SELECT p.*, GROUP_CONCAT(t.tag) as tag_names
        FROM posts p
        LEFT JOIN post_tags pt ON p.id = pt.post_id
        LEFT JOIN tags t ON pt.tag_id = t.id
        GROUP BY p.id
        ORDER BY p.created_at DESC
        LIMIT 10
    ";

    $stmt = $conn->query($fetch_posts_with_tags);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);


    foreach ($posts as &$post) {
        $post['tags'] = !empty($post['tag_names']) ? explode(',', $post['tag_names']) : [];
        file_put_contents('/home/mhri/issue.log',print_r($post, true), FILE_APPEND);
        unset($post['tag_names']);
    }
    unset($post);

    file_put_contents('/home/mhri/issue.log', print_r($posts, true) . "\n", FILE_APPEND);
    return $posts;

} catch (PDOException $e) {
    file_put_contents('/home/mhri/issue.log', $e->getMessage() . "\n", FILE_APPEND);
    return [];
}