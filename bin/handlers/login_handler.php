<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/session_handler.php";

ob_start();

$conn = new_PDO_connection();
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

$query = 'SELECT id, username, password_hash FROM users WHERE username = :username';

try {
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $user_id = $result['id'];
        $hashedPassword = $result['password_hash'];
        if (password_verify($password, $hashedPassword)) {
            set_user_session($user_id, $username);
            ob_end_clean();
            header("Location: /bin/feed.php");
            exit;
        } else {
            ob_end_clean();
            header("Location: /bin/login.php?error=invalid");

            exit;
        }
    } else {
        ob_end_clean();
        header("Location: /bin/login.php?error=notfound");
        exit;
    }

} catch (PDOException $e) {
    header("Location: /bin/login.php?error=server");
    exit;
}
