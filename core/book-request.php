<?php
session_start();
include('../config/db_connect.php');
if (!isset($_POST['request'])) {
    header('Location: ../404.php');
    exit;
}
if (empty($_POST['book-name'])) {
    header('Location: ../book-request.php?errors=1');
    exit;
}
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$id = $_SESSION['id'];
$books = $_POST['book-name'];
$sql = "INSERT INTO request (cus_id, re_book) VALUE ('$id', '$books')";
$res = mysqli_query($conn, $sql);
if (!$res) {
    header("Location: ../book-request.php?errors=1");
    exit;
}
include("send-mail-request.php");
header('Location: ../book-request.php?success=1');
