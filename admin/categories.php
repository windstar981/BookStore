<?php
include('../config/db_connect.php');
session_start();
$sql = "SELECT * FROM category";

$res = mysqli_query($conn, $sql);
$categories = mysqli_fetch_all($res, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html class="no-js" lang="en" data-theme="light">

<?php require_once("templates/header.php") ?>
<main class="page-content">
    <div class="container">
        <div class="page-header">
            <h1 class="page-header__title">Thể loại</h1>
        </div>
        <div class="page-tools">
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
                        <li class="breadcrumbs__item active"><span class="breadcrumbs__link">Các thể loại</span>
                        </li>
                    </ol>
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
        <?php if (isset($_GET['errors'])) : ?>
            <div class="alert alert-danger text-center" role="alert">
                <div> <?php echo "Vui lòng điền đầy đủ thông tin" ?> </div>
            </div>
        <?php endif; ?>
        <div class="toolbox">
            <div class="toolbox__row row  gutter-bottom-xs">

                <div class="toolbox__right col-12 col-lg-auto">

                    <div class="toolbox__right-row row  row--xs flex-nowrap">
                        <div class="col-auto">
                            <button class="button-add button-add--blue" data-modal="#addCategory"><span class="button-add__icon">
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
                <div class="table-responsive">

                    <table class=" table table--lines">
                        <colgroup>
                            <col width="20%">
                            <col width="40%">
                            <col width="40%">

                        </colgroup>
                        <thead class="table__header">
                            <tr class="table__header-row">
                                <th>
                                    #
                                </th>

                                <th class="table__th-sort"><span class="align-middle">Tên thể loại</span>
                                </th>
                                <th class="table__th-sort"><span class="align-middle">Số sách</span>
                                </th>

                                <th class="table__actions"></th>
                            </tr>
                        </thead>

                        <tbody id="body-table">
                            <?php

                            foreach ($categories as $i => $category) :
                                $c_id = $category['c_id'];
                                $sql = "SELECT count(pr_id) as count from products where pr_category = '$c_id'";
                                $count_pr = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                            ?>
                                <tr class="table__row">

                                    <td class="table__td">
                                        <?php echo $i + 1; ?>
                                    </td>
                                    <td class="table__td"><?php echo $category['c_name']; ?></td>

                                    <td class="table__td"><span><?php echo $count_pr['count']; ?></span>
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
                                                        <li class="dropdown-items__item">
                                                            <a class="dropdown-items__link delete-category" href="core/delete-category.php?idcate=<?php echo $category['c_id'] ?>" >
                                                                    <span class="dropdown-items__link-icon">
                                                                    <svg class="icon-icon-trash">
                                                                        <use xlink:href="#icon-trash"></use>
                                                                    </svg></span>Delete
                                                            </a>
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
            </div>
            <div class="table-wrapper__footer">
                <div class="row">

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
</div>


<div class="inbox-add modal modal-compact scrollbar-thin" id="addCategory" data-simplebar>
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
                        <h2 class="modal__title">Thêm thể loại</h2>
                    </div>
                </div>
                <div class="modal__body">
                    <div class="modal__container">
                        <form action="core/add-category.php" class="m-auto" method="POST">
                            <div class="row">
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label form-label--sm">Tên thể loại</label>
                                    <div class="input-group">
                                        <input class="form-control" id="exampleFormControlInput2" name="c_name" type="text" placeholder="Tên thể loại" required>
                                    </div>
                                </div>


                                <div class="col-auto ml-auto">
                                    <button type="submit" id="submit-category" name="add-category" class="button button--primary" data-dismiss="modal">
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


</html>
1