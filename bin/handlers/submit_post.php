<?php
session_start();


header('Content-Type: text/html; charset=utf-8');


require_once $_SERVER['DOCUMENT_ROOT'] . '/klarity/config/database.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php?error=unauthorized");
    exit;
}


$errors = [];
$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');
$username = $_SESSION['username'];
$type = $_POST['type'] ?? 'question';
$tags = array_filter(array_map('trim', explode(',', $_POST['tags_array'] ?? '')));

if (empty($title)) {
    $errors[] = "Title is required";
}

if (empty($content)) {
    $errors[] = "Content is required";
}


if (!empty($errors)) {
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header("Location: /bin/views/posts/create_post.php");
    exit;
}


try {
    $conn = new_PDO_connection();
    $conn->beginTransaction();

    $stmt = $conn->prepare("
        INSERT INTO posts (title,author_name ,type, content, author_id) 
        VALUES (:title, :author_name,:type, :content, :author_id)
    ");
    $stmt->execute([
        ':title' => $title,
        ":author_name" => $username,
        ':type' => $type,
        ':content' => $content,
        ':author_id' => $_SESSION['user_id']
    ]);
    $post_id = $conn->lastInsertId();

    if (!empty($tags)) {
        $find_tag = $conn->prepare("SELECT id FROM tags WHERE slug = :slug LIMIT 1");
        $insert_tag = $conn->prepare("INSERT INTO tags (tag, slug) VALUES (:name, :slug)");
        $link_tag = $conn->prepare("INSERT INTO post_tags (post_id, tag_id) VALUES (:post_id, :tag_id)");

        foreach ($tags as $tag_name) {
            $tag_name = trim($tag_name);
            if (empty($tag_name)) continue      ;

            $slug = sluggify($tag_name);
            $find_tag->execute([':slug' => $slug]);
            $tag_id = $find_tag->fetchColumn();

            if (!$tag_id) {
                $insert_tag->execute([
                    ':name' => $tag_name,
                    ':slug' => $slug
                ]);
                $tag_id = $conn->lastInsertId();
            }

            $link_tag->execute([
                ':post_id' => $post_id,
                ':tag_id' => $tag_id
            ]);
        }
    }

    $conn->commit();


    $_SESSION['success_message'] = "Post created successfully!";
    header("Location: /klarity/bin/feed.php");
    exit;

} catch (PDOException $e) {

    $conn->rollBack();
    error_log("Database error: " . $e->getMessage());
    $_SESSION['form_errors'] = ["A database error occurred. Please try again."];
    $_SESSION['form_data'] = $_POST;
    file_put_contents("/home/mhri/issue.log", $e->getMessage() . PHP_EOL, FILE_APPEND);
    header("Location: /klarity/bin/views/posts/create_post.php");
    exit;
}


function sluggify($string) {
    $slug = strtolower(trim($string));
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    return $slug;
}