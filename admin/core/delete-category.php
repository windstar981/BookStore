<?php 
    if (!isset($_SESSION['u_id'])) {
        header('Location: ../login.php');
    }
    include('../config/db_connect.php');
    $cate_id =  $_GET['idcate'];
    $create_cate = "CREATE TEMPORARY table temp_cate AS
    (SELECT * FROM `products` WHERE pr_category = '$cate_id')";
    mysqli_query($conn, $create_cate);
    $sl_pr = "SELECT * FROM temp_cate";
    $res_pr = mysqli_query($conn, $sl_pr);
    while($row_pr = mysqli_fetch_assoc($res_pr))
    {
        $id = $row_pr['pr_id'];
        //xoá ở orderdetail
        //xoá ở order
        $cr_tb = "create TEMPORARY TABLE temp AS
        (SELECT * FROM orderdetail where pr_id = '$id')";
        mysqli_query($conn, $cr_tb);
        $sl_or = "SELECT * FROM temp";
        $res_or = mysqli_query($conn, $sl_or);
        while($del = mysqli_fetch_assoc($res_or))
        {
            $or_id = $del['or_id'];
            mysqli_query($conn, "DELETE FROM `orderdetail` WHERE or_id = '$or_id'");
            mysqli_query($conn, "DELETE FROM `orders` WHERE or_id = '$or_id'");
            //sau khi xoá order gửi mail cho user
        }
        $sql = "DELETE FROM products where pr_id = '$id'";
        $res = mysqli_query($conn, $sql);
    }
    $del_cate = "DELETE FROM CATEGORY WHERE c_id = '$cate_id'";
    if(mysqli_query($conn,$del_cate))
    {
        header('Location: ../categories.php');
    }
    else
    {
        header('Location: ../404.php');
    }
;?>