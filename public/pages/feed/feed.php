<?php
//
//include('../../includes/navbar.php');
//include('../../includes/footer.php');
//?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Feed - Q&A Platform</title>
    <link rel="stylesheet" href="../../styles/navbar.css">
    <link rel="stylesheet" href="../../styles/footer.css">
    <link rel="stylesheet" href="feed.css">
    <link rel="stylesheet" href="../../components/postcard/postcard.css">
    <script type= 'module' src="feed.js"></script>

</head>
<body>

<?php include ('../../includes/navbar.php'); ?>
<div class="feed-container">
    <div class="left-side-bar">
        <nav class="links">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Ask Question</a></li>
                <li><a href="#">Tags</a></li>
                <li><a href="#">Users</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
    </div>
    <div class="main-content">
        <div class="new-post-section">
            <div class="question-section">
                <h3>Ask a Question</h3>
            </div>
            <div class="idea-section">
                <h3>Share an Idea</h3>
            </div>
        </div>

        <div class="posts-container" id="posts-container">

        </div>
    </div>
    <div class="right-side-bar">
        <p>This is where the metrics be</p>
    </div>
</div>
<?php include ('../../includes/footer.php'); ?>

</body>
</html>
