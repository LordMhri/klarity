<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/klarity/bin/views/posts/post_card.php";


$post = require $_SERVER['DOCUMENT_ROOT'] . "/klarity/bin/handlers/fetch_single_post.php";


if (!$post) {
    http_response_code(404);
}
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
</head>
<body>

<?php include ($_SERVER['DOCUMENT_ROOT'] . '/klarity/public2/includes/navbar.php'); ?>

<div class="feed-container">
    <div class="left-side-bar">
        <nav class="links">
            <ul>
                <li><a href="/klarity/">Home</a></li>
                <li><a href="/klarity/bin/views/posts/create_post.php">Ask Question</a></li>
                <li><a href="#">Tags</a></li>
                <li><a href="#">Users</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
        <?php if ($post): ?>
            <div class="single-post-container">
                <?= render_post_card($post); ?>
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
