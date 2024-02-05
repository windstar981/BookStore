<?php require_once("templates/header.php") ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('config/db_connect.php');


$noti = "";
if (isset($_GET['status']))  $noti = $_GET['status'] == 0 ? getLang('content_noti_0') : getLang('content_noti_ss');
if (isset($_POST['submit-login'])) {

	$email = $_POST['email'];
	$password = $_POST['password'];

	$query = "SELECT * From customers where cus_mail = '$email'";
	$res = mysqli_query($conn, $query);
	$row = mysqli_num_rows($res);

	if ($row > 0) {
		$user_logged = mysqli_fetch_assoc($res);
		$pass_saved = $user_logged['cus_password'];
		if ($user_logged['status'] == 0) {
			$errors['all'] = "Tài khoản chưa được kích hoạt";
		} else {
			if (password_verify($password, $pass_saved)) {
				$_SESSION['email'] = $user_logged['cus_mail'];
				$_SESSION['name'] = $user_logged['cus_name'];
				$_SESSION['id'] = $user_logged['cus_id'];
				$user_id = $user_logged['cus_id'];
				$sql = "select id from logs_login where user_id = $user_id";
				$res = mysqli_query($conn, $sql);
				$current_time = time();
				if(mysqli_num_rows($res) > 0){
					$id_log = mysqli_fetch_assoc($res)['id'];
					$sql = "update logs_login set last_login = current_login, current_login = $current_time";
					mysqli_query($conn, $sql);
				}else{
					$sql = "insert into logs_login(user_id, last_login, current_login) values($user_id, $current_time, $current_time)";
					mysqli_query($conn,$sql);
				}
				header('Location: index.php');
			} else {
				$errors['all'] = getLang('content_erro_pd');
				$email = $password  = "";
			}
		}
	} else {
		$errors['all'] = getLang('content_erro_pd');
		$email = $password  = "";
	}
}


?>
<div class="site-wrapper" id="top">
	<!--==============================================Login Register page content==============================================-->
	<main class="page-section inner-page-sec-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="row d-flex justify-content-center align-items-center h-100">
					<div class="col-lg-12 col-xl-11">
						<div class="card text-black" style="border-radius: 25px;">
							<div class="card-body">
								<div class="row justify-content-center">

									<div class="col-md-10 col-lg-6 col-xl-6 order-2 order-lg-1">
										<p class="text-center h2 fw-bold mb-5 mx-1 mx-md-4 mt-4"><?= getLang('content_login') ?></p>
										<?php if (isset($_GET['status'])) : ?>
											<div class="alert alert-success text-center " role="alert">
												<?php echo $noti ?>
											</div>
										<?php endif; ?>
										<form class="mx-1 mx-md-4 form-login" method="POST">
											<?php if (isset($_POST['submit-login'])) : ?>
												<div class="alert alert-danger text-center" role="alert">
													<?php echo $errors['all'] ?>
												</div>
											<?php endif; ?>
											<form class="mx-1 mx-md-4 form-login" method="POST">

												<div class="row">
													<div class="col-md-12 col-12 mb--15">
														<label for="email"><?= getLang('email')?></label>
														<input class="mb-0 form-control" name="email" type="email" id="email1" placeholder="<?= getLang('placeholder_email') ?>">
													</div>
													<div class="col-12 mb--20">
														<label for="password"><?= getLang('content_password')?></label>
														<input class="mb-0 form-control" name="password" type="password" id="login-password" placeholder="<?= getLang('placeholder_password')?>">
													</div>

												</div>

												
												<p class="font-weight-bold"><?= getLang('content_question_account')?> <a href="register.php" class="link-info text-primary"><?= getLang('content_this_regist')?></a></p>

												<div class="pt-1 mb-4 ">
													<button class="btn btn-dark btn-lg w-100" name="submit-login" type="submit"><?= getLang('content_login')?></button>
												</div>

											</form>

									</div>
									<div class="col-md-10 col-lg-6 col-xl-6 d-flex align-items-center order-1 order-lg-2">

										<img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">

									</div>
								</div>
							</div>
						</div>
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
<?php require_once("templates/footer.php") ?>


</html>