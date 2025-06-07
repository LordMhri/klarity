<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start();

require_once __DIR__ . "/../../config/database.php";


$conn = new_PDO_connection();
if (!$conn) {
    header("Location: /klarity/bin/register.php?error=server");
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$email = trim($_POST['email'] ?? '');

if (empty($username) || empty($password) || empty($email)) {
    ob_end_clean();
    header("Location: /bin/signup.php?error=missing");
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
try {
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':username' => $username,
        ':password' => $hashedPassword,
        ':email' => $email
    ]);

    $_SESSION['user_id'] = $conn->lastInsertId();
    $_SESSION['username'] = $username;

    ob_end_clean();
    header("Location: /klarity/bin/feed.php?register=success");
    exit;

} catch (PDOException $exception) {
    ob_end_clean();
    if ($exception->getCode() == 23000) {
        file_put_contents('/home/mhri/issue.log', $exception->getMessage() . "\n", FILE_APPEND);
        header("Location: /klarity/bin/auth.php?error=exists");
    } else {
        file_put_contents('/home/mhri/issue.log', $exception->getMessage() . "\n", FILE_APPEND);
        header("Location: /klarity/bin/auth.php?error=server");
    }
    exit;
}
