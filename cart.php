<!DOCTYPE html>
<html lang="eng">

<?php 
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: index.php');
}
include("templates/header.php"); 
?>
<div class="site-wrapper" id="top">

	<section class="breadcrumb-section">
		<h2 class="sr-only"></h2>
		<div class="container">
			<div class="breadcrumb-contents">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
						<li class="breadcrumb-item active">Giỏ hàng</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>
	<!-- Cart Page Start -->
	<main class="cart-page-main-block inner-page-sec-padding-bottom">
		<div class="cart_area cart-area-padding  ">
			<div class="container">
				<div class="page-section-title">
					<h1>Giỏ hàng</h1>
				</div>
				<div class="row">
					<div class="col-12">
						<form action="#" class="">
							<!-- Cart Table -->
							<div class="cart-table table-responsive mb--40">
								<table class="table">
									<!-- Head Row -->
									<thead>
										<tr>
											<th class="pro-remove"></th>
											<th class="pro-thumbnail">Ảnh</th>
											<th class="pro-title">Tên</th>
											<th class="pro-price">Giá</th>
											<th class="pro-quantity">Số lượng</th>
											<th class="pro-subtotal">Thành tiền</th>
										</tr>
									</thead>
									<tbody id = "tb_bd">
										<!-- Product Row -->
										<?php
										if(isset($_SESSION['id']))
										{ 
											include('config/db_connect.php');
											$cus_id = $_SESSION['id'];
											$sl_cart = "SELECT * FROM carts, products pr where carts.cus_id = '$cus_id' and carts.pr_id = pr.pr_id ";
											
											$res_cart = mysqli_query($conn, $sl_cart);
											while($row_cart = mysqli_fetch_assoc($res_cart))
											{
												$name_img = explode(",",$row_cart['pr_img'])[0];
											?>
											
											
										<tr>
											<td class="pro-remove"><a href="core/cart_delete_product.php?prid=<?php echo $row_cart['pr_id']; ?>"><i class="far fa-trash-alt"></i></a>
											</td>
											<td class="pro-thumbnail"><a href="#"><img src="admin/<?php echo $name_img;?>" alt="Product"></a></td>
											<td class="pro-title"><a href="#"><?php echo $row_cart['pr_name']; ?></a></td>
											<td class="pro-price"><span><?php echo $row_cart['pr_price']-$row_cart['pr_discount']; ?></span></td>
											<td class="pro-quantity">
												<div class="pro-qty">
													<div class="count-input-block">
														<input type="number" class="form-control text-center cart_quatity" id_pr ="<?php echo $row_cart['pr_id'];?>" value="<?php echo $row_cart['cart_quatity'];?>">
													</div>
												</div>
											</td>
											<td class="pro-subtotal"><span><?php echo ($row_cart['pr_price']-$row_cart['pr_discount'])*$row_cart['cart_quatity']; ?></span></td>
										</tr>
										<?php }}
										?>
										<!-- Product Row -->
										<!-- Discount Row  -->
										
										<tr>
											<td colspan="6" class="actions">
												<div class="update-block text-right">
													<a href="checkout.php" class="btn btn-outlined" name="update_cart">Đặt hàng</a>
													
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</main>
	<!-- Cart Page End -->
</div>
<!--=================================
  Brands Slider
===================================== -->


<?php include("templates/footer.php") ?>


</html>