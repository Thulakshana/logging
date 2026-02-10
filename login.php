<?php
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => false,   // change to true if using HTTPS
    'httponly' => true,
    'samesite' => 'Strict'
]);

session_start();
require "db.php";

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    $stmt->bind_result($id, $hashedPassword);
    $stmt->fetch();

    if(password_verify($password, $hashedPassword)){

        session_regenerate_id(true);

        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        $_SESSION['last_activity'] = time();

        header("Location: dashboard.php");
        exit();
    }
}

echo "Invalid login!";
?>
