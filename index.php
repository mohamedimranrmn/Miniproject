<?php 
session_start();
if(isset($_SESSION['user_id'])) {
    $mysqli= require __DIR__ ."/database.php";
    $sql="SELECT * FROM user WHERE id={$_SESSION['user_id']}";
    $result=$mysqli->query($sql);
    $user=$result->fetch_assoc();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Home</h1>
    <?php if(isset($user)): ?>
    <p>Hello <?=htmlspecialchars($user['uname'] )?>. Welcome to our website </p>
    <img src="website.jpg" alt="website image" height: 100vh; width:100%;>
    <p><a href="logout.php">Log out</a></p>
    <?php else: ?>
    <p>Already a user? <a href="login.php">Log in</a></p>
    <p>Create an Account <a href="signup.php">Sign up</a></p>
    <?php endif; ?>
</body> 
</html>