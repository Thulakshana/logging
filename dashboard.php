<?php
session_start();

if(!isset($_SESSION['loggedin'])){
    header("Location: login.html");
    exit();
}

// Session timeout (10 minutes)
$timeout = 600;

if(time() - $_SESSION['last_activity'] > $timeout){
    session_unset();
    session_destroy();
    header("Location: login.html?timeout=1");
    exit();
}

$_SESSION['last_activity'] = time();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome <?php echo $_SESSION['username']; ?></h2>

<p>You are successfully logged in.</p>

<a href="logout.php">Logout</a>

</body>
</html>
