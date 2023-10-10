<?php
session_start();
include('config/db_connect.php');
$sql = "SELECT * FROM request,customers where request.cus_id = customers.cus_id";
$res = mysqli_query($conn, $sql);
$requests = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>



<!DOCTYPE html>
<html class="no-js" lang="en" data-theme="light">


<?php require_once("templates/header.php") ?>
<main class="page-content">
    <div class="container">
        <div class="page-header">

            <h1 class="page-header__title"> Yêu cầu sách </h1>
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
                            <li class="breadcrumbs__item active"><span class="breadcrumbs__link">Yêu cầu sách</span>
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
                                    <input id="search-customers" class="input" type="text" placeholder="Search Customer">
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
                        <col width="50px">
                        <col width="250px">
                        <col width="800px">
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

                            <th class="table__th-sort"><span class="align-middle">Yêu cầu</span>
                            </th>
                            <th class="table__th-sort"><span class="align-middle">Chấp nhận</span>
                            </th>
                            <th class="table__th-sort"><span class="align-middle">Xoá</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-customers">
                        <?php foreach ($requests as $i => $request) :


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
                                                <div><?php echo $request['cus_name'] ?></div>
                                            </h5><a class="text-sm text-grey" href="mailto:#"><?php echo $request['cus_mail'] ?></a>
                                        </div>
                                    </div>
                                </td>

                                <td class="table__td text-dark-theme"><?php echo $request['re_book']; ?></td>
                                <td class="table__td text-light-theme text-center"><a href="core/accept-requests.php?id=<?php echo $request['re_id']; ?>"><i class="fas fa-check text-success"></i></i></a></td>
                                <td class="table__td text-light-theme"><a href="core/delete-request.php?id=<?php echo $request['re_id']; ?>" class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                            <svg class="icon-icon-trash">
                                                <use xlink:href="#icon-trash"></use>
                                            </svg></span></a></td>



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