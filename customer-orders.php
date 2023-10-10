<?php

session_start();
if (!isset($_SESSION['id'])) header('Location: login.php');
include("config/db_connect.php");
$id = $_SESSION['id'];
$sql = "SELECT * from orders, orderdetail where  orders.or_id  = orderdetail.or_id and orders.cus_id = '$id' group by orders.or_id order by or_date DESC";
$res = mysqli_query($conn, $sql);
$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
if (!$res) header("location: 404.php");

// echo '<pre>';
// print_r($rows);
// echo '</pre>';
// exit;


?>

<!DOCTYPE html>
<html lang="en">


<?php require_once("templates/header.php") ?>

<section class="breadcrumb-section">
    <h2 class="sr-only">Site Breadcrumb</h2>
    <div class="container">
        <div class="breadcrumb-contents">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Đơn hàng</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<div class="site-wrapper" id="top">

    <div class="container d-block">

        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">

                <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                    <div class="d-flex align-items-center  mb-md-0 m-auto link-dark text-decoration-none">
                        <span class="fs-4 font-weight-bold"> <?php echo  $_SESSION['name'] ?> </span>
                    </div>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="profile.php" class="nav-link " aria-current="page">
                                Thông tin cá nhân
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="change-password.php" class="nav-link " aria-current="page">

                                Đổi mật khẩu
                            </a>
                        </li>
                        <li>
                            <a href="customer-orders.php" class="nav-link active link-dark">

                                Danh sách đơn hàng
                            </a>
                        </li>
                        <li>
                            <a href="book-request.php" class="nav-link   link-dark">

                                Yêu cầu sách
                            </a>
                        </li>
                        <li>
                            <a href="logout.php" class="nav-link link-dark">

                                Đăng xuất
                            </a>
                        </li>

                    </ul>
                    <hr>

                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">STT </th>
                            <th scope="col">Mã đơn hàng </th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $i => $row) : ?>
                            <?php
                            $or_id = $row['or_id'];
                            $stt = "";
                            if ($row['or_status'] == 0) {
                                $stt = "Đang xử lí";
                            } elseif ($row['or_status'] == 1) {
                                $stt = "Đã xử lí";
                            } elseif ($row['or_status'] == 2) {
                                $stt = "Đang giao hàng";
                            } elseif ($row['or_status'] == 3) {
                                $stt = "Giao hàng thành công";
                            }
                            ?>
                            <tr data-toggle="collapse" data-target="#demo">
                                <th scope="row"><?php echo $i + 1 ?></th>
                                <td> <?php echo $row['or_id'] ?> </td>
                                <td><?php echo $stt; ?> </td>
                                <th class="text-danger"><?php echo number_format($row['or_total'], 0, ',', '.'); ?> VNĐ</th>
                                <td><?php echo $row['or_date']; ?> </td>

                                <td><button class="text-primary" data-toggle="collapse" data-target="#demo<?php echo $i + 1 ?>">Xem chi tiết</button>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="12">
                                    <div id="demo<?php echo $i + 1 ?>" class="collapse">
                                        <?php

                                        $query = "SELECT * from products, orderdetail WHERE products.pr_id = orderdetail.pr_id and orderdetail.or_id = '$or_id'";

                                        $products = mysqli_fetch_all(mysqli_query($conn, $query));

                                        // echo '</pre>';
                                        // var_dump($products);
                                        // echo '</pre>';

                                        ?>

                                        <?php foreach ($products as $product) :
                                            $image = explode(',', $product[10]);
                                        ?>
                                            <div class="d-flex items">
                                                <div class="image">
                                                    <img src="admin/<?php echo $image[0]; ?>" width="70px" height="80px">
                                                </div>
                                                <div class="title">
                                                    <a href="product-details.php?idsp=<?php echo $product[0] ?>"> <?php echo $product[1] ?> </a>
                                                    <span class="quantity">x<?php echo $product[16] ?></span>
                                                </div>
                                                <div class="price text-danger">
                                                    <?php echo number_format($product[17], 0, ',', '.'); ?> VNĐ
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php require_once("templates/footer.php") ?>