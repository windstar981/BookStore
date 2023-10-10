<?php
session_start();

include("../config/db_connect.php");
if (!isset($_POST['id'])) {
    header('Location: ../404.php');
    exit;
}
$id = $_POST['id'];
$pass = $_POST['pass'];
if (empty($pass)) {
    echo "errors";
    exit;
}
$pass_hash = password_hash($pass, PASSWORD_DEFAULT);
$sql = "UPDATE users SET password = '$pass_hash' where u_id = '$id'";
$res = mysqli_query($conn, $sql);
if (!$res) {
    header("Location: ../404.php");
}
