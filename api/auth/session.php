<?php
if (session_status() === PHP_SESSION_NONE) {

    ini_set('session.gc_maxlifetime', 144000);
    session_set_cookie_params(144000);
    session_start();
}


function set_user_session($user_id, $username) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
}