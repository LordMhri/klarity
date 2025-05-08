<?php

require_once 'config.php';

$conn = new_PDO_connection();
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

$query = 'SELECT username, password_hash FROM users WHERE username = :username';

try {
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $hashedPassword = $result['password_hash'];
        if (password_verify($password, $hashedPassword)) {
//            $_SESSION['username'] = $username;
//            header("Location: ../public/dashboard.php");


            ini_set('session.gc_maxlifetime', 1440000);
            session_set_cookie_params(['lifetime' => 1440000]);
            session_start();

            $_SESSION['username'] = $username;
            header("Location: ../public/post/create_post.php");
            exit;

        } else {
            echo json_encode(["message" => "Incorrect username or password"]);
        }
        exit;
    } else {
        echo json_encode(["message" => "Username does not exist."]);
        exit;
    }

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    exit;
}
