<?php
header('Content-Type: application/json');
echo json_encode(['status' => 'test']);
//require_once "config/database.php";
//require_once "api/auth/session.php";
//
//
//$conn = new_PDO_connection();
//$username = trim($_POST['username'] ?? '');
//$password = trim($_POST['password'] ?? '');
//
//$query = 'SELECT id,username, password_hash FROM users WHERE username = :username';
//
//try {
//    $stmt = $conn->prepare($query);
//    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
//    $stmt->execute();
//    $result = $stmt->fetch(PDO::FETCH_ASSOC);
//
//    if ($result) {
//        $user_id = $result['id'];
//        $hashedPassword = $result['password_hash'];
//        if (password_verify($password,$hashedPassword)) {
//
//            set_user_session($user_id,$username);
//            http_response_code(200);
//            echo json_encode(['success'=>"User logged in",'username' => $username,'user_id'=>$user_id ]);
//            exit;
//        } else {
//            http_response_code(401);
//            echo json_encode(['error' => 'Incorrect username or password']);
//        }
//    } else {
//        http_response_code(404);
//        echo json_encode(["message" => "Username does not exist."]);
//        exit;
//    }
//
//} catch (PDOException $e) {
//    echo json_encode(['error' => 'Server error occurred.Please try again']);
//    exit;
//}
