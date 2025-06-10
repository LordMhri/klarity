<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/klarity/config/database.php";

$conn = new_PDO_connection();

try {
    $fetch_tags = "SELECT * FROM tags ORDER BY tag ASC";
    $stmt = $conn->query($fetch_tags);
    $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tags as &$tag) {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM post_tags WHERE tag_id = ?");
        $stmt->execute([$tag['id']]);
        $tag['post_count'] = $stmt->fetchColumn();
    }
    unset($tag);

    file_put_contents('/home/mhri/issue.log', print_r($tags, true) . "\n", FILE_APPEND);
    return $tags;

} catch (PDOException $e) {
    file_put_contents('/home/mhri/issue.log', $e->getMessage() . "\n", FILE_APPEND);
    return [];
}