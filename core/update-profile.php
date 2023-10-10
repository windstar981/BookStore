<?php

include('../config/db_connect.php');
$errors = [];
if (isset($_GET['id']) and isset($_POST['update'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM customers WHERE cus_id = '$id'";

    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) == 0) {
        header("Location: ../404.php");
    } else {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        if (empty($name) or empty($address) or empty($tel)) {
            header("Location: ../profile.php?errors=1");
        } else {
            $query = "UPDATE customers set cus_name = '$name', cus_add = '$address', cus_tel = '$tel' where cus_id = '$id'";
            $result = mysqli_query($conn, $query);
            if (!$result) header("Location: ../404.php");
            header("Location: ../profile.php");
        }
    }
}
