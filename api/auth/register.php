<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


ob_start();


require_once __DIR__ . "/../../config/database.php";
$conn = new_PDO_connection();
if (!$conn) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}


require_once __DIR__ . "/session.php";


$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$email = trim($_POST['email'] ?? '');


//if (empty($username) || empty($password)) {
//    http_response_code(400);
//    echo json_encode(['error' => 'Username and password are required']);
//    exit;
//}


$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO users (username, password_hash,email) VALUES (:username, :password,:email)";
try {
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':username' => $username,
        ':password' => $hashedPassword,
        ':email' => $email
    ]);

    $userId = $conn->lastInsertId();


    $_SESSION['user_id'] = $userId;
    $_SESSION['username'] = $username;


    ob_end_clean();


    http_response_code(201);
    echo json_encode([
        'success' => 'User successfully created',
        'userId' => $userId,
        'username' => $username
    ]);

} catch (PDOException $exception) {
 
    ob_end_clean();

    if ($exception->getCode() == 23000) {
        http_response_code(400);
        echo json_encode(['error' => 'Username already exists']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $exception->getMessage()]);
    }
    exit;
}