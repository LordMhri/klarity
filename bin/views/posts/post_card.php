<?php
function render_post_card(array $post): string {
    $title = htmlspecialchars($post['title']);
    $content = htmlspecialchars($post['content']);
    $author = htmlspecialchars($post['author']);
    $created_at = htmlspecialchars($post['created_at']);
    $type = $post['type'] === 'idea' ? '💡 Idea' : '❓ Question';

    return <<<HTML
    <div class="post-card">
        <div class="post-header">
            <span class="post-type">{$type}</span>
            <h3 class="post-title">{$title}</h3>
        </div>
        <div class="post-body">
            <p>{$content}</p>
        </div>
        <div class="post-footer">
            <span>Posted by {$author}</span>
            <span>{$created_at}</span>
        </div>
    </div>
    HTML;
} ?>


<div class="post-card">
    <div class="post-meta">
        <span class="post-type"><?= htmlspecialchars($post['type']) ?></span>
        <span class="post-author">Posted by <?= htmlspecialchars($post['username']) ?></span>
        <span class="post-date"><?= htmlspecialchars($post['created_at']) ?></span>
    </div>
    <h3 class="post-title"><?= htmlspecialchars($post['title']) ?></h3>
    <p class="post-content"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
    <a href="/bin/post.php?id=<?= $post['id'] ?>" class="view-post-btn">View Post</a>
</div>



