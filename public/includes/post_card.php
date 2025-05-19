//create table posts (
//    id int auto_increment primary key,
//    type enum('question', 'idea')  not null,
//    title varchar(100) not null,
//    content text not null,
//    created_at timestamp default current_timestamp,
//    updated_at timestamp default current_timestamp on update current_timestamp,
//    vote_count int default 0,
//    author_id int,
//    foreign key (author_id) references users(id),
//    accepted_answer_id int,
//    foreign key (accepted_answer_id) references responses(id),
//    is_closed tinyint default 0,
//    response_count int default 0,
//    view_count int default 0
//);
//
//the id will be used as a link to the specific post
//the type will be used to mark the post
//the title will be shown using an h3 tag
//the content will be under the the title
//updated_at will be used to show when the post was edited
//the vote_count will be shown to the left of the post just like on stackoverflow
//the author_id will be used to link the user to the post
//use accepted_answer to render the correct answer first if possible
//is_closed basically means the question has been answered
//the response_count and view_count will be shown on the post itself

<style rel="stylesheet" href = "styles/post.css">

</style>

<div class="post-container">
   <div class="content">
       <h3 class="post-title"></h3>
       <p class="post-content"></p>
       <div class="tags"></div>
       <p class="datetime"></p>
   </div>
    <div class="attribute">
        <h5 class="votes"></h5>
        <h5 class="replies"></h5>
        <h5 class="views"></h5>
    </div>
</div>
