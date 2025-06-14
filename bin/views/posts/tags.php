<?php

session_start();

if (!isset($_SESSION['username'])) {
    file_put_contents('/home/mhri/issue.log', "Session check failed: " . var_export($_SESSION, true) . "\n", FILE_APPEND);
    header("Location: /klarity/bin/login.php");
    exit();
}



$posts = require $_SERVER['DOCUMENT_ROOT'] . "/klarity/bin/handlers/fetch_posts.php";
require $_SERVER['DOCUMENT_ROOT'] . "/klarity/bin/views/posts/tag_card.php";

$tags = include($_SERVER['DOCUMENT_ROOT'] . '/klarity/bin/handlers/fetch_tags.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Feed - Q&A Platform</title>
    <link rel="stylesheet" href="/klarity/public2/styles/feed.css">
    <link rel="stylesheet" href="/klarity/public2/styles/navbar.css">
    <link rel="stylesheet" href="/klarity/public2/styles/post_card.css">
    <link rel="stylesheet" href="/klarity/public2/styles/footer.css">
    <link rel="stylesheet" href="/klarity/public2/styles/tag.css">
</head>
<body>

<header>
    <?php include ($_SERVER['DOCUMENT_ROOT'] . '/klarity/public2/includes/navbar.php'); ?>
</header>

<main>
    <div class="feed-container">
        <div class="left-side-bar">
            <nav class="links">
                <ul>
                    <li><a href="/klarity/bin/feed.php">Home</a></li>
                    <li><a href="/klarity/bin/views/posts/create_post.php">Ask Question</a></li>
                    <li><a href="#">Tags</a></li>
                </ul>
            </nav>
        </div>
        <div class="main-content">
            <div class="new-post-section">
                <a href="/klarity/bin/views/posts/create_post.php" class="question-section">
                    <h3>Ask a Question</h3>
                    <p class="suggestion-text">Have something on your mind? Get it answered!</p>
                </a>
            </div>

            <div class="tags-container" id="tags-container">
                <?php
                if ($tags) {
                    foreach ($tags as $tag) {
                        echo render_tag_card($tag);
                    }
                } else {
                    echo "<p>No tags yet!</p>";
                }
                ?>
            </div>
        </div>
        <div class="right-side-bar">
<!--            <p>This is where the metrics be</p>-->
        </div>
    </div>
</main>

<?php include ($_SERVER['DOCUMENT_ROOT'] . '/klarity/public2/includes/footer.php'); ?>


</body>

</html>
