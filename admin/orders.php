<?php
session_start();


?>
<!DOCTYPE html>
<html class="no-js" lang="en" data-theme="light">

<?php
include('config/db_connect.php');
require_once("templates/header.php"); ?>
<main class="page-content">
    <div class="container">
        <div class="page-header">
            <h1 class="page-header__title">Đơn hàng</h1>
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
                            <li class="breadcrumbs__item disabled"><a class="breadcrumbs__link" href="#"><span>Quản lí</span>
                                    <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                        <use xlink:href="#icon-keyboard-right"></use>
                                    </svg></a>
                            </li>
                            <li class="breadcrumbs__item active"><span class="breadcrumbs__link">Đơn hàng</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="page-tools__right">
                <div class="page-tools__right-row">
                    <div class="page-tools__right-item"><a class="button-icon" href="#"><span class="button-icon__icon">
                                <svg class="icon-icon-print">
                                    <use xlink:href="#icon-print"></use>
                                </svg></span></a>
                    </div>
                    <div class="page-tools__right-item"><a class="button-icon" href="#"><span class="button-icon__icon">
                                <svg class="icon-icon-import">
                                    <use xlink:href="#icon-import"></use>
                                </svg></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="toolbox d-flex">
            <div class="toolbox__row row gutter-bottom-xs">
                <div class="toolbox__left col-12 col-lg">
                    <div div class="form-group form-group--inline ">
                        <div class="input-group input-group--white input-group--append">
                            <select id="select-status" class="input js-input-select" data-placeholder="">
                                <option value="4" selected="selected">Tất cả trạng thái
                                </option>
                                <option value="3">Đã giao hàng
                                </option>
                                <option value=" 2">Đang giao hàng
                                </option>
                                <option value="1">Đã xử lý
                                </option>
                                <option value="0"> Đang xử lý
                                </option>
                            </select><span class="input-group__arrow">
                                <svg class="icon-icon-keyboard-down">
                                    <use xlink:href="#icon-keyboard-down"></use>
                                </svg></span>

                        </div>
                    </div>
                </div>
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
                                    <input id="search-orders" class="input" type="text" placeholder="Tìm kiếm">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-wrapper">
            <div class="table-wrapper__content table-collapse scrollbar-thin scrollbar-visible" data-simplebar>
                <table class="table table--lines">
                    <colgroup>
                        <col width="90px">
                        <col width="100px">
                        <col width="16%">
                        <col>
                        <col>
                        <col>
                        <col>
                        <col>
                    </colgroup>
                    <thead class="table__header">
                        <tr class="table__header-row">
                            <th>
                                #
                            </th>
                            <th class="d-none d-lg-table-cell"><span>Mã đơn</span>
                            </th>
                            <th class="table__th-sort"><span class="align-middle">Tên khách hàng</span>
                            </th>
                            <th class="table__th-sort d-none d-sm-table-cell"><span class="align-middle">Phương thức giao hàng</span>
                            </th>
                            <th class="table__th-sort"><span class="align-middle">Tổng tiền</span>
                            </th>
                            <th class="table__th-sort"><span class="align-middle">Ngày đặt</span>
                            </th>
                            <th class="table__th-sort d-none d-sm-table-cell"><span class="align-middle">Trạng thái</span>
                            </th>
                            <th class="table__actions"></th>
                        </tr>
                    </thead>
                    <tbody class="table-orders">
                        <?php
                        $sl_orders = "SELECT * FROM orders, customers where orders.cus_id = customers.cus_id";
                        $res_orders = mysqli_query($conn, $sl_orders);
                        $count = 1;
                        while ($row_or  = mysqli_fetch_assoc($res_orders)) {

                            switch ($row_or['or_status']) {
                                case 0:
                                    $color = "orange";
                                    break;
                                case 1:
                                    $color = "blue";
                                    break;
                                case 2:
                                    $color = "blue";
                                    break;
                                case 3:
                                    $color = "green";
                                    break;
                            }

                        ?>
                            <tr class="table__row">
                                <td class="table__td">
                                    <?php echo $count; ?>
                                </td>
                                <td class="d-none d-lg-table-cell table__td"><span class="text-grey"><?php echo $row_or['or_id']; ?></span>
                                </td>
                                <td class="table__td"><?php echo $row_or['cus_name']; ?></td>
                                <td class="d-none d-sm-table-cell table__td"><span class="text-grey"><?php echo $row_or['or_pay']; ?> </span>
                                </td>
                                <td class="table__td"><span><?php echo $row_or['or_total']; ?></span>
                                </td>
                                <td class="table__td text-nowrap"><span class="text-grey"><?php echo $row_or['or_date']; ?> </span>
                                </td>
                                <td class="d-none d-sm-table-cell table__td">
                                    <div class="table__status"><span class="table__status-icon color-<?php echo $color; ?>"></span>
                                        <?php
                                        if ($row_or['or_status'] == 0) {
                                            echo "Đang xử lý";
                                        } elseif ($row_or['or_status'] == 1) {
                                            echo "Đã xử lý";
                                        } elseif ($row_or['or_status'] == 2) {
                                            echo "Đang giao hàng";
                                        } elseif ($row_or['or_status'] == 3) {
                                            echo "Giao hàng thành công";
                                        }


                                        ?></div>
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
                                                    <li class="dropdown-items__item"><a class="dropdown-items__link" href="order-details.php?or_id=<?php echo $row_or['or_id']; ?>"><span class="dropdown-items__link-icon">
                                                                <svg class="icon-icon-view">
                                                                    <use xlink:href="#icon-view"></use>
                                                                </svg></span>Details</a>
                                                    </li>

                                                    <li class="dropdown-items__item"><a class="dropdown-items__link" href="core/delete_orders.php?or_id=<?php echo $row_or['or_id']; ?>"><span class="dropdown-items__link-icon">
                                                                <svg class="icon-icon-trash">
                                                                    <use xlink:href="#icon-trash"></use>
                                                                </svg></span>Delete</a>
                                                    </li>
                                                    <!-- <li class="dropdown-items__item"><a class="dropdown-items__link" href="order-status.php?or_id=<?php echo $row_or['or_id']; ?>"><span class="dropdown-items__link-icon">
                                                                <svg class="icon-icon-trash">
                                                                    <use xlink:href="#icon-trash"></use>
                                                                </svg></span>Status</a>
                                                    </li> -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php $count++;
                        }
                        ?>
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