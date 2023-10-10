<?php
ob_start();




?>

<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BookStore - H&K</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Use Minified Plugins Version For Fast Page Load -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/plugins.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/app.css" />

    <link rel="shortcut icon" type="image/x-icon" href="image/title2.png" alt="">
</head>

<body>
    <div class="site-header header-3  d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <ul class="header-top-list">

                        <li class="dropdown-trigger language-dropdown"><a href=""><span class="flag-img"><img src="image/icon/eng-flag.png" alt=""></span>en-gb </a><i class="fas fa-chevron-down dropdown-arrow"></i>
                            <ul class="dropdown-box">
                                <li> <a href=""> <span class="flag-img"><img src="image/icon/eng-flag.png" alt=""></span>English</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-8 flex-lg-right">
                    <ul class="header-top-list">


                        <li class="dropdown-trigger language-dropdown">
                            <?php if (isset($_SESSION['name'])) : ?>
                                <a href=""><i class="icons-left fas fa-user"></i>
                                    <?php echo $_SESSION['name'] ?>
                                </a>
                                <i class="fas fa-chevron-down dropdown-arrow"></i>
                                <ul class="dropdown-box">
                                    <li> <a href="profile.php">Tài khoản</a></li>
                                    <li> <a href="customer-orders.php">Đơn hàng</a></li>
                                    <li> <a href="book-request.php">Yêu cầu sách</a></li>
                                    <li> <a href="change-password.php">Đổi mật khẩu</a></li>
                                    <li> <a href="logout.php">Đăng xuất</a></li>


                                </ul>
                            <?php else : ?>
                                <a href="login.php"><i class="icons-left fas fa-user"></i>
                                    Tài khoản của tôi
                                </a>
                            <?php endif; ?>
                        </li>
                        <li><a href=""><i class="icons-left fas fa-phone"></i> Liên hệ</a>
                        </li>
                        <li><a href=""><i class="icons-left fas fa-share"></i> Đặt hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-middle pt--10 pb--10">
            <div class="container">
                <div class="row search-form">
                    <div class="col-lg-3">
                        <a href="index.php" class="site-brand">
                            <img src="image/logo.png" alt="">
                        </a>
                    </div>
                    <div class="col-lg-5">
                        <div class="header-search-block">
                            <form action="search-products.php" id="search-form">

                                <input id="search-input" name="keyword" type="text" autocomplete="off" placeholder="Tìm kiếm sách">
                                <button type="submit" name="search">Tìm kiếm</button>
                            </form>
                            <div class="autocomplete-suggestions search-display d-none">


                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="main-navigation flex-lg-right">
                            <div class="cart-widget">
                                <?php if (!isset($_SESSION['name'])) : ?>

                                    <div class="login-block">
                                        <a href="login.php" class="font-weight-bold">Đăng nhập</a> <br>
                                        <span>or</span><a href="register.php">Đăng ký</a>
                                    </div>
                                <?php endif; ?>
                                <div class="cart-block">
                                    <div class="cart-total">
                                        <span class="text-number">
                                            <?php
                                            if (isset($_SESSION['id'])) {
                                                include('admin/config/db_connect.php');
                                                $cus_id = $_SESSION['id'];
                                                $sl_cart = "SELECT * FROM carts, products where cus_id = '$cus_id' and carts.pr_id = products.pr_id";
                                                $res_sl_cart = mysqli_query($conn, $sl_cart);
                                                $numpr = mysqli_num_rows($res_sl_cart);
                                                echo $numpr;
                                            } else {
                                                echo 0;
                                            }
                                            ?>
                                        </span>
                                        <span class="text-item">
                                            Giỏ hàng
                                        </span>
                                        <span class="price">

                                            <i class="fas fa-chevron-down"></i>
                                        </span>
                                    </div>
                                    <div class="cart-dropdown-block">
                                        <?php
                                        if (isset($_SESSION['id'])) {
                                            $count = 1;
                                            while ($row_pr = mysqli_fetch_assoc($res_sl_cart)) {
                                                if ($count > 4) {
                                                    echo "<h6><a class='title ml-2' href='cart.php'>Hiển thị thêm</a></h6>";
                                                    break;
                                                }
                                                $name_img = explode(",", $row_pr['pr_img'])[0];
                                        ?>
                                                <div class=" single-cart-block ">
                                                    <div class="cart-product">
                                                        <a href="product-details.php" class="image">
                                                            <img src="admin/<?php echo $name_img; ?>" style="min-width:60px; max-width:60px; max-heigth:60px; min-height:60px;">
                                                        </a>
                                                        <div class="content">
                                                            <h3 class="title"><a href="product-details.php"><?php echo $row_pr['pr_name']; ?></a></h3>
                                                            <p class="price"><span><?php echo $row_pr['cart_quatity']; ?> x </span> <?php echo number_format($row_pr['cart_price'], 0, ',', '.') . " VNĐ"; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php $count++;
                                            }
                                        }
                                        ?>
                                        <div class=" single-cart-block ">
                                            <div class="btn-block">
                                                <a href="cart.php" class="btn">Xem giỏ hàng<i class="fas fa-chevron-right"></i></a>
                                                <a href="checkout.php" class="btn btn--primary">Đặt hàng<i class="fas fa-chevron-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- @include('menu.htm') -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="row align-items-center mb-3">
                    <div class="col-lg-3">
                        <nav class="category-nav">
                            <div>
                                <a href="javascript:void(0)" class="category-trigger"><i class="fa fa-bars"></i>Các thể loại sách</a>
                                <ul class="category-menu">
                                    <!-- thêm các thể loại -->
                                    <?php
                                    include('admin/config/db_connect.php');
                                    $sl_category = "SELECT * FROM category";
                                    $res_category = mysqli_query($conn, $sl_category);
                                    while ($row_category = mysqli_fetch_assoc($res_category)) {
                                    ?>
                                        <li class="cat-item"><a href="shop-grid.php?cid=<?php echo $row_category['c_id'] ?>"><?php echo $row_category['c_name'];  ?></a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="col-lg-3">
                        <div class="header-phone ">
                            <div class="icon">
                                <i class="fas fa-headphones-alt"></i>
                            </div>
                            <div class="text">
                                <p>Hỗ trợ miễn phí 24/7</p>
                                <p class="font-weight-bold number">0964536644</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="main-navigation flex-lg-right">
                            <ul class="main-menu menu-right li-last-0">
                                <li class="menu-item has-children">
                                    <a href="index.php">Trang chủ </a>

                                </li>
                                <li class="menu-item has-children">
                                    <a href="hot-products.php">Sản phẩm hot</a>

                                </li>
                                <!-- Shop -->
                                <li class="menu-item has-children mega-menu">
                                    <a href="book-request.php">Yêu cầu sách </a>

                                </li>
                                <!-- Pages -->

                                <!-- Blog -->


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-mobile-menu">
        <header class="mobile-header d-block d-lg-none pt--10 pb-md--10">
            <div class="container">
                <div class="row align-items-sm-end align-items-center">
                    <div class="col-md-4 col-7">
                        <a href="index.php" class="site-brand">
                            <img src="image/logo.png" alt="">
                        </a>
                    </div>
                    <div class="col-md-5 order-3 order-md-2">
                        <nav class="category-nav">
                            <div>
                                <a href="javascript:void(0)" class="category-trigger"><i class="fa fa-bars"></i>Các thể loại sách</a>
                                <ul class="category-menu">
                                    <!-- thêm các thể loại -->
                                    <?php
                                    include('admin/config/db_connect.php');
                                    $sl_category = "SELECT * FROM category";
                                    $res_category = mysqli_query($conn, $sl_category);
                                    while ($row_category = mysqli_fetch_assoc($res_category)) {
                                    ?>
                                        <li class="cat-item"><a href="shop-grid.php?cid=<?php echo $row_category['c_id'] ?>"><?php echo $row_category['c_name'];  ?></a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="col-md-3 col-5  order-md-3 text-right">
                        <div class="mobile-header-btns header-top-widget">
                            <ul class="header-links">
                                <li class="sin-link">
                                    <a href="cart.php" class="cart-link link-icon"><i class="ion-bag"></i></a>
                                </li>
                                <li class="sin-link">
                                    <a href="javascript:" class="link-icon hamburgur-icon off-canvas-btn"><i class="ion-navicon"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--Off Canvas Navigation Start-->
        <aside class="off-canvas-wrapper">
            <div class="btn-close-off-canvas">
                <i class="ion-android-close"></i>
            </div>
            <div class="off-canvas-inner">
                <!-- search box start -->
                <div class="search-box offcanvas">
                    <form>
                        <input type="text" placeholder="Search Here">
                        <button class="search-btn"><i class="ion-ios-search-strong"></i></button>
                    </form>
                </div>
                <!-- search box end -->
                <!-- mobile menu start -->
                <div class="mobile-navigation">
                    <!-- mobile menu navigation start -->
                    <nav class="off-canvas-nav">
                        <ul class="mobile-menu main-mobile-menu">
                            <li class="menu-item-has-children">
                                <a href="#">Trang chủ</a>

                            </li>

                            <li class="menu-item-has-children">
                                <a href="#">Sản phẩm hot</a>

                            </li>

                            <li><a href="contact.html">Yêu cầu sách</a></li>
                        </ul>
                    </nav>
                    <!-- mobile menu navigation end -->
                </div>
                <!-- mobile menu end -->
                <nav class="off-canvas-nav">
                    <ul class="mobile-menu menu-block-2">


                        <li class="menu-item-has-children mb-4">
                            <?php if (isset($_SESSION['name'])) : ?>
                                <a href="#"> <?php echo $_SESSION['name'] ?> <i class="fas fa-angle-down"></i></a>

                                <ul class="sub-menu">
                                    <li> <a href="profile.php">Tài khoản</a></li>
                                    <li> <a href="customer-orders.php">Đơn hàng</a></li>
                                    <li> <a href="customer-orders.php">Yêu cầu sách</a></li>
                                    <li> <a href="change-password.php">Đổi mật khẩu</a></li>
                                    <li> <a href="logout.php">Đăng xuất</a></li>

                                </ul>

                            <?php else : ?>
                                <a href="login.php"><i class="icons-left fas fa-user"></i>
                                    Tài khoản của tôi
                                </a>
                            <?php endif; ?>


                        </li>
                    </ul>
                </nav>
                <div class="off-canvas-bottom">
                    <div class="contact-list mb--10">
                        <a href="#" class="sin-contact"><i class="fas fa-mobile-alt"></i>0964536632</a>
                        <a href="#" class="sin-contact"><i class="fas fa-envelope"></i>H&K@gmail.com</a>
                    </div>
                    <div class="off-canvas-social">
                        <a href="#" class="single-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="single-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="single-icon"><i class="fas fa-rss"></i></a>
                        <a href="#" class="single-icon"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="single-icon"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="single-icon"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </aside>
        <!--Off Canvas Navigation End-->
    </div> 
    <div class="toast d-none" id = "toast-success" role="alert" aria-live="assertive" aria-atomic="true">

        <div class="toast-body" id = "success-body">
            
        </div>
    </div>  <div class="toast d-none" id = "toast-danger" role="alert" aria-live="assertive" aria-atomic="true">

        <div class="toast-body" id = "danger-body">
            
        </div>
    </div>