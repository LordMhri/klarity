<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/klarity/config/database.php";


$post = require_once $_SERVER['DOCUMENT_ROOT'] . "/klarity/bin/handlers/fetch_post_for_edit.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="/klarity/public2/styles/footer.css">
    <link rel="stylesheet" href="/klarity/public2/styles/feed.css">
    <link rel="stylesheet" href="/klarity/public2/styles/navbar.css">
    <link rel="stylesheet" href="/klarity/public2/styles/post_card.css">
    <link rel="stylesheet" href="/klarity/public2/styles/edit_post.css">
</head>
<body>

<?php include ($_SERVER['DOCUMENT_ROOT'] . '/klarity/public2/includes/navbar.php'); ?>

<div class="container">
    <h1>Edit Your Post</h1>



    <form action="/klarity/bin/handlers/update_post.php" method="POST" class="post-form">
        <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['id']); ?>">

        <div class="form-group">
            <label for="post_title">Title:</label>
            <input type="text" id="post_title" name="post_title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
        </div>

        <div class="form-group">
            <label for="post_content">Content:</label>
            <textarea id="post_content" name="post_content" rows="10" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        </div>


        <button type="submit" class="submit-button">Update Post</button>
        <a href="../../single_post.php?id=<?php echo htmlspecialchars($post ['id']); ?>" class="cancel-button">Cancel</a>
    </form>
</div>

<?php include ($_SERVER['DOCUMENT_ROOT'] . '/klarity/public2/includes/footer.php'); ?>
</body>
</html>