<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . "/klarity/config/database.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/klarity/bin/handlers/session_handler.php"; // should include session_start()

$conn = new_PDO_connection();
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

file_put_contents('/home/mhri/issue.log', "Login attempt for $username\n", FILE_APPEND);

$query = 'SELECT id, username, password FROM users WHERE username = :username';
$stmt = $conn->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result && password_verify($password, $result['password'])) {
    set_user_session($result['id'], $result['username']);
    file_put_contents('/home/mhri/issue.log', "Session after login: " . var_export($_SESSION, true) . "\n", FILE_APPEND);
    header("Location: /klarity/bin/feed.php");
    exit;
} else {
    header("Location: /klarity/bin/login.php?error=invalid");
    exit;
}
