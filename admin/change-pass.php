<?php

include('config/db_connect.php');
session_start();
if (!isset($_SESSION['u_id'])) {
    header('Location: 404.php');
    exit;
}
$id = $_SESSION['u_id'];
$sql = "SELECT * FROM users WHERE u_id = '$id'";
$res = mysqli_query($conn, $sql);
if (isset($_POST['change-pass'])) {
    $pass = $_POST['password'];
    $rpass = $_POST['rpassword'];
    $cpass = $_POST['cpassword'];
    $user_logged = mysqli_fetch_assoc($res);
    $pass_saved = $user_logged['password'];
    if (empty($pass) || empty($rpass) || empty($cpass)) {
        header("Location: change-pass.php?errors=1");
        exit;
    }
    if ($pass != $rpass) {
        header("Location: change-pass.php?errors=2");
        exit;
    }


    if (!password_verify($cpass, $pass_saved)) {
        header("Location: change-pass.php?errors=3");
        exit;
    }


    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "UPDATE users set password = '$pass_hash' where u_id = '$id'";
    $res = mysqli_query($conn, $sql);
    header("Location: change-pass.php?succes=1");
}
?>



<!DOCTYPE html>
<html class="no-js" lang="en" data-theme="light">


<?php require_once("templates/header.php") ?>
<main class="page-content">
    <div class="container">
        <div class="page-header">

            <h1 class="page-header__title"><?= getLang('change_pass') ?> </h1>
        </div>
        <div class="page-tools">
            <div class="page-tools__breadcrumbs">
                <div class="breadcrumbs">
                    <div class="breadcrumbs__container">
                        <ol class="breadcrumbs__list">
                            <li class="breadcrumbs__item">
                                <a class="breadcrumbs__link" href="index.php">
                                    <svg class="icon-icon-home breadcrumbs__icon">
                                        <use xlink:href="#icon-home"></use>
                                    </svg>
                                    <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                        <use xlink:href="#icon-keyboard-right"></use>
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumbs__item disabled"><a class="breadcrumbs__link" href="#"><span><?= getLang('manage_account') ?></span>
                                    <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                        <use xlink:href="#icon-keyboard-right"></use>
                                    </svg></a>
                            </li>
                            <li class="breadcrumbs__item active"><span class="breadcrumbs__link"><?= getLang('change_pd') ?></span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <?php if (isset($_GET['errors'])) :
            $errors = "";
            switch ($_GET['errors']) {
                case '1':
                    $errors = getLang('enter_all_info');
                    break;
                case '2':
                    $errors = getLang('password_mismatch');
                case '3':
                    $errors = getLang('pd_current_false');
            }
        ?>
            <div class="alert alert-danger text-center" role="alert">
                <div> <?php echo $errors ?> </div>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['succes'])) :
            $succes = getLang('change_pd_true');

        ?>
            <div class="alert alert-success text-center" role="alert">
                <div> <?php echo $succes ?> </div>
            </div>
        <?php endif; ?>


        <form id="form-users" class="m-auto" style="max-width: 500px" action="change-pass.php" method="POST">
            <div class="row">

                <div class="col-12 form-group form-group--lg">
                    <label class="form-label form-label--sm"><?= getLang('current_pd') ?></label>
                    <div class="input-group">
                        <input class="form-control" name="cpassword" id="exampleFormControlInput2" name="fullname" type="password" placeholderrequired>
                    </div>
                </div>
                <div class="col-12 form-group form-group--lg">
                    <label class="form-label form-label--sm"><?= getLang('new_pd') ?></label>
                    <div class="input-group">
                        <input class="form-control" name="password" id="exampleFormControlInput3" name="password" type="password" required>
                    </div>
                </div>
                <div class="col-12 form-group form-group--lg">
                    <label class="form-label form-label--sm"><?=  getLang('re_password') ?></label>
                    <div class="input-group">
                        <input class="form-control" name="rpassword" id="exampleFormControlInput3" name="password" type="password" required>
                    </div>
                </div>


                <div class="col-auto m-auto">
                    <button type="submit" id="change-pass" name="change-pass" class="button button--primary" data-dismiss="modal">
                        <?= getLang('save') ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>

<?php require_once("templates/footer.php") ?>
</body>

</html>