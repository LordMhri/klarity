<?php
function render_post_card(array $post): string {
    $title = htmlspecialchars($post['title']);
    $id = htmlspecialchars($post['id']);
    $content = htmlspecialchars($post['content']);
    $response_count = htmlspecialchars($post['response_count']);
    $view_count = htmlspecialchars($post['view_count']);
    $vote_count = htmlspecialchars($post['vote_count']);
    $created_at = htmlspecialchars($post['created_at']);
    $type = $post['type'] === 'idea' ? 'Idea' : 'Question';

    $edit_button = '';
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['author_id']) {
        $edit_button = <<<HTML
            <a href="/klarity/bin/views/posts/edit_post.php?id={$id}" class="edit-post-icon" title="Edit Post">
                Edit Post
            </a>
        HTML;
    }

    return <<<HTML
    <a href="/klarity/bin/views/posts/single_post.php?id={$id}" class="post-card-link">
        <div class="post-card">
            <div class="vote-section">
                <button class="vote-button upvote">▲</button>
                <span class="vote-count">{$vote_count}</span>
                <button class="vote-button downvote">▼</button>
            </div>
            <div class="post-content">
                <div class="post-header">
                    <span class="post-type">{$type}</span>
                    <h3 class="post-title">{$title}</h3>
                    {$edit_button}
                </div>
                <div class="post-body">
                    <p>{$content}</p>
                    <span class="tag">reactjs</span>
                    <span class="tag">nextjs</span>
                </div>
                <div class="post-footer">
                    <span>Posted by <a href="#" class="author-link">AUTHOR LINK HERE</a></span>
                    <span>{$created_at}</span>
                    <div class="post-stats">
                        <span class="stat-item">{$response_count} answers</span>
                        <span class="stat-item">{$view_count} views</span>
                    </div>
                </div>
            </div>
        </div>
    </a>
    HTML;
}

?>
