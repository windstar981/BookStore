<?php
session_start();
include('admin/config/db_connect.php');
if (!isset($_GET['search'])) {
    header('location: index.php');
} else {
    $key = $_GET['keyword'];
    $sql = "SELECT * FROM products where pr_status = 2 and pr_name like '%$key%' or pr_code like '%$key%' or pr_author like '%$key%' or pr_pub like '%$key%'";
    $res = mysqli_query($conn, $sql);
    $products = mysqli_fetch_all($res, MYSQLI_ASSOC);
    if (mysqli_num_rows($res) == 0) {
        header('location: index.php');
    }
}

?>

<!DOCTYPE html>
<html lang="zxx">

<?php include("templates/header.php");

?>
<section class="breadcrumb-section">
    <h2 class="sr-only">Site Breadcrumb</h2>
    <div class="container">
        <div class="breadcrumb-contents">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Tìm kiếm "<?php echo $key ?>"</li>
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
            foreach ($products as $product) :
                $name_img = explode(",", $product['pr_img'])[0];
            ?>
                <div class="col-lg-4 col-sm-6">
                    <div class="product-card">

                        <div class="product-card--body">
                            <div class="card-image">

                                <img src="admin/<?php echo $name_img; ?>" class="m-auto" style="width:190px; height:190px;" alt="">
                                <div class="hover-contents">

                                    <div class="hover-btns">
                                        <a href="#" class="single-btn add_cart" value="<?php echo $product['pr_id']; ?>">
                                            <i class="fas fa-cart-plus"></i>
                                        </a>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-header mt-2">
                            <h3><a href="product-details.php?idsp=<?php echo $product['pr_id']; ?>"><?php echo $product['pr_name']; ?> </a></h3>
                        </div>
                        <div class="price-block">
                            <span class="price"><?php echo number_format($product['pr_price'] - $product['pr_discount'], 0, ',', '.') . " VNĐ"; ?></span>
                            <del class="price-old"><?php echo number_format($product['pr_price'], 0, ',', '.') . " VNĐ"; ?></del>
                            <span class="price-discount"><?php echo ceil(($product['pr_discount']) / ($product['pr_price']) * 100) ?>%</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
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

<?php
include('templates/footer.php'); ?>