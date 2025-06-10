<?php

function render_tag_card(array $tag): string {
    $name = htmlspecialchars($tag['tag']);
    $slug = htmlspecialchars($tag['slug']);
    $post_count = htmlspecialchars($tag['post_count'] ?? 0);

    return <<<HTML
    <div class="tag-card">
        <div class="tag-content">
            <a href="/klarity/bin/views/tags/tag.php?slug={$slug}" class="tag-link">
                <span class="tag-name">{$name}</span>
            </a>
            <div class="tag-meta">
                <span class="post-count">{$post_count} posts</span>
            </div>  
        </div>
    </div>
HTML;
}

?>



