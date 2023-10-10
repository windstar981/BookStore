<?php
session_start();
include('config/db_connect.php');
$sql = "SELECT * FROM banners";
$res = mysqli_query($conn, $sql);
$banners = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>



<!DOCTYPE html>
<html class="no-js" lang="en" data-theme="light">


<?php require_once("templates/header.php") ?>
<main class="page-content">
    <div class="container">
        <div class="page-header">

            <h1 class="page-header__title"> Banner </h1>
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
                            <li class="breadcrumbs__item active"><span class="breadcrumbs__link">Banner</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <?php if (isset($_GET['errors'])) : ?>
            <?php $errors = $_GET['errors'] == 1 ? "Vui lòng upload file ảnh" : "Vui lòng điền đẩy đủ thông tin" ?>
            <div class="alert alert-danger text-center" role="alert">
                <div> <?php echo $errors ?> </div>
            </div>
        <?php endif; ?>
        <div class="toolbox">
            <div class="toolbox__row row  gutter-bottom-xs">

                <div class="toolbox__right col-12 col-lg-auto">

                    <div class="toolbox__right-row row  row--xs flex-nowrap">
                        <div class="col-auto">
                            <button class="button-add button-add--blue" data-modal="#addBanner"><span class="button-add__icon">
                                    <svg class="icon-icon-plus">
                                        <use xlink:href="#icon-plus"></use>
                                    </svg></span><span class="button-add__text"></span>
                            </button>
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
                        <col width="300px">
                        <col width="300px">
                        <col>

                    </colgroup>
                    <thead class="table__header">
                        <tr class="table__header-row">
                            <th>
                                <div class="table__checkbox table__checkbox--all">

                                </div>
                            </th>
                            <th class="table__th-sort"><span class="align-middle">Tiêu đề</span>
                            </th>
                            <th class="table__th-sort"><span class="align-middle">Ảnh</span>
                            </th>
                            <th class="table__th-sort"><span class="align-middle">Đường dẫn đến</span>
                            </th>


                            <th class="table__th-sort"><span class="align-middle">Xoá</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-customers">
                        <?php foreach ($banners as $i => $banner) :


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
                                                <div><?php echo $banner['ba_title'] ?></div>
                                            </h5>
                                        </div>
                                    </div>
                                </td>

                                <td class="table__td text-dark-theme">

                                    <img src="<?php echo $banner['ba_image'] ?>" alt="">

                                </td>
                                <td class="table__td text-dark-theme"><?php echo $banner['ba_link']; ?></td>
                                <td class="table__td text-light-theme"><a href="core/delete-banner.php?id=<?php echo $banner['ba_id']; ?>" class="dropdown-items__link p-0"><span class="dropdown-items__link-icon">
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
<div class="inbox-add modal modal-compact scrollbar-thin" id="addBanner" data-simplebar>
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
                        <h2 class="modal__title">Thêm banner</h2>
                    </div>
                </div>
                <div class="modal__body">
                    <div class="modal__container">
                        <form action="core/add-banner.php" class="m-auto" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label form-label--sm">Tiêu đề</label>
                                    <div class="input-group">
                                        <input class="form-control" name="title" id="exampleFormControlInput2" name="c_name" type="text" placeholder="Tiêu đề Banner" required>
                                    </div>
                                </div>
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label form-label--sm">Ảnh</label>

                                    <div class="input-group">
                                        <input type="file" name="image" class="" id="inputGroupFile02">
                                    </div>

                                </div>
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label form-label--sm">Đường dẫn đến</label>
                                    <div class="input-group">
                                        <input name="link" class="form-control" id="exampleFormControlInput2" name="c_name" type="text" placeholder="Đường dẫn đến sản phẩm" required>
                                    </div>
                                </div>
                                <div class="col-auto m-auto ">
                                    <button type="submit" id="submit-category" name="add-banner" class="button button--primary" data-dismiss="modal">
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
<?php require_once("templates/footer.php") ?>
</body>

</html>