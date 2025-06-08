<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Feed - Q&A Platform</title>
    <link rel="stylesheet" href="/klarity/public2/styles/footer.css">
    <link rel="stylesheet" href="/klarity/public2/styles/feed.css">
    <link rel="stylesheet" href="/klarity/public2/styles/navbar.css">
    <link rel="stylesheet" href="/klarity/public2/styles/create_post.css">
</head>
<body>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/klarity/public2/includes/navbar.php'); ?>
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
        <div class="post-creation-section">
           

            <form action="../../handlers/submit_post.php" method="POST">
                <input type="hidden" name="type" value="question">

                <div class="title-group">
                    <h3><label for="postTitle" class="form-label">Title<span class="required">*</span></label></h3>
                    <p class="form-description">Be specific and imagine you are asking a question to another person</p>
                    <input type="text" id="postTitle" name="title" class="form-input" placeholder="e.g What if an unstoppable force meets an immovable object?" required>
                </div>

                <div class="body-group">
                    <label for="postBody" class="form-label">Body</label>
                    <p class="form-description">Include all the information someone would need to answer your question</p>
                    <textarea id="postBody" name="content" class="form-textarea" rows="15" placeholder=""></textarea>
                </div>

                <div class="tag-group">
                    <label for="postTags" class="form-label">Tags</label>
                    <p class="form-description">Add up to 5 tags to describe what your question is about (e.g., javascript, react, database)</p>


                    <div class="tags-container" id="tagsContainer"></div>

                    <input
                            type="text"
                            id="postTags"
                            name="tags"
                            class="form-input"
                            placeholder="e.g. html css javascript"
                            data-max-tags="5"
                    >


                    <input type="hidden" name="tags_array" id="tagsArray" value="">
                </div>

                <div class="form-actions">
                    <button type="submit" class="submit-post-btn">Post Your Question</button>
                </div>
            </form>
        </div>
    </div>
    <div class="right-side-bar">
        <p>This is where the metrics be</p>
    </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/klarity/public2/includes/footer.php');; ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tagInput = document.getElementById("postTags");
        const tagsContainer = document.getElementById("tagsContainer");
        const tagsArrayInput = document.getElementById("tagsArray");
        let tags = [];

        tagInput.addEventListener("keypress", function (e) {
            if (e.key === "Enter") {
                e.preventDefault();
                const tagText = tagInput.value.trim();

                if (tagText && !tags.includes(tagText) && tags.length < 5) {
                    tags.push(tagText);
                    renderTags();
                }

                tagInput.value = "";
            }
        });

        function renderTags() {
            tagsContainer.innerHTML = "";
            tags.forEach((tag, index) => {
                const tagEl = document.createElement("span");
                tagEl.className = "tag";
                tagEl.textContent = tag;

                const removeBtn = document.createElement("button");
                removeBtn.textContent = "×";
                removeBtn.className = "remove-tag";
                removeBtn.addEventListener("click", function () {
                    tags.splice(index, 1);
                    renderTags();
                });

                tagEl.appendChild(removeBtn);
                tagsContainer.appendChild(tagEl);
            });

            tagsArrayInput.value = tags.join(",");
        }
    });
</script>

</body>
</html>

