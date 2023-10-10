<?php
session_start();

include('../config/db_connect.php');
if (isset($_GET['id'])) {

    $id =  $_GET['id'];
    $sql = "SELECT  category.c_name as c_name, pr_id, pr_code, pr_name,pr_author, pr_pub, pr_category, pr_status,pr_date, pr_number, pr_price, pr_discount, pr_img, pr_desc from products, category where category.c_id = pr_category AND pr_id = '$id'";
    $res = mysqli_query($conn, $sql);
    if (!$res) header("Location: 404.php");
    if (mysqli_num_rows($res) == "0") {
        header("Location: 404.php");
    }
    $book = mysqli_fetch_assoc($res);
    $images = explode(",", $book['pr_img']);
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
            <h1 class="page-header__title">Chỉnh sửa sản phẩm</h1>
        </div>
        <div class="page-tools">
            <div class="page-tools__breadcrumbs">
                <div class="breadcrumbs">
                    <div class="breadcrumbs__container">
                        <ol class="breadcrumbs__list">
                            <li class="breadcrumbs__item">
                                <a class="breadcrumbs__link" href="index.html">
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
                            <li class="breadcrumbs__item"><a class="breadcrumbs__link" href="products.html"><span>Sản phẩm</span>
                                    <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                        <use xlink:href="#icon-keyboard-right"></use>
                                    </svg></a>
                            </li>
                            <li class="breadcrumbs__item active"><span class="breadcrumbs__link">Chi tiết sản phẩm</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="card add-product card--content-center">
            <div class="card__wrapper">
                <div class="card__container">
                    <?php if (isset($_GET['errors'])) :
                        $error = $_GET['errors'] == 1 ? "Vui lòng điền đầy đủ thông tin" : "Vui lòng chọn định dạng ảnh PNG, JPG, JPEG, GIF"
                    ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <div> <?php echo $error ?> </div>
                        </div>
                    <?php endif; ?>
                    <form class="add-product__form">
                        <div class="font-weight-bold">Mã sách: <?php echo $book['pr_code'] ?> </div>

                        <div class="d-flex justify-content-between mt-3">
                            <div class="d-flex ">

                                <button class="btn btn-primary" data-modal="#updateImages">
                                    Chỉnh sửa ảnh
                                </button>
                            </div>
                            <button class="btn btn-primary" data-modal=" #addProduct">
                                Chỉnh sửa thông tin
                            </button>
                        </div>
                        <div class=" add-product__row">
                            <div class="add-product__slider" id="addProductSlider">
                                <div class="add-product__thumbs">
                                    <div class="add-product__thumbs-slider swiper-container">
                                        <div class="swiper-wrapper">
                                            <?php foreach ($images as $image) : ?>

                                                <div class="add-product__thumb swiper-slide">
                                                    <img class="add-product__thumb-image swiper-lazy" src="<?php echo $image; ?>" srcset="<?php echo $image; ?> 2x" alt="#">
                                                    <div class="add-product__lazy-preloader swiper-lazy-preloader"></div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="add-product__thumbs-prev">
                                        <a class="add-product__thumbs-arrow add-product__thumbs-arrow--prev" href="#">
                                            <svg class="icon-icon-chevron">
                                                <use xlink:href="#icon-chevron"></use>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="add-product__thumbs-next">
                                        <a class="add-product__thumbs-arrow add-product__thumbs-arrow--next" href="#">
                                            <svg class="icon-icon-chevron">
                                                <use xlink:href="#icon-chevron"></use>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="add-product__gallery">
                                    <div class="add-product__gallery-slider swiper-container">
                                        <div class="swiper-wrapper">
                                            <?php foreach ($images as $image) : ?>
                                                <div class="add-product__gallery-slide swiper-slide">

                                                    <img class="add-product__gallery-image swiper-lazy" src="<?php echo $image; ?>" srcset="<?php echo $image; ?> 2x" alt="#">
                                                    <div class="add-product__lazy-preloader swiper-lazy-preloader"></div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="add-product__right">

                                <div class="row row--md">

                                    <div class="col-12 form-group form-group--lg">
                                        <label class="form-label ">Tên sách</label>
                                        <div class="input-group">
                                            <input disabled class="input" type="text" placeholder="" value="<?php echo $book['pr_name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group form-group--lg">
                                        <label class="form-label">Tồn kho</label>
                                        <div class="input-group">
                                            <input disabled class="input" type="text" value="<?php echo $book['pr_number']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 form-group form-group--lg">
                                        <label class="form-label">Tên tác giả</label>
                                        <div class="input-group">
                                            <input disabled class="input" type="text" placeholder="" value="<?php echo $book['pr_author']; ?>" required>
                                        </div>
                                    </div>
                                    <div class=" col-12 form-group form-group--lg">
                                        <label class="form-label">NXB</label>
                                        <div class="input-group">
                                            <input disabled class="input" type="text" placeholder="" value="<?php echo $book['pr_pub']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-12 form-group form-group--lg">
                                        <label class="form-label">Thể loại</label>
                                        <div class="input-group">
                                            <input disabled class="input" type="text" placeholder="" value="<?php echo $book['c_name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group form-group--lg">
                                        <label class="form-label">Mô tả chi tiết</label>
                                        <div class="input-editor">
                                            <textarea disabled class="form-control" id="exampleFormControlTextarea3" rows="5" name="desc"><?php echo $book['pr_desc']; ?>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group form-group--lg">
                                        <label class="form-label">Ngày đăng</label>
                                        <div class="input-group">
                                            <input disabled class="input" type="text" placeholder="" value="<?php echo $book['pr_date'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group form-group--lg">
                                        <label class="form-label">Trạng thái</label>
                                        <div class="input-group">
                                            <input disabled class="input" type="text" placeholder="" value="<?php if ($book['pr_status'] == 1)  echo "Private";
                                                                                                            else echo "Public" ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 form-group form-group--lg">
                                        <label class="form-label">Giá (VNĐ)</label>
                                        <div class="input-group input-group--prepend">
                                            <div class="input-group__prepend"><span class="input-group__symbol"></span>
                                            </div>
                                            <input disabled class="input" type="number" min="0" max="999999999" placeholder="" value="<?php echo $book['pr_price']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 form-group form-group--lg">
                                        <label class="form-label">Giảm giá (VNĐ)</label>
                                        <div class="input-group input-group--prepend">
                                            <div class="input-group__prepend"><span class="input-group__symbol"></span>
                                            </div>
                                            <input disabled class="input" type="number" min="0" max="100" placeholder="" value="<?php echo $book['pr_discount']; ?>" required>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</main>
</div>
<div class="modal modal-compact modal-success" id="addProductSuccess">
    <div class="modal__overlay" data-dismiss="modal"></div>
    <div class="modal__wrap">
        <div class="modal__window">
            <div class="modal__content">
                <div class="modal__body">
                    <div class="modal__container">
                        <img class="modal-success__icon" src="img/content/checked-success.svg" alt="#">
                        <h4 class="modal-success__title">Product was added</h4>
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
<div class="modal modal--panel modal--right" id="addProduct">
    <div class="modal__overlay" data-dismiss="modal"></div>
    <div class="modal__wrap">
        <div class="modal__window scrollbar-thin" data-simplebar>
            <div class="modal__content">
                <div class="modal__header">
                    <div class="modal__container">
                        <h2 class="modal__title">Chỉnh sửa thông tin sản phẩm</h2>
                    </div>
                </div>
                <div class="modal__body">
                    <div class="modal__container">
                        <form method="POST" id="form-update" action="core/update-product.php?id=<?php echo $book['pr_id'] ?>">
                            <div class="row row--md">
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Tên sách</label>
                                    <div class="input-group">
                                        <input class="input" type="text" value="<?php echo $book['pr_name']; ?>" placeholder="Nhập tên sách" required name="pr_name">
                                    </div>
                                </div>
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Mã sách</label>
                                    <div class="input-group">
                                        <input class="input" type="text" value="<?php echo $book['pr_code']; ?>" placeholder="Nhập mã sách" required name="pr_code">
                                    </div>
                                </div>

                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Tên tác giả</label>
                                    <div class="input-group">
                                        <input class="input" type="text" value="<?php echo $book['pr_author']; ?>" placeholder="Nhập tên tác giả" required name="auth_name">
                                    </div>
                                </div>

                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Nhà xuất bản</label>
                                    <div class="input-group">
                                        <input class="input" type="text" value="<?php echo $book['pr_pub']; ?>" placeholder="Nhà xuất bản" required name="pub_name">
                                    </div>
                                </div>

                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Số lượng sách</label>
                                    <div class="input-group">
                                        <input class="input" type="number" value="<?php echo $book['pr_number']; ?>" placeholder="Nhập số lượng" required name="pr_number">
                                    </div>
                                </div>
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Mô tả chi tiết</label>
                                    <div class="input-editor">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" value="<?php echo $book['pr_desc']; ?>" placeholder="Nhập mô tả chi tiết sản phẩm" rows="5" name="pr_desc"><?php echo $book['pr_desc']; ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Thể loại</label>
                                    <div class="input-group input-group--append">
                                        <select class="input js-input-select input--fluid" data-placeholder="" name="pr_category">

                                            <?php
                                            include('../config/db_connect.php');
                                            $sl_Category = "SELECT * FROM `category`";
                                            $res_Category = mysqli_query($conn, $sl_Category);
                                            while ($row = mysqli_fetch_assoc($res_Category)) { ?>
                                                <option <?php if ($book['pr_category'] == $row['c_id']) echo "selected" ?> value="<?php echo $row['c_id']; ?>"><?php echo $row['c_name'] ?></option>
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
                                        <select name="pr_status" class="input js-input-select input--fluid" data-placeholder="">

                                            <option <?php if ($book['pr_status'] == 2) echo 'selected' ?> value="2">Public
                                            </option>
                                            <option <?php if ($book['pr_status'] == 1) echo 'selected' ?> value="1">Private
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
                                        <input class="input" type="number" min="0" max="999999999" value="<?php echo $book['pr_price']; ?>" placeholder="VNĐ" id="pr_price" name="pr_price" value="" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 form-group form-group--lg">
                                    <label class="form-label">Giảm giá (VNĐ)</label>
                                    <div class="input-group input-group--prepend">
                                        <input class="input" type="number" min="0" max="999999999" placeholder="VN" value="<?php echo $book['pr_discount']; ?>" id="pr_discount" name="pr_discount" value="" required>

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
                                <input type="submit" name="update-product" value="Lưu" id="update-product" class="button button--primary button--block" data-dismiss="modal">
                            </div>
                            <div class="modal__footer-button">
                                <button class="button button--secondary button--block" data-dismiss="modal"><span class="button__text">Thoát</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal--panel modal--right" id="updateImages">
    <div class="modal__overlay" data-dismiss="modal"></div>
    <div class="modal__wrap">
        <div class="modal__window scrollbar-thin" data-simplebar>
            <div class="modal__content">
                <div class="modal__header">
                    <div class="modal__container">
                        <h2 class="modal__title">Chỉnh sửa ảnh sản phẩm</h2>
                    </div>
                </div>
                <div class="modal__body">
                    <div class="modal__container">
                        <form method="POST" id="form-images" enctype="multipart/form-data" action="core/upload-images.php?id=<?php echo $book['pr_id'] ?>">
                            <div class="row row--md">
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Ảnh sản phẩm</label>
                                    <div class="image-upload">
                                        <div class="image-upload__drop">
                                            <input class="input d-none" type="text" value="<?php echo $book['pr_code']; ?>" placeholder="Nhập mã sách" required name="pr_code">
                                            <input class="image-upload__input" type="file" name="pr_images[]" multiple accept="image/png, image/jpeg" />
                                            <div class="image-upload__drop-text">
                                                <svg class="icon-icon-upload">
                                                    <use xlink:href="#icon-upload"></use>
                                                </svg> <span>Kéo và thả hoặc </span> <span class="image-upload__drop-action text-blue">duyệt</span> <span>để tải ảnh lên</span>
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
                                <input type="submit" id="update-images" value="Lưu" class="button button--primary button--block" data-dismiss="modal">

                            </div>
                            <div class="modal__footer-button">
                                <button class="button button--secondary button--block" data-dismiss="modal"><span class="button__text">Thoát</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once("templates/footer.php") ?>

</html>