<?php
session_start();
    if(isset($_SESSION['id']))
    {
        if(isset($_POST['pr_id']) && isset($_POST['number']))
        {
            include('../admin/config/db_connect.php');
            $cus_id = $_SESSION['id'];
            $pr_id =  $_POST['pr_id'];
            $number = $_POST['number'];
            if($number==0){
                echo "erro1"; //in ra số lượng chọn phải lớn hơn 0
                exit;
            }
            //lấy ra số lượng sản phẩm trong kho
            $sl_pr = "SELECT * FROM products where pr_id='$pr_id'";
            $number_pr = mysqli_fetch_assoc(mysqli_query($conn,$sl_pr))['pr_number'];
            if($number > $number_pr){
                echo "erro2"; //số lượng trong kho không đủ
                exit;
            }
            $update_number = "UPDATE `carts` SET `cart_quatity`='$number' WHERE carts.cus_id = '$cus_id' and carts.pr_id = '$pr_id'";
            if(mysqli_query($conn, $update_number))
            {
                header('location: ../cart.php');
            }
            else
            {
                header('location: ../index.php');
                //xử lí thêm các trường hợp hết hàng trong kho
            }
        }
        else{
            echo "lỗi 2";
        }
    }
    else{
        echo "lỗi 3";
    }
?>