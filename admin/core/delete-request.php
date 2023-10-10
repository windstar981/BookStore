<?php

include('../config/db_connect.php');
if (!isset($_GET['id'])) {
    header('Location: ../404.php');
    exit;
}
$id = $_GET['id'];
$sql = "SELECT * FROM request where re_id = '$id'";
$res = mysqli_query($conn, $sql);
$customer = mysqli_fetch_assoc($res);
if (mysqli_num_rows($res) <= 0) {
    header('Location: ../404.php');
    exit;
} else {
    $sql = "DELETE FROM request where re_id = '$id'";
    $res = mysqli_query($conn, $sql);
    header("Location: ../book-request.php");
}
