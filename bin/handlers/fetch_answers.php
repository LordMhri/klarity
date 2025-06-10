<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/klarity/config/database.php";

$conn = new_PDO_connection();

$post_id = null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $post_id = (int)$_GET['id'];
} else {
    file_put_contents('/home/mhri/issue.log', "Error: Post ID not provided or invalid in fetch_answers.php\n", FILE_APPEND);
    $answers = [];
    exit();
}

$fetch_answers_sql = "SELECT * FROM responses WHERE post_id = :post_id ORDER BY created_at DESC";

try {
    $stmt = $conn->prepare($fetch_answers_sql);
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->execute();
    $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    file_put_contents('/home/mhri/issue.log', "Fetched Answers for post_id " . $post_id . ": " . print_r($answers, true) . "\n", FILE_APPEND);
} catch (PDOException $e) {
    file_put_contents('/home/mhri/issue.log', "PDO Error in fetch_answers.php: " . $e->getMessage() . "\n", FILE_APPEND);
    $answers = [];
}

?>