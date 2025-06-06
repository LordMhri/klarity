<?php

session_start();

require_once "../../config/database.php";

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

$conn = new_PDO_connection();

$fetch_posts = "SELECT * FROM posts";