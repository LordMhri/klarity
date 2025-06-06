<?php
header('Content-Type: application/json');
session_start();

require_once __DIR__ . "/../../config/database.php";

// Validate session and inputs
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthenticated", "message" => "Please login first."]);
    exit;
}

$user_id = $_SESSION['user_id'];
$type = $_POST['type'] ?? '';
$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');
$raw_tags = $_POST['tags'] ?? [];


//if (empty($title) || empty($content)) {
//    http_response_code(400);
//    echo json_encode(["error" => "Missing required fields"]);
//    exit;
//}

$conn = new_PDO_connection();

try {

    $conn->beginTransaction();

    $insert_post = "INSERT INTO posts (title, type, content, author_id) 
                   VALUES (:title, :type, :content, :author_id)";
    $stmt = $conn->prepare($insert_post);
    $stmt->execute([
        ':title' => $title,
        ':type' => $type,
        ':content' => $content,
        ':author_id' => $user_id
    ]);

    $post_id = $conn->lastInsertId();


    if (!empty($raw_tags) && is_array($raw_tags)) {

        $find_tag = "SELECT id FROM tags WHERE slug = :slug LIMIT 1";
        $insert_tag = "INSERT INTO tags (name, slug) VALUES (:tag, :slug)";
        $link_tag = "INSERT INTO post_tags (post_id, tag_id) VALUES (:post_id, :tag_id)";

        $find_stmt = $conn->prepare($find_tag);
        $tag_stmt = $conn->prepare($insert_tag);
        $link_stmt = $conn->prepare($link_tag);

        foreach ($raw_tags as $tag_name) {
            $tag_name = trim($tag_name);
            if (empty($tag_name)) continue;

            $slug = sluggify($tag_name);


            $find_stmt->execute([':slug' => $slug]);
            $tag_id = $find_stmt->fetchColumn();


            if (!$tag_id) {
                $tag_stmt->execute([
                    ':tag' => $tag_name,
                    ':slug' => $slug
                ]);
                $tag_id = $conn->lastInsertId();
            }


            $link_stmt->execute([
                ':post_id' => $post_id,
                ':tag_id' => $tag_id
            ]);
        }
    }


    $conn->commit();

    http_response_code(201);
    echo json_encode([
        'success' => true,
        'post_id' => $post_id,
        'message' => 'Post created successfully'
    ]);

} catch (PDOException $e) {
    $conn->rollBack();
    http_response_code(500);
    echo json_encode([
        'error' => 'Database error',
        'message' => $e->getMessage()
    ]);
}

function sluggify($string) {
    $slug = strtolower(trim($string));
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    return $slug;
}