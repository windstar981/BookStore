<!DOCTYPE html>
<html lang="eng">

<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: index.php');
}
include("templates/header.php") ?>

<div class="site-wrapper" id="top">


    <main id="content" class="page-section inner-page-sec-padding-bottom space-db--20">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Checkout Form s-->
                    <div class="checkout-form">
                        <div class="row row-40">
                            <div class="col-12">

                                <!-- Slide Down Blox ==> Login Box  -->

                                <!-- Slide Down Trigger  -->

                                <!-- Slide Down Blox ==> Cupon Box -->
                                <div class="checkout-slidedown-box" id="quick-cupon">
                                    <form action="./">
                                        <div class="checkout_coupon">
                                            <input type="text" class="mb-0" placeholder="Coupon Code">
                                            <a href="" class="btn btn-outlined">Apply coupon</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-7 mb--20">
                                <!-- Billing Address -->
                                <?php
                                $id = $_SESSION['id'];
                                $sl_cus = "SELECT * FROM customers where cus_id = '$id'";
                                $res_cus = mysqli_fetch_assoc(mysqli_query($conn,$sl_cus));
                                ?>
                                <div id="billing-form" class="mb-40">
                                    <h4 class="checkout-title mt-4">Thông tin người đặt</h4>
                                    <div class="row">
                                        <div class="col-12 mb--20">
                                            <label>Họ và Tên</label>
                                            <input disabled type="text" placeholder="Vui lòng bổ xung trong trang cá nhân" value="<?php echo $res_cus['cus_name'] ?>">
                                        </div>
                                        <div class="col-md-6 col-12 mb--20">
                                            <label>Địa chỉ Email</label>
                                            <input disabled type="email" placeholder="Vui lòng bổ xung trong trang cá nhân" value="<?php echo $res_cus['cus_mail'] ?>">
                                        </div>
                                        <div class="col-md-6 col-12 mb--20">
                                            <label>Số điện thoại</label>
                                            <input disabled type="text" placeholder="Vui lòng bổ xung trong trang cá nhân" value="<?php echo $res_cus['cus_tel'] ?>">
                                        </div>
                                        <div class="col-12 mb--20">
                                            <label>Địa chỉ giao hàng</label>
                                            <input disabled type="text" placeholder="Vui lòng bổ xung trong trang cá nhân" value="<?php echo $res_cus['cus_add'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- Shipping Address -->
                            </div>
                            <div class="col-lg-5">
                                <div class="row">
                                    <!-- Cart Total -->
                                    <div class="col-12">
                                        <div class="checkout-cart-total">
                                            <h2 class="checkout-title">Đơn hàng của bạn</h2>

                                            <h4>Sản phẩm <span>Tổng</span></h4>
                                            <ul>

                                                <?php
                                                //xử lí thêm vào order và order detail
                                                $sum = 0;
                                                $check = 0;
                                                if (isset($_SESSION['id'])) {
                                                    include('config/db_connect.php');
                                                    $cus_id = $_SESSION['id'];
                                                    $sl_cart = "SELECT * FROM carts, products pr where carts.cus_id = '$cus_id' and carts.pr_id = pr.pr_id ";
                                                    $res_cart = mysqli_query($conn, $sl_cart);
                                                    $check = mysqli_num_rows($res_cart); //tạo biến check kiểm tra số lượng phần tử của carts
                                                    $res = mysqli_fetch_all($res_cart, MYSQLI_ASSOC);

                                                    foreach ($res as $i) {
                                                        $sum += $i['cart_price'] * $i['cart_quatity'];
                                                ?>
                                                        <li><span class="left text-success"><?php echo $i['pr_name']; ?> X
                                                                <?php echo $i['cart_quatity']; ?></span>
                                                            <span class="right "><?php echo number_format($i['cart_price'] * $i['cart_quatity'], 0, ',', '.') . " VNĐ"; ?></span>
                                                        </li>

                                                <?php
                                                    }
                                                }
                                                if ($check != 0)
                                                    $money_ship = 20000;
                                                else
                                                    $money_ship = 0;

                                                ?>
                                            </ul>
                                            <?php

                                            ?>
                                            <p>Tổng tiền hàng <span><?php echo number_format($sum, 0, ',', '.');?> VNĐ</span</p>
                                            <p>Phí vận chuyển <span id="money_ship"><?php echo number_format($money_ship, 0, ',', '.'); ?> VNĐ</span></p>
                                            <h4>Tổng thanh toán <span class = "text-danger" id="sum_money"><?php echo number_format($sum + $money_ship, 0, ',', '.'); ?> VNĐ</span></h4>


                                            <button class="place-order w-100 mt-5" id="orders">Đặt hàng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>


<?php include("templates/footer.php") ?>


</html>