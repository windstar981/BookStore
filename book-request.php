<?php

session_start();

include("config/db_connect.php");



if (!isset($_SESSION['id'])) header('Location: login.php');
$errors = [];
$id = $_SESSION['id'];

$sql = "SELECT * FROM customers WHERE cus_id = '$id'";
$res = mysqli_query($conn, $sql);
if (isset($_POST['change'])) {
    $pass = $_POST['password'];
    $rpass = $_POST['rpassword'];
    $cpass = $_POST['cpassword'];
    $user_logged = mysqli_fetch_assoc($res);
    $pass_saved = $user_logged['cus_password'];
    if (empty($pass) || empty($rpass) || empty($cpass)) $errors[] = "Vui lòng điền đầy đủ thông tin";
    if ($pass != $rpass) $errors[] = "Mật khẩu không khớp";


    if (!password_verify($cpass, $pass_saved)) $errors[] = 'Mật khẩu hiện tại không chính xác';

    if (empty($errors)) {
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "UPDATE customers set cus_password = '$pass_hash' where cus_id = '$id'";
        $res = mysqli_query($conn, $sql);
        header("Location: profile.php");
    }
}


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
                    <li class="breadcrumb-item active">Yêu cầu sách</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<div class="site-wrapper mb-4 mt-3" id="top">

    <div class="container d-block">

        <div class="row ">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">

                <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                    <div class=" d-flex align-items-center mb-3 mb-md-0 m-auto link-dark text-decoration-none">
                        <span class="fs-4 font-weight-bold"> <?php echo  $_SESSION['name'] ?> </span>
                    </div>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href=" profile.php" class="nav-link " aria-current="page">
                                Thông tin cá nhân
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href=" change-password.php" class="nav-link " aria-current="page">

                                Đổi mật khẩu
                            </a>
                        </li>
                        <li> <a href="customer-orders.php" class="nav-link  link-dark">

                                Danh sách đơn hàng
                            </a>
                        </li>
                        <li>
                            <a href="book-request.php" class="nav-link active  link-dark">

                                Yêu cầu sách
                            </a>
                        </li>
                        <li class="border-0">
                            <a href="logout.php" class="nav-link link-dark">

                                Đăng xuất
                            </a>
                        </li>

                    </ul>
                    <hr>

                </div>
            </div>
            <div class=" col-xl-9 col-lg-9 col-md-12 col-sm-12">
                <H4 class="mb-4 font-weight-bold">YÊU CẦU SÁCH</H4>
                <?php if (isset($_GET['errors'])) : ?>
                    <div class="alert alert-danger text-center" role="alert">

                        <div> <?php echo "Gửi yêu cầu thất bại"; ?> </div>

                    </div>
                <?php endif; ?>
                <?php if (isset($_GET['success'])) : ?>
                    <div class="alert alert-success text-center" role="alert">

                        <div> <?php echo "Đã gửi yêu cầu thành công, cảm ơn bạn đã liên hệ shop"; ?> </div>

                    </div>
                <?php endif; ?>
                <form class="mt-2" action="core/book-request.php" method="post">
                    <!-- <div class="mb-5">
                        <label for="inputPassword1" class="col-form-label">Tên các sách yêu cầu (Không quá 3 sách)</label>
                        <input type="text" name="book-name" class="form-control" id="inputPassword1">
                    </div> -->
                    <div class="mb-3">
                        <label for="inputMess" class="col-form-label">Tên các sách yêu cầu (Không quá 500 kí tự)</label>
                        <textarea name="book-name" class="w-100" id="inputMess" rows="5"></textarea>
                    </div>

                    <div class="mb-3">
                        <div class="m-auto">
                            <button type="submit" name="request" class="btn btn-primary">
                                Gửi yêu cầu
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php require_once("templates/footer.php") ?>