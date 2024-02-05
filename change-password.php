<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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
    <div class="container">
        <div class="breadcrumb-contents">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><?= getLang('home') ?></a></li>
                    <li class="breadcrumb-item active"><?= getLang('change_pass') ?></li>
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
                    <div class="d-flex align-items-center  mb-md-0 m-auto link-dark text-decoration-none">
                        <span class="fs-4 font-weight-bold"> <?php echo  $_SESSION['name'] ?> </span>
                    </div>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="profile.php" class="nav-link " aria-current="page">
                            <?= getLang('info_person') ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="change-password.php" class="nav-link active" aria-current="page">
                            <?= getLang('change_pass') ?>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php" class="nav-link link-dark">

                                <?= getLang('logout') ?>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class=" col-xl-9 col-lg-9 col-md-12 col-sm-12">
                <H4 class="mb-4 font-weight-bold"><?= getLang('change_pass') ?></H4>
                <?php if (!empty($errors)) : ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?php foreach ($errors as $error) : ?>
                            <div> <?php echo $error; ?> </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <form class="mt-2" action="change-password.php" method="post">
                    <div class="mb-3">
                        <label for="inputPassword1" class="col-form-label"><?= getLang('current_pd') ?></label>
                        <input type="password" name="cpassword" class="form-control" id="inputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword2" class="col-form-label"><?= getLang('new_pd') ?></label>
                        <input type="password" name="password" class="form-control" id="inputPassword2">
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword3" class="col-form-label"><?= getLang('re_password') ?></label>
                        <input type="password" name="rpassword" class="form-control" id="inputPassword3">
                    </div>
                    <div class="mb-3">
                        <div class="m-auto">
                            <button type="submit" name="change" class="btn btn-primary">
                                <?= getLang('save')?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php require_once("templates/footer.php") ?>