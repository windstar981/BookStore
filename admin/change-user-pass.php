<?php
session_start();

include('config/db_connect.php');
if (!isset($_GET['id'])) {
    header('Location: 404.php');
    exit;
}
$id = $_GET['id'];
$sql = "SELECT * FROM users where u_id = $id";
$res = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($res);


?>



<!DOCTYPE html>
<html class="no-js" lang="en" data-theme="light">


<?php require_once("templates/header.php") ?>
<main class="page-content">
    <div class="container">
        <div class="page-header">

            <h1 class="page-header__title">Đổi mật khẩu <span class="text-grey">:<?php echo $user['u_name'] ?></span></h1>
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
                            <li class="breadcrumbs__item disabled"><a class="breadcrumbs__link" href="#"><span>E-commerce</span>
                                    <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                        <use xlink:href="#icon-keyboard-right"></use>
                                    </svg></a>
                            </li>
                            <li class="breadcrumbs__item active"><span class="breadcrumbs__link">Customers</span>
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
                    $errors = "Tên đăng nhập đã tồn tại";
                    break;
                case '2':
                    $errors = "Mật khẩu không khớp";
                case '3':
                    $errors = "Vui lòng nhập đủ thông tin";
            }
        ?>
            <div class="alert alert-danger text-center" role="alert">
                <div> <?php echo $errors ?> </div>
            </div>
        <?php endif; ?>


        <form id="form-users m-auto" style="max-width: 600px" action="core/add-user.php" method="POST">
            <div class="row">

                <div class="col-12 form-group form-group--lg">
                    <label class="form-label form-label--sm">User name</label>
                    <div class="input-group">
                        <input class="form-control" id="exampleFormControlInput2" name="fullname" type="text" placeholderrequired>
                    </div>
                </div>
                <div class="col-12 form-group form-group--lg">
                    <label class="form-label form-label--sm">Mật khẩu</label>
                    <div class="input-group">
                        <input class="form-control" id="exampleFormControlInput3" name="password" type="password" required>
                    </div>
                </div>

                <div class="col-auto ml-auto">
                    <button type="submit" id="add-user" name="add-user" class="button button--primary" data-dismiss="modal">
                        Lưu thay đổi
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>

<?php require_once("templates/footer.php") ?>
</body>

</html>