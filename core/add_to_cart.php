<?php
session_start();
    if(isset($_SESSION['id']))
    {
        if(isset($_POST['id']) && isset($_POST['quatity']))
        {
            $id = $_POST['id'];
            $cus_id = $_SESSION['id'];
            $cart_quatity = $_POST['quatity'];
            include('../config/db_connect.php');
            $sl_pr = "select * from products pr, category c where pr.pr_category = c.c_id and pr.pr_id = '$id'";
            $res_pr = mysqli_fetch_assoc(mysqli_query($conn, $sl_pr));
            $pr_id = $res_pr['pr_id'];
            $pr_quantity = $res_pr['pr_number'];
            if($cart_quatity==0)
            {
                echo "Số lượng đặt phải lớn hơn 0";
                exit;
            }
            if($pr_quantity==0)
            {
                echo "Sản phẩm đã hết hàng";
                exit;
            }
            elseif($pr_quantity >0 && $cart_quatity > $pr_quantity)
            {
                echo "Kho hàng không đủ số lượng bạn yêu cầu";
                exit;
            }
            elseif($cart_quatity > $pr_quantity)
            {
                echo "Đã hết sản phẩm, vui lòng chọn lại";
                exit;
            }
            $cart_price = $res_pr['pr_price'] - $res_pr['pr_discount'];
            $insert_cart = "INSERT INTO `carts`(`pr_id`, `cus_id`, `cart_price` , `cart_quatity`) VALUES ('$pr_id','$cus_id','$cart_price', '$cart_quatity')";
            if(mysqli_query($conn, $insert_cart))
            {
                echo "done";
                exit;
            }
            else
            {
                echo "sản phẩm đã có trong giỏ hàng";
                exit;
            }
        }
       
    }
    else
    {
        echo "đăng nhập để mua hàng";
    }
    

?>