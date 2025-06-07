<?php

$logFile = '/home/mhri/issue.log';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/session_handler.php";

ob_start();

$conn = new_PDO_connection();
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');


file_put_contents($logFile, "Username: $username\n", FILE_APPEND);
file_put_contents($logFile, "Password: $password\n", FILE_APPEND);

$query = 'SELECT id, username, password FROM users WHERE username = :username';

try {
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    file_put_contents($logFile, "Result: " . var_export($result, true) . "\n", FILE_APPEND);
    if ($result) {
        $user_id = $result['id'];
        $hashedPassword = $result['password'];
        if (password_verify($password, $hashedPassword)) {
            set_user_session($user_id, $username);
            ob_end_clean();
            header("Location: /klarity/bin/feed.php");
            exit;
        } else {
            ob_end_clean();
            header("Location: /klarity/bin/login.php?error=invalid");

            exit;
        }
    } else {
        ob_end_clean();
        header("Location: /klarity/bin/login.php?error=notfound");
        exit;
    }

} catch (PDOException $e) {
    file_put_contents('/home/mhri/issue.log', $e->getMessage() . "\n", FILE_APPEND);
    header("Location: /bin/login.php?error=server");
    exit;
}
