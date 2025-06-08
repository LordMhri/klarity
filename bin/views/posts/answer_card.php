<?php

function  render_answer_card($answers) : string
{
    $content = htmlspecialchars($answers['content']);
    $author_id = htmlspecialchars($answers['author_id']);


    return <<<HTML
    <div class="answer-item">
        <div class="answer-content">
               <p>$content</p>
               <div class="answer-meta">
                <p class="author-link">{$author_id}</p>
               </div>
        </div>
        
</div>
    
HTML;

}




?>
