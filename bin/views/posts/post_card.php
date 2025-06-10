<?php
function render_post_card(array $post, string $search): string {
    $title = htmlspecialchars($post['title']);
    $id = htmlspecialchars($post['id']);
    $tags = $post['tags'] ?? [];
    $author_name = htmlspecialchars($post['author_name']);
    $content = htmlspecialchars($post['content']);
    $response_count = htmlspecialchars($post['response_count']);
    $view_count = htmlspecialchars($post['view_count']);
    $vote_count = htmlspecialchars($post['vote_count']);
    $created_at = htmlspecialchars($post['created_at']);
    $type = $post['type'] === 'idea' ? 'Idea' : 'Question';

    $edit_delete_html = '';
    if ($search !== '' && stripos($title, $search) === false) {
        return '';
    }

    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['author_id']) {
        $edit_delete_html = <<<HTML
            <div class="post-actions">
                <a href="/klarity/bin/views/posts/edit_post.php?id={$id}" class="edit-post-icon" title="Edit Post">
               
                    <svg class="editicon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                     </a>
                <form action="/klarity/bin/handlers/delete_post.php" method="POST" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this post?');">
                    <input type="hidden" name="post_id" value="{$id}">
                    <button type="submit" class="delete-button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="editicon">
                          <path stroke="red" stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        
                        </button>
                </form>
            </div>
        HTML;
    }

    $user_vote = isset($_SESSION['user_id']) ? getUserVote($_SESSION['user_id'], $id) : 0;
    $upvote_class = $user_vote == 1 ? 'active' : '';
    $downvote_class = $user_vote == -1 ? 'active' : '';

    $tags_html = '';
    foreach ($tags as $tag) {
        $tag_escaped = htmlspecialchars($tag);
        $tags_html .= <<<HTML
            <span class="tag">{$tag_escaped}</span>
        HTML;
    }

    return <<<HTML
    <div class="post-card-wrapper">
        <div class="post-card">
            <div class="vote-section">
                <form action="/klarity/bin/handlers/vote_handler.php" method="POST" class="vote-form">
                    <input type="hidden" name="post_id" value="{$id}">
                    <input type="hidden" name="vote_value" value="1">
                    <button type="submit" class="vote-button upvote {$upvote_class}">▲</button>
                </form>
                <span class="vote-count">{$vote_count}</span>
                <form action="/klarity/bin/handlers/vote_handler.php" method="POST" class="vote-form">
                    <input type="hidden" name="post_id" value="{$id}">
                    <input type="hidden" name="vote_value" value="-1">
                    <button type="submit" class="vote-button downvote {$downvote_class}">▼</button>
                </form>
            </div>
            <div class="post-content">
                <div class="post-header">
                        <div>
                   <span class="post-type">{$type}</span>
                    <h3 class="post-title"><a href="/klarity/bin/views/posts/single_post.php?id={$id}">{$title}</a></h3>
                        </div>
                    
                    {$edit_delete_html}
                </div>
               <div class="post-body">
                        <p>{$content}</p>
                        <div class="tags-container">
                            {$tags_html}
                        </div>
                    </div>
                <div class="post-footer">
                    <span>Posted by <a href="#" class="author-link">{$author_name}</a></span>
                    <span>{$created_at}</span>
                    <div class="post-stats">
                        <span class="stat-item">{$response_count} answers</span>
                        <span class="stat-item">{$view_count} views</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    HTML;

}
function getUserVote(int $user_id, int $post_id): int {
    $pdo = new_PDO_connection();
    $stmt = $pdo->prepare("SELECT value FROM vote WHERE voter_id = ? AND post_id = ?");
    $stmt->execute([$user_id, $post_id]);
    $result = $stmt->fetch();

    $stmt2 = $pdo->prepare("UPDATE posts SET view_count = view_count + 1 WHERE id = ?");
    $stmt2->execute([$post_id]);

    return $result ? (int)$result['value'] : 0;
}
?>
