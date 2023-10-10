<!DOCTYPE html>
<html lang="zxx">

<?php 
session_start();
include("templates/header.php");
include('admin/config/db_connect.php');



?>
<section class="breadcrumb-section">
    <h2 class="sr-only">Site Breadcrumb</h2>
    <div class="container">
        <div class="breadcrumb-contents">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Sản phẩm hot</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<main class="inner-page-sec-padding-bottom">
    <div class="container">
        <!-- Pagination Block -->
        <div class="shop-product-wrap with-pagination row space-db--30 shop-border grid-four">
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
                    $name_img = explode(",", $row_romance['pr_img'])[0];
            ?>
                    <div class="col-lg-4 col-sm-6">
                        <div class="product-card">
                            <div class="product-grid-content">
                                <div class="product-card--body">
                                    <div class="card-image">
                                        <img src="admin/<?php echo $name_img; ?>" class="m-auto" style="width:190px; height:190px;" alt="">
                                        <div class="hover-contents">
                                            <div class="hover-btns">
                                                <a class="single-btn add_cart" value="<?php echo $row_romance['pr_id']; ?>">
                                                    <i class="fas fa-cart-plus"></i>
                                                </a>

                                                <a href="product-details.php?idsp=<?php echo $row_romance['pr_id']; ?>" class="single-btn">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-block">
                                        <span class="price"><?php echo number_format($row_romance['pr_price'] - $row_romance['pr_discount'], 0, ',', '.') . " VNĐ"; ?></span>
                                        <del class="price-old"><?php echo number_format($row_romance['pr_price'], 0, ',', '.') . "VNĐ"; ?> </del>
                                        <span class="price-discount"><?php echo ceil((($row_romance['pr_discount']) / ($row_romance['pr_price']) * 100)); ?> %</span>
                                    </div>
                                </div>
                                <div class="product-header">
                                    <h3><a href="product-details.php?idsp=<?php echo $row_romance['pr_id']; ?>"><?php echo $row_romance['pr_name'] ?></a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php  }
            } ?>
        </div>
        <!-- //stt -->
        <div class="row pt--30">
            <div class="col-md-12">
                <div class="pagination-block">
                    <ul class="pagination-btns flex-center">
                        <li><a href="" class="single-btn prev-btn ">|<i class="zmdi zmdi-chevron-left"></i> </a>
                        </li>
                        <li><a href="" class="single-btn prev-btn "><i class="zmdi zmdi-chevron-left"></i> </a>
                        </li>
                        <li class="active"><a href="" class="single-btn">1</a></li>
                        <li><a href="" class="single-btn">2</a></li>
                        <li><a href="" class="single-btn">3</a></li>
                        <li><a href="" class="single-btn">4</a></li>
                        <li><a href="" class="single-btn next-btn"><i class="zmdi zmdi-chevron-right"></i></a>
                        </li>
                        <li><a href="" class="single-btn next-btn"><i class="zmdi zmdi-chevron-right"></i>|</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</main>
</div>
<!--=================================
  Brands Slider
===================================== -->

<!--=================================
    Footer Area
===================================== -->
<?php
include('templates/footer.php'); ?>