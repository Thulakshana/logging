<?php
require "db.php";

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);

if($stmt->execute()){
    echo "Registration successful. <a href='login.html'>Login now</a>";
}else{
    echo "Username already exists.";
}
?>
