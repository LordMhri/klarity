CREATE DATABASE IF NOT EXISTS klarity_db;

use klarity_db;

create table users
(
    id int auto_increment primary key,
    username varchar(100) not null unique,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    password text not null,
    response_count int default 0,
    accepted_answers int default 0
);

create table posts (
    id int auto_increment primary key,
    type enum('question', 'idea')  not null,
    title varchar(100) not null,
    content text not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    vote_count int default 0,
    author_id int,
    foreign key (author_id) references users(id),
    accepted_answer_id int,
    foreign key (accepted_answer_id) references responses(id),
    is_closed tinyint default 0,
    response_count int default 0,
    view_count int default 0
);

create table responses (
    id int auto_increment primary key ,
    type enum('answer','comment','reply'),
    content text not null,
    vote_count int default 0,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    post_id int not null,
    author_id int not null,
    is_accepted tinyint default 0,
    foreign key (post_id) references  posts(id),
    foreign key (author_id) references users(id)
);

create table vote (
    id int auto_increment primary key,
    voter_id int,
    response_id int,
    created_at timestamp default current_timestamp,
    value tinyint default 0, #a vote is either a +1 or a -1
    foreign key (response_id) references responses(id),
    foreign key (voter_id) references users(id)
);

create table tags(
    id int auto_increment primary key,
    tag varchar(100) not null unique
);


/*
post_tags is a many-to-many relationship table to ensure
efficient queries of posts with a certain tag or all posts
associated with a certain tag.
 */

create table post_tags(
    tag_id int,
    post_id int,
    foreign key (tag_id) references tags(id),
    foreign key (post_id) references posts(id)
);