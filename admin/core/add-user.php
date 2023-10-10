<?php
session_start();

include('../config/db_connect.php');

if (!isset($_POST['add-user'])) {
    header('Location: ../404.php');
    exit;
}
if (!empty($_POST['username']) or !empty($_POST['password']) or !empty($_POST['rpassword'])) {
    $u_name = $_POST['username'];
    $full_name = $_POST['fullname'];
    $pass = $_POST['password'];
    $rpass = $_POST['rpassword'];
    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM users where u_name = '$u_name'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        header('location: ../manage-users.php?errors=1');
        exit;
    }
    if ($pass != $rpass) {
        header('location: ../manage-users.php?errors=2');
        exit;
    } else {
        $sql = "INSERT INTO users (u_name, u_fullname, password) VALUES('$u_name','$full_name','$pass_hash')";

        $res = mysqli_query($conn, $sql);
        if (!$res) header("Location: ../404.php");
        header('location: ../manage-users.php');
    }
} else {
    header('location: ../manage-users.php?errors=3');
}
