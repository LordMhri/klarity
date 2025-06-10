<?php
session_start();
require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /klarity/bin/feed.php?error=Invalid+request+method');
    exit;
}

if (!isset($_SESSION['user_id'])) {
    header('Location: /klarity/bin/login.php?error=Please+login+to+vote');
    exit;
}

$post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);
$vote_value = filter_input(INPUT_POST, 'vote_value', FILTER_VALIDATE_INT);

if (!$post_id || !in_array($vote_value, [-1, 1])) {
    header('Location: /klarity/bin/feed.php?error=Invalid+vote+data');
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    $pdo = new_PDO_connection();
    $pdo->beginTransaction();

    $stmt2 = $pdo->prepare("UPDATE posts SET view_count = view_count - 1");
    $stmt2->execute();


    $stmt = $pdo->prepare("SELECT id FROM posts WHERE id = ?");
    $stmt->execute([$post_id]);
    if (!$stmt->fetch()) {
        $pdo->rollBack();
        header('Location: /klarity/bin/feed.php?error=Post+not+found');
        exit;
    }

    $stmt = $pdo->prepare("SELECT value FROM vote WHERE voter_id = ? AND post_id = ?");
    $stmt->execute([$user_id, $post_id]);
    $existing_vote = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_vote) {
        if ($existing_vote['value'] == $vote_value) {
            $stmt = $pdo->prepare("DELETE FROM vote WHERE voter_id = ? AND post_id = ?");
            $stmt->execute([$user_id, $post_id]);

            $update = $pdo->prepare("UPDATE posts SET vote_count = vote_count - ? WHERE id = ?");
            $update->execute([$vote_value, $post_id]);
        } else {
            $stmt = $pdo->prepare("UPDATE vote SET value = ?, created_at = CURRENT_TIMESTAMP WHERE voter_id = ? AND post_id = ?");
            $stmt->execute([$vote_value, $user_id, $post_id]);

            $update = $pdo->prepare("UPDATE posts SET vote_count = vote_count + ? WHERE id = ?");
            $update->execute([$vote_value * 2, $post_id]);
        }
    } else {
        $stmt = $pdo->prepare("INSERT INTO vote (voter_id, post_id, value) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $post_id, $vote_value]);

        $update = $pdo->prepare("UPDATE posts SET vote_count = vote_count + ? WHERE id = ?");
        $update->execute([$vote_value, $post_id]);
    }

    $pdo->commit();
    header('Location: /klarity/bin/feed.php?success=Vote+recorded');
    exit;

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log("Vote error: " . $e->getMessage() . " | Post ID: $post_id | User ID: $user_id");
    header('Location: /klarity/bin/feed.php?error=An+error+occurred+while+voting');
    exit;
}
?>
