<?php
session_start();
if ($_SESSION['level'] == 2) {
    include('config/db_connect.php');
    $sql = "SELECT * FROM users";
    $res = mysqli_query($conn, $sql);
    $users = mysqli_fetch_all($res, MYSQLI_ASSOC);
} else {
    header("Location: 404.php");
}

?>



<!DOCTYPE html>
<html class="no-js" lang="en" data-theme="light">


<?php require_once("templates/header.php") ?>
<main class="page-content">
    <div class="container">
        <div class="page-header">
            <?php
            $sql1 = "SELECT count(u_id) as count from users";
            $count_u = mysqli_fetch_assoc(mysqli_query($conn, $sql1));
            ?>
            <h1 class="page-header__title">Admin <span class="text-grey">(<?php echo $count_u['count'] ?>)</span></h1>
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
                            <li class="breadcrumbs__item disabled"><a class="breadcrumbs__link" href="#"><span>Quản lý</span>
                                    <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                        <use xlink:href="#icon-keyboard-right"></use>
                                    </svg></a>
                            </li>
                            <li class="breadcrumbs__item active"><span class="breadcrumbs__link">Nhân viên</span>
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
                    break;
                case '3':
                    $errors = "Vui lòng nhập đủ thông tin";
                    break;
            }
        ?>
            <div class="alert alert-danger text-center" role="alert">
                <div> <?php echo $errors ?> </div>
            </div>
        <?php endif; ?>
        <div class="mb-4">

            <button class="btn btn-primary" data-modal="#addMessage">Thêm Admin</button>
        </div>

        <div class="toolbox">
            <div class="toolbox__row row gutter-bottom-xs">

                <div class="toolbox__right col-12 col-lg-auto">
                    <div class="toolbox__right-row row row--xs flex-nowrap">
                        <div class="col col-lg-auto">
                            <form class="toolbox__search" method="GET">
                                <div class="input-group input-group--white input-group--prepend">
                                    <div class="input-group__prepend">
                                        <svg class="icon-icon-search">
                                            <use xlink:href="#icon-search"></use>
                                        </svg>
                                    </div>
                                    <input class="input" type="text" placeholder="Search Customer">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="table-wrapper">
            <div class="table-wrapper__content table-collapse scrollbar-thin scrollbar-visible" data-simplebar>
                <table class="table table--spaces">
                    <colgroup>
                        <col width="70px">
                        <col>
                        <col>
                        <col>
                        <col>
                        <col>
                        <col>
                    </colgroup>
                    <thead class="table__header">
                        <tr class="table__header-row">
                            <th>
                                <div class="table__checkbox table__checkbox--all">
                                    STT
                                </div>
                            </th>
                            <th class="table__th-sort"><span class="align-middle">Họ tên</span>
                            </th>
                            <th class="table__th-sort"><span class="align-middle">Tên đăng nhập</span>
                            </th>

                            <th class="table__actions"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $i => $user) :


                        ?>
                            <tr class="table__row">
                                <td class="table__td">
                                    <div class="table__checkbox table__checkbox--all">
                                        <?php echo $i + 1 ?>
                                    </div>
                                </td>
                                <td class="table__td text-light-theme"><?php echo $user['u_name'] ?></td>

                                <td class="table__td text-light-theme"><?php echo $user['u_fullname'] ?></td>


                                <td class="table__td table__actions">
                                    <div class="items-more">
                                        <button class="items-more__button">
                                            <svg class="icon-icon-more">
                                                <use xlink:href="#icon-more"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-items dropdown-items--right">
                                            <div class="dropdown-items__container">
                                                <ul class="dropdown-items__list">
                                                    <li class="dropdown-items__item"><a data-user="<?php echo $user['u_id'] ?>" user-name="<?php echo $user['u_name'] ?>" data-modal="#changePass" class="dropdown-items__link change-pass"><span class="dropdown-items__link-icon">
                                                                <svg class="icon-icon-task">
                                                                    <use xlink:href="#icon-task"></use>
                                                                </svg></span><span class="button__text">Đặt lại mật khẩu</span></a>
                                                    </li>
                                                    <li class="dropdown-items__item"><a href="core/delete-user.php?id=<?php echo $user['u_id'] ?>" class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                                                <svg class="icon-icon-trash">
                                                                    <use xlink:href="#icon-trash"></use>
                                                                </svg></span>Xoá</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="table-wrapper__footer">
                <div class="row">
                    <div class="table-wrapper__show-result col text-grey"><span class="d-none d-sm-inline-block">Showing</span> 1 to 10 <span class="d-none d-sm-inline-block">of 50 items</span>
                    </div>
                    <div class="table-wrapper__pagination col-auto">
                        <ol class="pagination">
                            <li class="pagination__item">
                                <a class="pagination__arrow pagination__arrow--prev" href="#">
                                    <svg class="icon-icon-keyboard-left">
                                        <use xlink:href="#icon-keyboard-left"></use>
                                    </svg>
                                </a>
                            </li>
                            <li class="pagination__item active"><a class="pagination__link" href="#">1</a>
                            </li>
                            <li class="pagination__item"><a class="pagination__link" href="#">2</a>
                            </li>
                            <li class="pagination__item"><a class="pagination__link" href="#">3</a>
                            </li>
                            <li class="pagination__item pagination__item--dots">...</li>
                            <li class="pagination__item"><a class="pagination__link" href="#">10</a>
                            </li>
                            <li class="pagination__item">
                                <a class="pagination__arrow pagination__arrow--next" href="#">
                                    <svg class="icon-icon-keyboard-right">
                                        <use xlink:href="#icon-keyboard-right"></use>
                                    </svg>
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="inbox-add modal modal-compact scrollbar-thin" id="addMessage" data-simplebar>
    <div class="modal__overlay" data-dismiss="modal"></div>
    <div class="modal__wrap">
        <div class="modal__window">
            <div class="modal__content">
                <button class="modal__close" data-dismiss="modal">
                    <svg class="icon-icon-cross">
                        <use xlink:href="#icon-cross"></use>
                    </svg>
                </button>
                <div class="modal__header">
                    <div class="modal__container">
                        <h2 class="modal__title">Thêm Admin</h2>
                    </div>
                </div>
                <div class="modal__body">
                    <div class="modal__container">
                        <form id="form-users" action="core/add-user.php" method="POST">
                            <div class="row">
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label form-label--sm">Tên đăng nhập</label>
                                    <div class="input-group">
                                        <input class="input" name="username" type="text" placeholderrequired>
                                    </div>
                                </div>
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label form-label--sm">Họ tên</label>
                                    <div class="input-group">
                                        <input class="input" name="fullname" type="text" placeholderrequired>
                                    </div>
                                </div>
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label form-label--sm">Mật khẩu</label>
                                    <div class="input-group">
                                        <input class="input" name="password" type="password" required>
                                    </div>
                                </div>
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label form-label--sm">Nhập lại mật khẩu</label>
                                    <div class="input-group">
                                        <input class="input" name="rpassword" type="password" required>
                                    </div>
                                </div>
                                <div class="col-auto ml-auto">
                                    <button type="submit" id="add-user" name="add-user" class="button button--primary" data-dismiss="modal">
                                        Thêm
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal__footer">
                    <div class="modal__container">
                        <div class="row">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="inbox-add modal modal-compact scrollbar-thin" id="changePass" data-simplebar>
    <div class="modal__overlay" data-dismiss="modal"></div>
    <div class="modal__wrap">
        <div class="modal__window">
            <div class="modal__content">
                <button class="modal__close" data-dismiss="modal">
                    <svg class="icon-icon-cross">
                        <use xlink:href="#icon-cross"></use>
                    </svg>
                </button>
                <div class="modal__header">
                    <div class="modal__container">
                        <h2 class="modal__title">Đặt lại mật khẩu</h2>
                    </div>
                </div>
                <div class="modal__body">
                    <div class="modal__container">
                        <form id="form-change-pass" data-user="" class="m-auto" style="max-width: 600px" method="POST">
                            <div class="row">
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label form-label--sm">Tên đăng nhập</label>
                                    <div class="input-group">
                                        <input disabled id="username" class="form-control" id="exampleFormControlInput2" type="text" placeholderrequired>
                                    </div>
                                </div>
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label form-label--sm">Mật khẩu</label>
                                    <div class="input-group">
                                        <input id="pass" class="form-control" id="exampleFormControlInput3" name="password" type="password" required>
                                    </div>
                                </div>

                                <div class="col-auto ml-auto">
                                    <button type="submit" id="submit-pass" name="add-user" class="button button--primary" data-dismiss="modal">
                                        Lưu thay đổi
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="modal__footer">
                    <div class="modal__container">
                        <div class="row">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once("templates/footer.php") ?>
</body>

</html>