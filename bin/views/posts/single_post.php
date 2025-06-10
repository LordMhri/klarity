<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    file_put_contents('/home/mhri/issue.log', "Session check failed: " . var_export($_SESSION, true) . "\n", FILE_APPEND);
    header("Location: /klarity/bin/login.php");
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . "/klarity/bin/views/posts/post_card.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/klarity/bin/views/posts/answer_card.php"; // <--- Add this line
require_once $_SERVER['DOCUMENT_ROOT'] . "/klarity/bin/handlers/fetch_single_post.php";
global $post;
require_once $_SERVER['DOCUMENT_ROOT'] . "/klarity/bin/handlers/fetch_answers.php";
global $answers;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Post View</title>
    <link rel="stylesheet" href="/klarity/public2/styles/footer.css">
    <link rel="stylesheet" href="/klarity/public2/styles/feed.css">
    <link rel="stylesheet" href="/klarity/public2/styles/navbar.css">
    <link rel="stylesheet" href="/klarity/public2/styles/post_card.css">
    <link rel="stylesheet" href="/klarity/public2/styles/single_post.css">
</head>
<body>

<?php include ($_SERVER['DOCUMENT_ROOT'] . '/klarity/public2/includes/navbar.php'); ?>

<div class="feed-container">
    <div class="left-side-bar">
        <nav class="links">
            <ul>
                <li><a href="/klarity/bin">Home</a></li>
                <li><a href="/klarity/bin/views/posts/create_post.php">Ask Question</a></li>
                <li><a href="/klarity/bin/views/posts/tags.php">Tags</a></li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
        <?php if ($post): ?>
            <?= render_post_card($post , ""); ?>

            <div class="answers-section">
                <?php if ($answers): ?>
                    <?php foreach ($answers as $answer): ?>
                        <?= render_answer_card($answer); ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No answers yet. Be the first to answer!</p>
                <?php endif; ?>
            </div>


            <div class="answer-form-section">
                <h2>Your Answer</h2>
                <form action="/klarity/bin/handlers/post_answer.php?id=<?= $post['id'] ?>" method="POST">
                    <div class="answer-area">
                        <textarea class="answer-textarea" name="content" placeholder="Type your answer here..." required></textarea>
                    </div>
                    <button class="post-answer-button" type="submit">Post Your Answer</button>
                </form>
            </div>


        <?php else: ?>
            <p>Sorry, this post could not be found.</p>
        <?php endif; ?>
    </div>

    <div class="right-side-bar">
        <p>This is where the metrics be</p>
    </div>
</div>

<?php include ($_SERVER['DOCUMENT_ROOT'] . '/klarity/public2/includes/footer.php'); ?>
</body>
</html>