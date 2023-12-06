<?php
if(empty($_POST['uname'])) {
    die('Please enter Name!');
}
if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
    die('Enter Valid Email id!');
}
if(strlen($_POST['pwd']) < 8)  { 
    die('pwd must contain atleast 8 characters');
}
if(!preg_match("/[a-z]/i",$_POST['pwd'])) {
    die('pwd should contain atleast one alphabet');
}
if(!preg_match("/[0-9]/",$_POST['pwd'])) {
    die('pwd should contain atleast one number');
}
if($_POST['pwd']!==$_POST['pwdc']) {
    die('pwd must match');
}
$password_hash = password_hash($_POST['pwd'],PASSWORD_DEFAULT);

$mysqli= require __DIR__ ."/database.php";

$sql= "INSERT INTO user (uname,email,password_hash) VALUES (?,?,?)";

$stmt = $mysqli->stmt_init();

if(!$stmt->prepare($sql)) {
    die("SQL ERROR :".$mysqli->error);
}

$stmt->bind_param("sss",
                $_POST['uname'],
                $_POST['email'],
                $password_hash);

if($stmt->execute()) {
    header("location:signup-success.html");
    exit;
}
else {
    if($mysqli->errno===1062) {
        die("Email already taken");
    }
    else {
        die($mysqli->error."".$mysqli->errno);
    }
}
?>