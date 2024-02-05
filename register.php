<?php require_once("templates/header.php") ?>
<?php

include('config/db_connect.php');
$name = $location = $phone = $pass = $cpass = $email =  '';
$errors = [];

if (isset($_POST['register'])) {

    if (empty($_POST['email'])) {
        $errors[] = getLang('empty_email');
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = getLang('invalid_email');
        }
    }
    if (empty($_POST['name'])) {
        $errors[] = getLang('empty_name');
    } else {
        $name = $_POST['name'];
    }
    if (empty($_POST['phone'])) {
        $errors[] = getLang('empty_phone');
    } else {
        $phone = $_POST['phone'];
    }
    if (empty($_POST['location'])) {
        $errors[] = getLang('empty_location');
    } else {
        $location = $_POST['location'];
    }

    if (empty($_POST['password'])) {
        $errors[] = getLang('empty_password');
    } else {
        $pass = $_POST['password'];
    }
    if (empty($_POST['cpassword'])) {
        $errors[] = getLang('empty_confirm_password');
    } else {
        $cpass = $_POST['cpassword'];
        if ($cpass != $pass) {
            $errors[] = getLang('password_mismatch');
        }
    }
    if (empty($errors)) {
        $query = "SELECT * FROM customers WHERE cus_mail = '$email'";
        $res = mysqli_query($conn, $query);

        $user = mysqli_num_rows($res);
        if ($user >= 1) {
            $errors['email'] = getLang('existing_email');
        } else {
            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
            $strRandom = rand(1000, 9999);
            $activationCode = md5($strRandom);
            $sql = "INSERT INTO `customers`(`cus_name`, `cus_password`, `cus_mail`, `cus_tel`,  `cus_add`, `activation_code`) VALUES ('$name','$pass_hash','$email','$phone','$location','$activationCode')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                include 'core/sendmail.php';
                header("Location: login.php?status=0");
            } else {
                echo getLang('register_failure');
            }
        }
    }
}


?>
<div class="site-wrapper" id="top">
    <!--==============================================Login Register page content==============================================-->
    <main class="page-section inner-page-sec-padding-bottom">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body ">
                            <div class="row justify-content-center">

                                <div class="col-md-10 col-lg-6 col-xl-6 order-2 order-lg-1">
                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4"><?= getLang('regist') ?></p>
                                    <?php if (!empty($errors)) : ?>
                                        <div class="alert alert-danger text-center" role="alert">
                                            <?php foreach ($errors as $error) : ?>
                                                <div> <?php echo $error; ?> </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <form action="register.php" method="post">

                                        <div class="row">
                                            <div class="col-md-12 col-12 mb--15">
                                                <label for="email"><?= getLang('fullname') ?></label>
                                                <input Required class="mb-0 form-control" value="<?php echo htmlspecialchars($name) ?>" name="name" type="text" id="name" placeholder="<?= getLang('fullname') ?>">

                                            </div>
                                            <div class="col-12 mb--20">
                                                <label for="email"><?= getLang('email') ?></label>
                                                <input Required class="mb-0 form-control" value="<?php echo htmlspecialchars($email) ?>" name="email" type="email" id="email" placeholder="<?= getLang('email') ?>">
                                            </div>
                                            <div class="col-md-12 col-12 mb--15">
                                                <label for="email"><?= getLang('phone') ?></label>
                                                <input Required class="mb-0 form-control" value="<?php echo htmlspecialchars($phone) ?>" name="phone" type="text" id="name" placeholder="<?= getLang('phone') ?>">
                                            </div>
                                            <div class="col-md-12 col-12 mb--15">
                                                <label for="email"><?= getLang('address') ?></label>
                                                <input Required class="mb-0 form-control" value="<?php echo htmlspecialchars($location) ?>" name="location" type="text" id="name" placeholder="<?= getLang('address') ?>">
                                            </div>
                                            <div class="col-lg-6 mb--20">
                                                <label for="password"><?= getLang('password') ?></label>
                                                <input Required class="mb-0 form-control" value="<?php echo htmlspecialchars($pass) ?>" name="password" type="password" id="password" placeholder="<?= getLang('password') ?>">
                                            </div>
                                            <div class="col-lg-6 mb--20">
                                                <label for="password"><?= getLang('re_password') ?></label>
                                                <input Required class="mb-0 form-control" name="cpassword" type="password" value="<?php echo htmlspecialchars($cpass) ?>" id="repeat-password" placeholder="<?= getLang('re_password') ?>">
                                            </div>
                                            <div class="col-md-12">
                                                <button name="register" class="btn btn-success"><?= getLang('regist') ?></button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-6 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<?php require_once("templates/footer.php") ?>


</html>