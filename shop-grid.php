<!DOCTYPE html>
<html lang="zxx">

<?php
session_start();
include("templates/header.php");
include('admin/config/db_connect.php');
if (!isset($_GET['cid'])) {
	header('location: index.php');
} else {
	$id_c = $_GET['cid'];
	if (isset($_GET['page'])) {
		// (step*(page-1))+1
		$sl_all_pr1 = "SELECT * FROM products where pr_category = '$id_c'";
		$query1 = mysqli_query($conn, $sl_all_pr1);
		$numpr1 = mysqli_num_rows($query1);

		$page = $_GET['page'];
		if ($page <= 0 || $page > ceil($numpr1 / 8)) {
			//header('location: 404.php');
			$page = 1;
			$start = 0;
		} else {
			$start = 8 * ($_GET['page'] - 1);
		}
	} else {
		$page = 1;
		$start = 1;
	}
	// $end = $start+7;
	// echo $start;
	// echo $end;
	$sl_c = "SELECT * FROM category where c_id = '$id_c'";
	$res_c = (mysqli_query($conn, $sl_c));
	if (mysqli_num_rows($res_c) == 0) {
		header('location: index.php');
	}
}


?>
<section class="breadcrumb-section">
	<h2 class="sr-only">Site Breadcrumb</h2>
	<div class="container">
		<div class="breadcrumb-contents">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active">Shop</li>
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
			$cid = $_GET['cid'];
			$sl_product = "SELECT * FROM products where pr_category = '$cid' LIMIT $start, 8";
			$res_product = mysqli_query($conn, $sl_product);
			while ($row_pr = mysqli_fetch_assoc($res_product)) {
				$name_img = explode(",", $row_pr['pr_img'])[0];
			?>
				<div class="col-lg-4 col-sm-6">
					<div class="product-card">
						<div class="product-grid-content">
							<div class="product-card--body">
								<div class="card-image">
									<img src="admin/<?php echo $name_img; ?>" class="m-auto" style="width:190px; height:190px;" alt="">
									<div class="hover-contents">
										<div class="hover-btns">
											<a class="single-btn add_cart" value="<?php echo $row_pr['pr_id']; ?>">
												<i class="fas fa-cart-plus"></i>
											</a>

											<a href="product-details.php?idsp=<?php echo $row_pr['pr_id']; ?>" class="single-btn">
												<i class="fas fa-eye"></i>
											</a>
										</div>
									</div>
									
								</div>
								<div class="product-header mt-2">
									<h3><a href="product-details.php?idsp=<?php echo $row_pr['pr_id']; ?>"><?php echo $row_pr['pr_name'] ?></a></h3>
								</div>
								<div class="price-block">
										<span class="price"><?php echo number_format($row_pr['pr_price']-$row_pr['pr_discount'], 0, ',', '.'). " VNĐ";?></span>
										<del class="price-old"><?php echo number_format($row_pr['pr_price'], 0, ',', '.'). "VNĐ";?> </del>
										<span class="price-discount"><?php echo ceil((($row_pr['pr_discount'])/($row_pr['pr_price'])*100));?> %</span>
									</div>
							</div>
							<div class="product-header">
								<h3><a href="product-details.php?idsp=<?php echo $row_pr['pr_id']; ?>"><?php echo $row_pr['pr_name'] ?></a></h3>
							</div>
						</div>
					</div>
				</div>
			<?php }	?>
		</div>
		<!-- //stt -->
		<div class="row pt--30">
			<div class="col-md-12">
				<div class="pagination-block">
					<ul class="pagination-btns flex-center">
						<li><a href="shop-grid.php?cid=<?php echo $id_c; ?>&page=<?php echo 1; ?>" class="single-btn prev-btn ">|<i class="zmdi zmdi-chevron-left"></i> </a>
						</li>
						<li><a href="shop-grid.php?cid=<?php echo $id_c; ?>&page=<?php $page - 1 <= 0 ? $next = $page - 1 : $next = 1;
																				echo $next; ?>" class="single-btn prev-btn "><i class="zmdi zmdi-chevron-left"></i> </a>
						</li>
						<!-- <li class="active"><a href="" class="single-btn">1</a></li>
								<li><a href="" class="single-btn">2</a></li>
								<li><a href="" class="single-btn">3</a></li>
								<li><a href="" class="single-btn">4</a></li> -->
						<?php
						$sl_all_pr = "SELECT * FROM products where pr_category = '$id_c'";
						$query = mysqli_query($conn, $sl_all_pr);
						$numpr = mysqli_num_rows($query);
						for ($i = 1; $i <= ceil($numpr / 8); $i++) { ?>
							<li class="<?php if ($i == $page) echo "active" ?>"><a href="shop-grid.php?cid=<?php echo $id_c; ?>&page=<?php echo $i; ?>" class="single-btn"><?php echo $i; ?></a></li>
						<?php } ?>
						<li><a href="shop-grid.php?cid=<?php echo $id_c; ?>&page=<?php $page + 1 <= ceil($numpr / 8) ? $next = $page + 1 : $next = 1;
																				echo $next; ?>" class="single-btn next-btn"><i class="zmdi zmdi-chevron-right"></i></a>
						</li>
						<li><a href="shop-grid.php?cid=<?php echo $id_c; ?>&page=<?php echo ceil($numpr / 8); ?>" class="single-btn next-btn"><i class="zmdi zmdi-chevron-right"></i>|</a>
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