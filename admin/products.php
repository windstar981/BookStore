<?php
include('../config/db_connect.php');
session_start();


// BƯỚC 2: TÌM TỔNG SỐ RECORDS
$result = mysqli_query($conn, 'select count(pr_id) as total from products');
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];

// BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;

// BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
// tổng số trang
$total_page = ceil($total_records / $limit);

// Giới hạn current_page trong khoảng 1 đến total_page
if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}

// Tìm Start
$start = ($current_page - 1) * $limit;

// BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
// Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
$result = mysqli_query($conn, "SELECT * FROM products, category where products.pr_category = category.c_id LIMIT $start, $limit");
// echo '<pre>';
// var_dump(mysqli_fetch_all($result));
// echo '</pre>';
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
$count = $start + 1;

?>
<!DOCTYPE html>
<html class="no-js" lang="en" data-theme="light">

<?php require_once("templates/header.php") ?>
<main class="page-content">
    <div class="container">
        <div class="page-header">
            <h1 class="page-header__title">Sản phẩm</h1>
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
                        <li class="breadcrumbs__item active"><span class="breadcrumbs__link">Sản phẩm</span>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="page-tools__right">
                <div class="page-tools__right-row">
                    <div class="page-tools__right-item"><a class="button-icon" href="core/export-products.php">
                            <i class="fas fa-file-export"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="toolbox">
            <div class="toolbox__row row gutter-bottom-xs">
                <div class="toolbox__left col-12 col-lg">
                    <div class="toolbox__left-row row row--xs gutter-bottom-xs">
                        <div class="form-group form-group--inline col-12 col-sm-auto">
                            <label class="form-label">Hiển thị</label>
                            <div class="input-group input-group--white input-group--append">
                                <select id="select_num_row" class="input js-input-select" data-placeholder="">
                                    <option value="10" selected="selected">10
                                    </option>
                                    <option value="20">20
                                    </option>
                                    <option value="30">30
                                    </option>
                                    <option value="40">40
                                    </option>
                                </select><span class="input-group__arrow">
                                    <svg class="icon-icon-keyboard-down">
                                        <use xlink:href="#icon-keyboard-down"></use>
                                    </svg></span>
                            </div>
                        </div>
                        <div class="form-group form-group--inline col col-sm-auto">
                            <div class="input-group input-group--white input-group--append">
                                <select id="select_category" class="input js-input-select" data-placeholder="">
                                    <?php
                                    include("../config/db_connect.php");
                                    $sql = "SELECT * FROM category";
                                    $res = mysqli_query($conn, $sql);
                                    $categories = mysqli_fetch_all($res, MYSQLI_ASSOC);
                                    ?>
                                    <option value="0" selected="selected">Tất cả thể loại
                                    </option>
                                    <?php foreach ($categories as $category) :  ?>
                                        <option value="<?php echo $category['c_id'] ?>"><?php echo $category['c_name'] ?> </option>
                                    <?php endforeach; ?>
                                </select><span class="input-group__arrow">
                                    <svg class="icon-icon-keyboard-down">
                                        <use xlink:href="#icon-keyboard-down"></use>
                                    </svg></span>
                            </div>
                        </div>
                        <div div class="form-group form-group--inline col-12 col-sm-auto">
                            <div class="input-group input-group--white input-group--append">
                                <select id="select_status" class="input js-input-select" data-placeholder="">
                                    <option value="3" selected="selected">Tất cả trạng thái
                                    </option>
                                    <option value="2">Public
                                    </option>
                                    <option value="1">Private
                                    </option>
                                </select><span class="input-group__arrow">
                                    <svg class="icon-icon-keyboard-down">
                                        <use xlink:href="#icon-keyboard-down"></use>
                                    </svg></span>
                            </div>
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
                                    <input class="input" id="search-products" type="text" placeholder="Tìm kiếm sản phẩm">
                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <button class="button-add button-add--blue" data-modal="#addProduct"><span class="button-add__icon">
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
                            <col width="90px">
                            <col width="100px">
                            <col width="350px">
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
                                <th class=" d-lg-table-cell"><span>ID</span>
                                </th>
                                <th class="table__th-sort"><span class="align-middle">Tên sách</span>
                                </th>
                                <th class="table__th-sort"><span class="align-middle">Thể loại</span>
                                </th>
                                <th class="table__th-sort"><span class="align-middle">Giá đã giảm</span>
                                </th>
                                <th class="table__th-sort  d-lg-table-cell"><span class="align-middle">Tồn kho</span>
                                </th>
                                <th class="table__th-sort  d-sm-table-cell"><span class="align-middle">Trạng thái</span>
                                </th>
                                <th class="table__actions"></th>
                            </tr>
                        </thead>

                        <tbody id="body-table">
                            <?php
                            // $sl_product = "SELECT * FROM products, category where products.pr_category = category.c_id limit 10";
                            // $res_product = mysqli_query($conn, $sl_product);
                            // $count = 1;
                            foreach ($products as $i => $product) :
                            ?>
                                <tr class="table__row">


                                    <td class="table__td">
                                        <?php echo $count;
                                        $count++ ?>
                                    </td>
                                    <td class="d-lg-table-cell table__td"><?php echo $product['pr_code']; ?><span class="text-grey"></span>
                                    </td>
                                    <td class="table__td"><?php echo $product['pr_name']; ?></td>
                                    <td class="table__td"><span class="text-grey"><?php echo $product['c_name']; ?></span>
                                    </td>
                                    <td class="table__td"><span><?php echo $product['pr_price'] - $product['pr_discount']; ?></span>
                                    </td>
                                    <td class="d-lg-table-cell table__td"><span class="text-grey"><?php echo $product['pr_number']; ?></span>
                                    </td>
                                    <td class="d-sm-table-cell table__td">
                                        <div class="table__status"><span class="table__status-icon <?php if ($product['pr_status'] == 1)  echo "color-red";
                                                                                                    else echo "color-green" ?>"></span>
                                            <?php if ($product['pr_status'] == 1)  echo "Private";
                                            else echo "Public" ?></div>
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
                                                        <li class="dropdown-items__item"><a href="product-details.php?id=<?php echo $product['pr_id'] ?>" class="dropdown-items__link"><span class="dropdown-items__link-icon">
                                                                    <svg class="icon-icon-view">
                                                                        <use xlink:href="#icon-view"></use>
                                                                    </svg></span>Details</a>
                                                        </li>
                                                        <li class="dropdown-items__item"><a value="<?php echo $product['pr_id'] ?>" class="dropdown-items__link delete-product"><span class="dropdown-items__link-icon">
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
            </div>
            <div class="table-wrapper__footer">
                <div class="row">

                    <div class="table-wrapper__pagination m-auto col-auto">
                        <ol class="pagination">
                            <li class="pagination__item">
                                <a class="pagination__arrow pagination__arrow--prev" href="products.php?page=<?php echo $current_page - 1 ?>">
                                    <svg class="icon-icon-keyboard-left">
                                        <use xlink:href="#icon-keyboard-left"></use>
                                    </svg>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $total_page; $i++) : ?>
                                <li class="pagination__item <?php if ($current_page == $i) echo 'active' ?>"><a class="pagination__link" href="products.php?page=<?php echo $i ?>"><?php echo $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="pagination__item">
                                <a class="pagination__arrow pagination__arrow--next" href="products.php?page=<?php echo $current_page  + 1 ?>">
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
<div class="modal modal--panel modal--right" id="addProduct">
    <div class="modal__overlay" data-dismiss="modal"></div>
    <div class="modal__wrap">
        <div class="modal__window scrollbar-thin" data-simplebar>
            <div class="modal__content">
                <div class="modal__header">
                    <div class="modal__container">
                        <h2 class="modal__title">Thêm sản phẩm</h2>
                    </div>
                </div>
                <div class="modal__body">
                    <div class="modal__container">
                        <form method="POST">
                            <div class="row row--md">
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Tên sách</label>
                                    <div class="input-group">
                                        <input class="input" type="text" placeholder="Nhập tên sách" required id="pr_name" name="pr_name">
                                    </div>
                                </div>
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Mã sách</label>
                                    <div class="input-group">
                                        <input class="input" type="text" placeholder="Nhập mã sách" required id="pr_code" name="pr_code">
                                    </div>
                                </div>
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Tên tác giả</label>
                                    <div class="input-group">
                                        <input class="input" type="text" placeholder="Nhập tên tác giả" required id="auth_name" name="auth_name">
                                    </div>
                                </div>

                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Nhà xuất bản</label>
                                    <div class="input-group">
                                        <input class="input" type="text" placeholder="Nhà xuất bản" required id="pub_name" name="pub_name">
                                    </div>
                                </div>

                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Số lượng sách</label>
                                    <div class="input-group">
                                        <input class="input" type="number" placeholder="Nhập số lượng" required id="pr_number" name="pr_number">
                                    </div>
                                </div>
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Mô tả chi tiết</label>
                                    <div class="input-editor">
                                        <textarea class="form-control pr_desc" id="exampleFormControlTextarea1" placeholder="Nhập mô tả chi tiết sản phẩm" rows="5" name="pr_desc"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Thể loại</label>
                                    <div class="input-group input-group--append">
                                        <select class="input js-input-select input--fluid" data-placeholder="" id="pr_category" name="pr_category">
                                            <option value=""></option>

                                            <?php
                                            include('../config/db_connect.php');
                                            $sl_Category = "SELECT * FROM `category`";
                                            $res_Category = mysqli_query($conn, $sl_Category);
                                            while ($row = mysqli_fetch_assoc($res_Category)) { ?>
                                                <option value="<?php echo $row['c_id']; ?>"><?php echo $row['c_name'] ?></option>
                                            <?php }
                                            ?>

                                        </select>
                                        <span class="input-group__arrow">
                                            <svg class="icon-icon-keyboard-down">
                                                <use xlink:href="#icon-keyboard-down"></use>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Trạng thái sản phẩm</label>
                                    <div class="input-group input-group--append">
                                        <select id="pr_status" class="input js-input-select input--fluid" data-placeholder="">
                                            <option value="" selected="selected">
                                            </option>
                                            <option value="2">Public
                                            </option>
                                            <option value="1">Private
                                            </option>
                                        </select><span class="input-group__arrow">
                                            <svg class="icon-icon-keyboard-down">
                                                <use xlink:href="#icon-keyboard-down"></use>
                                            </svg></span>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 form-group form-group--lg">
                                    <label class="form-label">Giá (VNĐ)</label>
                                    <div class="input-group input-group--prepend">
                                        <input class="input" type="number" min="0" max="999999999" placeholder="VNĐ" id="pr_price" name="pr_price" value="" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 form-group form-group--lg">
                                    <label class="form-label">Giảm giá (VNĐ)</label>
                                    <div class="input-group input-group--prepend">
                                        <input class="input" type="number" min="0" max="999999999" placeholder="VNĐ" id="pr_discount" name="pr_discount" value="" required>

                                    </div>
                                </div>
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Ảnh sản phẩm</label>
                                    <div class="image-upload">
                                        <div class="image-upload__drop">
                                            <input class="image-upload__input" type="file" id="pr_images" name="pr_images" multiple="multiple" accept="image/png, image/jpeg" />
                                            <div class="image-upload__drop-text">
                                                <svg class="icon-icon-upload">
                                                    <use xlink:href="#icon-upload"></use>
                                                </svg> <span>Kéo và thả hoặc </span> <span class="image-upload__drop-action text-blue">Duyệt</span> <span> để tải lên</span>
                                            </div>
                                        </div>
                                        <ul class="image-upload__list">
                                            <li class="image-upload__item">
                                                <div class="image-upload__progress">
                                                    <div class="image-upload__progress-icon"></div>
                                                </div>
                                                <div class="image-upload__action-remove">
                                                    <svg class="icon-icon-cross">
                                                        <use xlink:href="#icon-cross"></use>
                                                    </svg>
                                                </div>
                                            </li>
                                            <li class="image-upload__item">
                                                <div class="image-upload__progress">
                                                    <div class="image-upload__progress-icon"></div>
                                                </div>
                                                <div class="image-upload__action-remove">
                                                    <svg class="icon-icon-cross">
                                                        <use xlink:href="#icon-cross"></use>
                                                    </svg>
                                                </div>
                                            </li>
                                            <li class="image-upload__item">
                                                <div class="image-upload__progress">
                                                    <div class="image-upload__progress-icon"></div>
                                                </div>
                                                <div class="image-upload__action-remove">
                                                    <svg class="icon-icon-cross">
                                                        <use xlink:href="#icon-cross"></use>
                                                    </svg>
                                                </div>
                                            </li>
                                            <li class="image-upload__item">
                                                <div class="image-upload__progress">
                                                    <div class="image-upload__progress-icon"></div>
                                                </div>
                                                <div class="image-upload__action-remove">
                                                    <svg class="icon-icon-cross">
                                                        <use xlink:href="#icon-cross"></use>
                                                    </svg>
                                                </div>
                                            </li>
                                            <li class="image-upload__item">
                                                <div class="image-upload__progress">
                                                    <div class="image-upload__progress-icon"></div>
                                                </div>
                                                <div class="image-upload__action-remove">
                                                    <svg class="icon-icon-cross">
                                                        <use xlink:href="#icon-cross"></use>
                                                    </svg>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal__footer">
                    <div class="modal__container">
                        <div class="modal__footer-buttons">
                            <div class="modal__footer-button">
                                <button id="add-product" class="button button--primary button--block" data-dismiss="modal" data-modal="#addProductSuccess"><span class="button__text">Thêm</span>
                                </button>
                            </div>
                            <div class="modal__footer-button">
                                <button class="button button--secondary button--block" data-dismiss="modal"><span class="button__text">Cancel</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-compact modal-success scrollbar-thin" id="addProductSuccess" data-simplebar>
    <div class="modal__overlay" data-dismiss="modal"></div>
    <div class="modal__wrap">
        <div class="modal__window">
            <div class="modal__content">
                <div class="modal__body">
                    <div class="modal__container">
                        <img class="modal-success__icon" src="img/content/checked-success.svg" alt="#">
                        <h4 class="modal-success__title">Thêm sản phẩm thành công</h4>
                    </div>
                </div>
                <div class="modal-compact__buttons">
                    <div class="modal-compact__button-item">
                        <button class="modal-compact__button button" data-dismiss="modal" data-modal="#addProduct"><span class="button__text">Add new product</span>
                        </button>
                    </div>
                    <div class="modal-compact__button-item">
                        <button class="modal-compact__button button" data-dismiss="modal"><span class="button__text">Close</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once("templates/footer.php") ?>


</html>
1