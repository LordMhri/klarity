<?php

// allow access to session variables
session_start();


// Decode JSON data from the HTTP request body into a PHP object
$data = json_decode(file_get_contents("php://input"),true);


//if the session isnt set with the user_id the user isnt logged in
if (!(isset($_SESSION['user_id']))) {
    //send 401 response which means unauthorized
    http_response_code(401);
    echo  json_encode(array("message" => "User not logged in."));
    exit();
}


require_once 'config.php';
$conn = new_PDO_connection();

if ($data) {
    $type = $data['type'] ?? " ";
    $title = $data['title'] ?? " ";
    $content = $data['content'] ?? "";
    $author_id = $_SESSION['user_id'] ?? "";
    $create_post = "INSERT INTO posts(type,title,content,author_id) VALUES (:type,:title,:content,:author_id)";
    //TODO: tag has a slug column not populated, a slug regex function needs to be created to insert slug into tag
    $create_tag = "INSERT INTO tags (name) VALUES (:name)";
    

    
    

}
