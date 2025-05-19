<?php

//TODO : ensure cookies are valid before fetching posts
require_once  "config/database.php";
header('Content-Type: application/json');
$conn = new_PDO_connection();


$fetch_posts = "SELECT * from posts order by created_at desc";

try {
    $stmt = $conn->prepare($fetch_posts);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
} catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}
