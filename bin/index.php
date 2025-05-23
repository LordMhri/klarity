<?php

session_start();

//if the username doesnt exist in the session
//the user is not logged in
if (isset($_SESSION['username'])) {
    header('Location: feed.php');
    exit();
} else {
    header('Location: auth.php');
    exit();
}
?>