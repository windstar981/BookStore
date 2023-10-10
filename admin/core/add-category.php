<?php
session_start();

include('../config/db_connect.php');


if (isset($_POST['add-category'])) {

    if (!empty($_POST['c_name'])) {

        $c_name =  $_POST['c_name'];
        $sql = "INSERT INTO category (c_name) value('$c_name')";
        $res = mysqli_query($conn, $sql);
        if (!$res) {
            header('Location: ../404.php');
        }
        header('Location: ../categories.php');
    } else {
        header('Location: ../categories.php?errors=1');
    };
}
