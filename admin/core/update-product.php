<?php
session_start();

include('../config/db_connect.php');


$id = $_GET['id'];
if (!empty($_POST['pr_name']) and !empty($_POST['pr_code'])  and !empty($_POST['auth_name']) and !empty($_POST['pub_name']) and !empty($_POST['pr_status']) and $_POST['pr_number']>=0 and !empty($_POST['pr_desc']) and !empty($_POST['pr_category']) and !empty($_POST['pr_price']) and !empty($_POST['pr_discount'])) {
    $pr_name =  $_POST['pr_name'];
    $pr_code = $_POST['pr_code'];
    $auth_name =  $_POST['auth_name'];
    $pub_name =  $_POST['pub_name'];
    $pr_number =  $_POST['pr_number'];
    $pr_desc =  $_POST['pr_desc'];
    $pr_category = $_POST['pr_category'];
    $pr_price = $_POST['pr_price'];
    $pr_discount = $_POST['pr_discount'];

    $pr_status = $_POST["pr_status"];


    $sql = "UPDATE `products` SET `pr_name`='$pr_name',`pr_author`='$auth_name',`pr_pub`='$pub_name',
`pr_status`='$pr_status',`pr_category`='$pr_category',`pr_code`='$pr_code',`pr_number`='$pr_number',`pr_price`='$pr_price',
`pr_discount`='$pr_discount',`pr_desc`='$pr_desc' WHERE pr_id = '$id'";
    $res = mysqli_query($conn, $sql);

    if ($res) {

        header("Location: ../product-details.php?id=$id");
    } else {
        header('Location: ../404.php');
    }
} else {
    header("Location: ../product-details.php?id=$id&errors=1");
}
