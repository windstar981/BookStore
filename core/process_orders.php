<?php
    session_start();
    if(isset($_POST['sum_money']) && isset($_POST['money_ship']) && $_POST['sum_money']>0)
    {
        include('../config/db_connect.php');
        $or_total =  $_POST['sum_money'];
        $or_ship = $_POST['money_ship'];
        $or_id = "";
        $or_id = rand(10000,10000000);
        $cus_id = $_SESSION['id'];//dang test mac dinh 1 sau lay o session
        $or_pay = "ship code";
        //check hết các sản phẩm xem còn số lượng không trước khi insert, nếu không thì thông báo lỗi sản phẩm đã hết.

        $sl_cart_1 = "SELECT * FROM carts, products pr where carts.cus_id = '$cus_id' and carts.pr_id = pr.pr_id ";
        $res_cart_1 = mysqli_query($conn, $sl_cart_1);

        while($row_cart_1 = mysqli_fetch_assoc($res_cart_1))
        {
            $pr_id = $row_cart_1['pr_id'];
            $cart_quatity = $row_cart_1['cart_quatity'];
            $pr_name = $row_cart_1['pr_name'];
            //lấy ra số lượng sản phẩm trong kho
            $sl_pr = "SELECT pr_number from products where pr_id ='$pr_id'";
            $pr_number = mysqli_fetch_assoc(mysqli_query($conn, $sl_pr))['pr_number'];
            if($pr_number < $cart_quatity)
            {
                echo "Không thể thực hiện đơn hàng này do sản phẩm ". $pr_name . " đã hết hàng";
                exit;
            }
           
        }

        //tạo bảng order
        $insert_order = "INSERT INTO `orders`(`or_id`, `cus_id`, `or_pay`, `or_total`, `or_ship`) 
        VALUES ('$or_id','$cus_id','$or_pay','$or_total','$or_ship')";
        mysqli_query($conn,$insert_order);

        //insert vào order detail
        $sl_cart = "SELECT * FROM carts, products pr where carts.cus_id = '$cus_id' and carts.pr_id = pr.pr_id ";
        $res_cart = mysqli_query($conn, $sl_cart);

        while($row_cart = mysqli_fetch_assoc($res_cart))
        {
            $pr_id = $row_cart['pr_id'];
            $od_quatity = $row_cart['cart_quatity'];
            $od_price = $row_cart['cart_price'];
            $od_total = $row_cart['cart_price']*$row_cart['cart_quatity'];
            $insert_orderDetail = "INSERT INTO `orderdetail`(`or_id`, `pr_id`, `od_price`, `od_quatity`, `od_total`) 
            VALUES ('$or_id','$pr_id','$od_price','$od_quatity','$od_total')";
            //update lại số lượng sản phẩm trong khoản

            $update_quatity = "UPDATE products SET pr_number = (pr_number - $od_quatity) where pr_id = '$pr_id'";
            mysqli_query($conn, $update_quatity);
            mysqli_query($conn,$insert_orderDetail);
            
        }
            $del_cart = "DELETE from carts where carts.cus_id = '$cus_id'"; 
            //thêm hết sản phẩm từ cart vào order xong xoá các sản phẩm trong cart của cus hiện tại
            mysqli_query($conn, $del_cart);
        echo "Đã đặt hàng thành công";
    }
    else
    {
        echo "Không có sản phẩm nào được chọn";
    }
    
?>