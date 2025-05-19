<?php
session_start();
if (!$_SESSION['username']) {
    header("Location: ../public/auth.html");
    exit();
}


