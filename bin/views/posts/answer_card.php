<?php

function  render_answer_card($answers) : string
{
    $content = htmlspecialchars($answers['content']);
    $author_name = htmlspecialchars($answers['author_name']);


    return <<<HTML
    <div class="answer-item">
        <div class="answer-content">
               <p>$content</p>
               <div class="answer-meta">
                <p class="author-link">{$author_name}</p>
               </div>
        </div>
        
</div>
    
HTML;

}




?>
