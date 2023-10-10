<?php
session_start();

include('config/db_connect.php');
?>



<!DOCTYPE html>
<html lang="en">
<?php require_once("templates/header.php") ?>
<?php include('config/db_connect.php'); ?>

<div class="site-wrapper" id="top">


    <!--=================================
        banner sách hot
    ===================================== -->
    <section class="hero-area hero-slider-3">
        <div class="sb-slick-slider" data-slick-setting='{
                                                        "autoplay": true,
                                                        "autoplaySpeed": 8000,
                                                        "slidesToShow": 1,
                                                        "dots":true
                                                        }'>


            <!-- --------------------------------------------- Banner ---------------------------------------------------------------------------------- -->

            <?php $sql = "SELECT * FROM banners";
            $res = mysqli_query($conn, $sql);
            $banners = mysqli_fetch_all($res, MYSQLI_ASSOC);

            ?>
            <?php
            foreach ($banners as $banner) :
            ?>

                <div class="single-slide bg-image img-fluid" data-bg="">
                <a href="<?php echo $banner['ba_link'] ?>"><img src="admin/<?php echo $banner['ba_image'] ?>" style="width:100%" alt="#"></a>
                    
                </div>

            <?php endforeach; ?>



        </div>
    </section>
    <!-- sách hot -->
    <section class="section-margin mt-5">
        <div class="container">
            <div class="section-title section-title--bordered">
                <h2>Sản phẩm HOT</h2>
            </div>
            <div class="product-slider sb-slick-slider slider-border-single-row" data-slick-setting='{
                        "autoplay": true,
                        "autoplaySpeed": 8000,
                        "slidesToShow": 5,
                        "dots":true
                    }' data-slick-responsive='[
                        {"breakpoint":1200, "settings": {"slidesToShow": 4} },
                        {"breakpoint":992, "settings": {"slidesToShow": 3} },
                        {"breakpoint":768, "settings": {"slidesToShow": 2} },
                        {"breakpoint":480, "settings": {"slidesToShow": 1} },
                        {"breakpoint":320, "settings": {"slidesToShow": 1} }
                    ]'>
                <?php
                $sl_id = "SELECT  od.pr_id, count(od.or_id) FROM orderdetail od, orders ors 
                where od.or_id = ors.or_id and DATEDIFF(CURDATE(), ors.or_date)<=7 
                GROUP BY od.pr_id ORDER BY  count(od.or_id) DESC LIMIT 7";
                $list_id = mysqli_query($conn, $sl_id);
                while ($row_id = mysqli_fetch_assoc($list_id)) {
                    $products_id = $row_id['pr_id'];

                    $sql = "SELECT  * FROM `products` where pr_id = $products_id and pr_status !=1 limit 7";
                    $res = mysqli_query($conn, $sql);
                    while ($row_romance = mysqli_fetch_assoc($res)) {
                        $name_img = explode(",", $row_romance['pr_img'])[0]; ?>
                        <div class="single-slide">
                            <div class="product-card">

                                <div class="product-card--body">
                                    <div class="card-image">

                                        <img src="admin/<?php echo $name_img; ?>" class="m-auto" style="width:190px; height:190px;" alt="">
                                        <div class="hover-contents">

                                            <div class="hover-btns">
                                                <a href="#" class="single-btn add_cart" value="<?php echo $row_romance['pr_id']; ?>">
                                                    <i class="fas fa-cart-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-header mt-2">
                                    <h3><a href="product-details.php?idsp=<?php echo $row_romance['pr_id']; ?>"><?php echo $row_romance['pr_name']; ?> </a></h3>
                                </div>
                                <div class="price-block">
                                    <span class="price"><?php echo number_format($row_romance['pr_price'] - $row_romance['pr_discount'], 0, ',', '.') . " VNĐ"; ?></span>
                                    <del class="price-old"><?php echo number_format($row_romance['pr_price'], 0, ',', '.') . " VNĐ"; ?></del>
                                    <span class="price-discount"><?php echo ceil(($row_romance['pr_discount']) / ($row_romance['pr_price']) * 100) ?>%</span>
                                </div>
                            </div>
                        </div>
                <?php  }
                } ?>
            </div>
        </div>
    </section>

    <!-- gợi ý hôm nay -->
    <section class="section-margin mt-5">
        <div class="container">
            <div class="section-title section-title--bordered">
                <h2>Gợi ý cho bạn hôm nay</h2>
            </div>
            <div class="product-slider sb-slick-slider slider-border-single-row" data-slick-setting='{
                        "autoplay": true,
                        "autoplaySpeed": 8000,
                        "slidesToShow": 5,
                        "dots":true
                    }' data-slick-responsive='[
                        {"breakpoint":1200, "settings": {"slidesToShow": 4} },
                        {"breakpoint":992, "settings": {"slidesToShow": 3} },
                        {"breakpoint":768, "settings": {"slidesToShow": 2} },
                        {"breakpoint":480, "settings": {"slidesToShow": 1} },
                        {"breakpoint":320, "settings": {"slidesToShow": 1} }
                    ]'>
                <?php

                //create table virtual
                $create_table = "CREATE TEMPORARY TABLE productnew as 
                ((SELECT  `pr_name`, `pr_author`, `pr_pub`, `pr_status`, `pr_category`, `pr_code`, `pr_number`, `pr_price`, `pr_discount`, `pr_img`, `pr_date`, `pr_desc`,orderdetail.or_id,orderdetail.pr_id,orders.or_date, COUNT(orderdetail.or_id) as number 
                from orders, orderdetail, products 
                where orders.or_id = orderdetail.or_id and  orderdetail.pr_id = products.pr_id 
                GROUP BY orderdetail.pr_id HAVING  datediff(date(curdate()), date(orders.or_date))<=3 
                ORDER BY COUNT(orderdetail.or_id) DESC))";
                mysqli_query($conn, $create_table);

                // $sl_recommend = "SELECT *, COUNT(orderdetail.or_id) 
                // from orders, orderdetail, products 
                // where orders.or_id = orderdetail.or_id and  orderdetail.pr_id = products.pr_id 
                // GROUP BY orderdetail.or_id 
                // HAVING  datediff(date(curdate()), date(orders.or_date))<=3 
                // ORDER BY COUNT(orderdetail.or_id) DESC 
                // LIMIT 10;";
                $sl_recommend = "SELECT *, sum(productnew.number) as sum FROM productnew, category 
                WHERE productnew.pr_category = category.c_id and pr_status !=1 GROUP BY pr_id ORDER BY SUM(productnew.number) DESC LIMIT 10";
                $res_recommend = mysqli_query($conn, $sl_recommend);
                // echo mysqli_num_rows($res_recommend);
                // exit;
                while ($row_recommend = mysqli_fetch_assoc($res_recommend)) {
                    $name_img = explode(",", $row_recommend['pr_img'])[0]; ?>
                    <div class="single-slide">
                        <div class="product-card">

                            <div class="product-card--body">
                                <div class="card-image">
                                    <img src="admin/<?php echo $name_img; ?>" class="m-auto" style="width:190px; height:190px;" alt="">
                                    <div class="hover-contents">

                                        <div class="hover-btns">
                                            <a href="#" class="single-btn add_cart" value="<?php echo $row_recommend['pr_id']; ?>">
                                                <i class="fas fa-cart-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-header mt-2">
                                    <h3><a href="product-details.php?idsp=<?php echo $row_recommend['pr_id']; ?>"><?php echo $row_recommend['pr_name']; ?> </a></h3>
                                </div>
                                <div class="price-block">
                                    <span class="price"><?php echo number_format($row_recommend['pr_price'] - $row_recommend['pr_discount'], 0, ',', '.') . " VNĐ"; ?></span>
                                    <del class="price-old"><?php echo number_format($row_recommend['pr_price'], 0, ',', '.') . " VNĐ"; ?></del>
                                    <span class="price-discount"><?php echo CEIL(($row_recommend['pr_discount']) / ($row_recommend['pr_price']) * 100); ?>%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php  }  ?>
            </div>
        </div>
    </section>
    <!-- in ra các thể loại -->
    <?php
    $sl_category = "SELECT * from category";
    $res_category = mysqli_query($conn, $sl_category);
    while ($row_category = mysqli_fetch_assoc($res_category)) { ?>
        <section class="section-margin">
            <div class="container">
                <div class="section-title section-title--bordered">
                    <h2><?php echo $row_category['c_name'] ?></h2>
                </div>
                <div class="product-slider sb-slick-slider slider-border-single-row" data-slick-setting='{
                        "autoplay": true,
                        "autoplaySpeed": 8000,
                        "slidesToShow": 5,
                        "dots":true
                    }' data-slick-responsive='[
                        {"breakpoint":1200, "settings": {"slidesToShow": 4} },
                        {"breakpoint":992, "settings": {"slidesToShow": 3} },
                        {"breakpoint":768, "settings": {"slidesToShow": 2} },
                        {"breakpoint":480, "settings": {"slidesToShow": 1} },
                        {"breakpoint":320, "settings": {"slidesToShow": 1} }
                    ]'>
                    <!-- thêm sản phẩm theo loại -->
                    <?php
                    $c_id = $row_category['c_id'];
                    $sl_romance = "SELECT * from products, category where products.pr_category = category.c_id and products.pr_category = $c_id  and pr_status !=1 limit 8";
                    $res_romance = mysqli_query($conn, $sl_romance);
                    while ($row_romance = mysqli_fetch_assoc($res_romance)) {
                        //xử lí lấy ảnh ra
                        $name_img = explode(",", $row_romance['pr_img'])[0];

                    ?>

                        <div class="single-slide">
                            <div class="product-card">

                                <div class="product-card--body">
                                    <div class="card-image">
                                        <img src="admin/<?php echo $name_img; ?>" class="m-auto" style="width:190px; height:190px;" alt="">
                                        <div class="hover-contents">
                                            <div class="hover-btns">
                                                <a class="single-btn add_cart" value="<?php echo $row_romance['pr_id']; ?>">
                                                    <i class="fas fa-cart-plus"></i>
                                                </a>

                                                <!-- <a href="product-details.php?idsp=<?php echo $row_romance['pr_id']; ?>" class="single-btn">
                                                        <i class="fas fa-eye"></i>
                                                    </a> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-header mt-2">
                                        <h3><a href="product-details.php?idsp=<?php echo $row_romance['pr_id']; ?>"><?php echo $row_romance['pr_name']; ?> </a></h3>
                                    </div>
                                    <div class="price-block">
                                        <span class="price"><?php echo number_format($row_romance['pr_price'] - $row_romance['pr_discount'], 0, ',', '.') . " VNĐ"; ?></span>
                                        <del class="price-old"><?php echo number_format($row_romance['pr_price'], 0, ',', '.') . " VNĐ"; ?></del>
                                        <span class="price-discount"><?php echo ceil((($row_romance['pr_discount']) / ($row_romance['pr_price']) * 100)); ?> %</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }

                    ?>
                </div>
            </div>
        </section>
    <?php }
    //phan moi
    ?>

    <!-- ------------------------------------------------ Foreach Thể loại ------------------------------------------------------------------ -->

    <!--=================================
        Home Features Section
    ===================================== -->
    <section class="mb--30 space-dt--30">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-6 mt--30">
                    <div class="feature-box h-100">
                        <div class="icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="text">
                            <h5>Free ship</h5><p>đơn hàng lớn hơn 500k</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mt--30">
                    <div class="feature-box h-100">
                        <div class="icon">
                            <i class="fas fa-redo-alt"></i>
                        </div>
                        <div class="text">
                            <h5>Đảm bảo hoàn tiền Hoàn lại 100% tiền</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mt--30">
                    <div class="feature-box h-100">
                        <div class="icon">
                            <i class="fas fa-piggy-bank"></i>
                        </div>
                        <div class="text">
                            <h5>Thanh toán khi nhận hàng</h5>
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mt--30">
                    <div class="feature-box h-100">
                        <div class="icon">
                            <i class="fas fa-life-ring"></i>
                        </div>
                        <div class="text">
                            <h5>Hỗ trợ miễn phí</h5>
                            <p>Gọi ngay: +8494724822</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================
        Promotion Section One
    ===================================== -->
    <!--=================================
    Footer
===================================== -->

    <!--=================================
  Brands Slider
===================================== -->



</div>
<?php require_once("templates/footer.php") ?>

</html>