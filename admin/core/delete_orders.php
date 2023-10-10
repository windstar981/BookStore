<?php
session_start();

include('../config/db_connect.php');
if(isset($_GET['or_id']))
{
    $or_id = $_GET['or_id'];
    $sl_ors = "SELECT * from orders where or_id = '$or_id'";
    $res_ors = mysqli_query($conn, $sl_ors);
    if(mysqli_num_rows($res_ors)==0)
    {
        header('location: ../orders.php');
    }
    //gui mail cho khach hang
    //update lại số lượng sản phẩm cho đơn hàng bị huỷ or xoá
    $create_tb = "CREATE TEMPORARY TABLE temp_pr AS
    (SELECT pr_id FROM `orders` ors, orderdetail od WHERE ors.or_id = od.or_id and od.or_id = '$or_id')";
    mysqli_query($conn,$create_tb);
    $sl_id_pr = "SELECT * FROM temp_pr";
    $list_id_pr = mysqli_query($conn, $sl_id_pr);
    while($row_id = mysqli_fetch_assoc($list_id_pr))
    {
        $pr_id = $row_id['pr_id'];
        $sl_orderDetail = "SELECT * FROM orderDetail where pr_id = '$pr_id' and or_id = '$or_id'";
        $res_od = mysqli_fetch_assoc(mysqli_query($conn,$sl_orderDetail));
        $od_quatity = $res_od['od_quatity'];
        $update_quatity = "UPDATE products SET pr_number = (pr_number + $od_quatity) where pr_id = '$pr_id'";
        mysqli_query($conn, $update_quatity);
    }
    mysqli_query($conn, "DELETE FROM `orderdetail` WHERE or_id = '$or_id'");
    mysqli_query($conn, "DELETE FROM `orders` WHERE or_id = '$or_id'");
    header('location: ../orders.php');
}
else
{
    header('location: orders.php');
}
