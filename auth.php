<?php
session_start();
include 'dbsbackup.php';
$username = $_POST['username'];
$pass = $_POST['pass'];

global $mysqli;

$query = $mysqli->query("SELECT * FROM task WHERE tmpusername='$username' AND tmppassword='$pass'");
$count = mysqli_num_rows($query);

if($count < 1){
    header('Location: login.php?error=Username not found');
    // echo 'gagal';
}else{
    $res = $query->fetch_assoc();
    $_SESSION['id'] = $res['id'];
    $_SESSION['user'] = $res['tmpusername'];
    $_SESSION['task'] = $res['task'];
    $_SESSION['code'] = $res['code'];
    header('Location: index.php');
}