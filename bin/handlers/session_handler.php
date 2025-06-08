<?php
ini_set('session.cookie_lifetime', 86400);        // 1 day
ini_set('session.gc_maxlifetime', 86400);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function set_user_session($user_id, $username) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
}

function clear_user_session() {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}
?>
