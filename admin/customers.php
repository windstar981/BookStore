<?php
session_start();
include('config/db_connect.php');
$sql = "SELECT * FROM customers";
$res = mysqli_query($conn, $sql);
$customers = mysqli_fetch_all($res, MYSQLI_ASSOC);


?>



<!DOCTYPE html>
<html class="no-js" lang="en" data-theme="light">


<?php require_once("templates/header.php") ?>
<main class="page-content">
    <div class="container">
        <div class="page-header">
            <?php
            $sql1 = "SELECT count(cus_id) as count from customers";
            $count_cus = mysqli_fetch_assoc(mysqli_query($conn, $sql1));
            ?>
            <h1 class="page-header__title"> Khách hàng <span class="text-grey">(<?php echo $count_cus['count'] ?>)</span></h1>
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
                            <li class="breadcrumbs__item active"><span class="breadcrumbs__link">Khách hàng</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

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
                                    <input id="search-customers" class="input" type="text" placeholder="Tìm kiếm khách hàng">
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

                                </div>
                            </th>
                            <th class="table__th-sort"><span class="align-middle">Họ tên</span>
                            </th>
                            <th class="table__th-sort"><span class="align-middle">Số điện thoại</span>
                            </th>
                            <th class="table__th-sort"><span class="align-middle">Địa chỉ</span>
                            </th>
                            <th class="table__th-sort"><span class="align-middle">Số đơn hàng</span>
                            </th>
                            <th class="table__th-sort"><span class="align-middle">Ngày đăng ký</span>
                            </th>
                            <th class="table__th-sort d-none d-sm-table-cell"><span class="align-middle">Trạng thái</span>
                            </th>
                            <th class="table__actions"></th>
                        </tr>
                    </thead>
                    <tbody class="table-customers">
                        <?php foreach ($customers as $i => $customer) :
                            $cus_id = $customer['cus_id'];
                            $status = $customer['status'] == 1 ? "Đã kích hoạt" : "Chưa kích hoạt";
                            $color_Status = $customer['status'] == 1 ? "color-green" : "color-red";
                            $query = "SELECT count(or_id) as count from orders where cus_id = '$cus_id'";
                            $count_or = mysqli_fetch_assoc(mysqli_query($conn, $query));

                        ?>
                            <tr class="table__row">
                                <td class="table__td">
                                    <div class="table__checkbox table__checkbox--all">

                                    </div>
                                </td>
                                <td class="table__td">
                                    <div class="media-item media-item--medium">

                                        <div class="media-item__right">
                                            <h5 class="media-item__title">
                                                <div><?php echo $customer['cus_name'] ?></div>
                                            </h5><a class="text-sm text-grey" href="mailto:#"><?php echo $customer['cus_mail'] ?></a>
                                        </div>
                                    </div>
                                </td>
                                <td class="table__td text-light-theme"><?php echo $customer['cus_tel'] ?></td>

                                <td class="table__td text-light-theme"><?php echo $customer['cus_add'] ?></td>
                                <td class="table__td text-dark-theme"><?php echo $count_or['count']; ?></td>
                                <td class="table__td text-light-theme"><?php echo $customer['cus_create'] ?></td>
                                <td class="table__td d-none d-sm-table-cell">
                                    <div class="table__status"><span class="table__status-icon <?php echo $color_Status ?>"></span><?php echo $status ?> </div>
                                </td>
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


                                                    <li class="dropdown-items__item"><a href="core/delete-customer.php?id=<?php echo $customer['cus_id'] ?>" class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                                                <svg class="icon-icon-trash">
                                                                    <use xlink:href="#icon-trash"></use>
                                                                </svg></span>Delete</a>
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

                    <div class="table-wrapper__pagination m-auto col-auto">
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
</div>
<?php require_once("templates/footer.php") ?>
</body>

</html>