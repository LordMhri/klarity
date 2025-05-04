<?php
header('Content-Type: application/json');
require_once "config.php";


global $conn;

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password_hash) VALUES (:username, :password)";
try {
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':username' => $username,
        ':password' => $hashedPassword
    ]);
    ini_set('session.gc_maxlifetime', 1440000);
    session_set_cookie_params(['lifetime' => 1440000]);
    session_start();

    $_SESSION['user_id'] = $conn->lastInsertId();
    $_SESSION['username'] = $username;

    header("Location: ../public/dashboard.html");
    exit;



} catch (PDOException $exception){
    if ($exception->getCode() == 23000) {
        echo json_encode(['error' => 'Username already exists']);
        exit;
    } else {
        echo json_encode(['error' => 'Database error: ' . $exception->getMessage()]);
        exit;
    }
}