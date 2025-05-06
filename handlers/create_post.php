<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../public/auth.html");
    exit();
}

require_once "config.php";

var_dump($_POST);

$conn = new_PDO_connection();


$type = trim($_POST['post_type'] ?? '');
$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');

try {
    $stmt1 = $conn->prepare("SELECT id FROM users WHERE username = :username");
    $stmt1->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
    $stmt1->execute();
    $user = $stmt1->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die(json_encode(["error" => "User not found."]));
    }

    $user_id = $user['id'];

    $stmt2 = $conn->prepare("INSERT INTO posts (type, title, content, author_id) VALUES (:type, :title, :content, :author_id)");
    $stmt2->bindParam(':type', $type, PDO::PARAM_STR);
    $stmt2->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt2->bindParam(':content', $content, PDO::PARAM_STR);
    $stmt2->bindParam(':author_id', $user_id, PDO::PARAM_INT);
    $stmt2->execute();

    echo json_encode(["success" => true, "post_id" => $conn->lastInsertId()]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}

