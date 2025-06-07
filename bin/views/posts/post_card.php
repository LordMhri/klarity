<?php
function render_post_card(array $posts): string {
    $title = htmlspecialchars($posts['title']);
    $id = htmlspecialchars($posts['id']);
    $content = htmlspecialchars($posts['content']);
    $response_count = htmlspecialchars($posts['response_count']);
    $view_count = htmlspecialchars($posts['view_count']);
    $vote_count = htmlspecialchars($posts['vote_count']);
    $created_at = htmlspecialchars($posts['created_at']);
    $type = $posts['type'] === 'idea' ? 'Idea' : 'Question';


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
