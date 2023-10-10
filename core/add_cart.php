<?php
session_start();
    if(isset($_SESSION['id']))
    {
        if(isset($_POST['id']))
        {
            $id = $_POST['id'];
            $cus_id = $_SESSION['id'];
            include('../config/db_connect.php');
            $sl_pr = "select * from products pr, category c where pr.pr_category = c.c_id and pr.pr_id = '$id'";
            $res_pr = mysqli_fetch_assoc(mysqli_query($conn, $sl_pr));
            $pr_num = $res_pr['pr_number'];
            if($pr_num==0)
            {
                echo "erro1"; // thông báo hết hàng hàng
                exit;
            }
            $pr_id = $res_pr['pr_id'];
            $cart_price = $res_pr['pr_price'] - $res_pr['pr_discount'];
            $insert_cart = "INSERT INTO `carts`(`pr_id`, `cus_id`, `cart_price`) VALUES ('$pr_id','$cus_id','$cart_price')";
            mysqli_query($conn, $insert_cart);
        }
        echo "done";
    }
    else
    {
        echo "đăng nhập để mua hàng";
    }
    

?>