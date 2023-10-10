<?php
session_start();

include('../config/db_connect.php');
if (!isset($_GET['id'])) header("Location: ../404.php");
$id = $_GET['id'];
$sql = "SELECT * FROM customers WHERE cus_id = '$id'";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) == 0) {
    header("Location: ../404.php");
} else {
    $sql = "DELETE from customers where cus_id = '$id'";
    $res = mysqli_query($conn, $sql);
    if (!$res) header("Location: ../404.php");
    header("Location: ../customers.php");
}
