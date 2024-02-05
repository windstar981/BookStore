<?php

session_start();

include("config/db_connect.php");
if (!$_SESSION['id']) header("Location: login.php");
$id = $_SESSION['id'];
$sql = "SELECT * from  customers where cus_id = '$id'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
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
                    <li class="breadcrumb-item active"><?= getLang('info') ?></li>
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
                            <a href="profile.php" class="nav-link active" aria-current="page">
                                <?= getLang('info_person') ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="change-password.php" class="nav-link " aria-current="page">
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
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
                <H4 class="mb-4 font-weight-bold"><?= getLang('info_account')?></H4>
                <?php if (isset($_GET['errors'])) : ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <div> <?php echo "Vui lòng điền đầy đủ thông tin" ?> </div>
                    </div>
                <?php endif; ?>
                <form class="" action="core/update-profile.php?id=<?php echo $id ?>" method="post">
                    <div class="mb-3 row">
                        <label for="inputname" class="col-sm-2 col-form-label"><?= getLang('fullname')?></label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="<?php echo $row['cus_name'] ?>" class="form-control" id="inputname">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label"><?= getLang('email')?></label>
                        <div class="col-sm-10">
                            <input type="text" style="outline: none;" value="<?php echo $row['cus_mail'] ?>" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="inputText1" class="col-sm-2 col-form-label"><?= getLang('phone')?></label>
                        <div class="col-sm-10">
                            <input type="text" name="tel" value="<?php echo $row['cus_tel'] ?>" class="form-control" id="inputText1">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputText2" class="col-sm-2 col-form-label"><?= getLang('address')?></label>
                        <div class="col-sm-10">
                            <input type="text" name="address" value="<?php echo $row['cus_add'] ?>" class="form-control" id="inputText2">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="m-auto">
                            <button type="submit" name="update" class="btn btn-primary">
                                <?= getLang('save_change') ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php require_once("templates/footer.php") ?>