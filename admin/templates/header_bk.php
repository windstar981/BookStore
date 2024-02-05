<?php
ob_start();
if (!isset($_SESSION['u_id'])) {
    header('Location: login.php');
}
?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="MobileOptimized" content="320" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <meta name="description" content="Arion — This is the best dashboard" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="application-name" content="Arion — This is the best dashboard" />
    <meta name="apple-mobile-web-app-title" content="Arion Admin Dashboard" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/apexcharts.css" />
    <link rel="stylesheet" href="css/tippy/tippy.css" />
    <link rel="stylesheet" href="css/flatpickr.min.css" />
    <link rel="stylesheet" href="css/select2.min.css" />
    <link rel="stylesheet" href="css/quill/quill.snow.css" />
    <link rel="stylesheet" href="css/quill/quill.core.css" />
    <link rel="stylesheet" href="css/filepond.min.css" />
    <link rel="stylesheet" href="css/filepond-plugin-image-preview.min.css" />
    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/app.css" />
    <link rel="icon" type="image/png" sizes="192x192" href="img/logo/title2.png" />
    <!-- <link rel="manifest" href="img/content/favicons/manifest.json" />-->
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png" />
    <meta name="theme-color" content="#ffffff" />
</head>

<div class="sidebar-backdrop"></div>
<div class="page-wrapper">
    <header class="header">
        <div class="header__inner">
            <div class="container-fluid">
                <div class="header__row row justify-content-between">
                    <div class="header__col-left col d-flex align-items-center">
                        <div class="header__left-toggle">
                            <button class="header__toggle-menu toggle-sidebar" type="button">
                                <svg class="icon-icon-menu">
                                    <use xlink:href="#icon-menu"></use>
                                </svg>
                            </button>
                            <button class="header__toggle-search toggle-search">
                                <svg class="icon-icon-search">
                                    <use xlink:href="#icon-search"></use>
                                </svg>
                            </button>
                        </div>
                        <div class="header__search">

                        </div>
                    </div>
                    <div class="header__col-right col d-flex align-items-center">


                        <div class="header__profile dropdown">
                            <a class="header__profile-toggle dropdown__toggle" href="#" data-toggle="dropdown">
                                <div class="header__profile-image"><span class="header__profile-image-text">MA</span>
                                    <img src="img/content/humans/default.png" alt="#" />
                                </div>
                                <div class="header__profile-text"><span><?php echo $_SESSION['full_name'] ?></span>
                                </div><span class="icon-arrow-down">
                                    <svg class="icon-icon-arrow-down">
                                        <use xlink:href="#icon-arrow-down"></use>
                                    </svg></span>
                            </a>
                            <div class="profile-dropdown dropdown-menu dropdown-menu--right"><a href="logout.php" class="profile-dropdown__item dropdown-menu__item" tabindex="0"><span class="profile-dropdown__icon">
                                        <svg class="icon-icon-logout">
                                            <use xlink:href="#icon-logout"></use>
                                        </svg></span><span>Đăng xuất</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <aside class="sidebar">
        <div class="sidebar__backdrop"></div>
        <div class="sidebar__container">
            <div class="sidebar__top">
                <div class="container container--sm">
                    <a class="sidebar__logo" href="index.php">
                        <img class="sidebar__logo-icon" src="img/logo/logo.png" alt="#" style="width:100%" />
                    </a>
                </div>
            </div>
            <div class="sidebar__content" data-simplebar="data-simplebar">
                <nav class="sidebar__nav">
                    <ul class="sidebar__menu">
                        <li class="sidebar__menu-item"><a class="sidebar__link <?php if (basename($_SERVER['PHP_SELF']) == "index.php") echo "active" ?>"" href=" index.php" aria-expanded="false"><span class="sidebar__link-icon">
                                    <svg class="icon-icon-dashboard">
                                        <use xlink:href="#icon-dashboard"></use>
                                    </svg></span><span class="sidebar__link-text">Dashboard</span></a>
                        </li>
                        <li class="sidebar__menu-item"><a class="sidebar__link <?php if (basename($_SERVER['PHP_SELF']) == "products.php") echo "active" ?>"" href=" products.php" data-toggle="collapse" data-target="#E-Commerce" aria-expanded="true"><span class="sidebar__link-icon">
                                    <svg class="icon-icon-cart">
                                        <use xlink:href="#icon-cart"></use>
                                    </svg></span><span class="sidebar__link-text">Quản lý</span><span class="sidebar__link-arrow">
                                    <svg class="icon-icon-keyboard-down">
                                        <use xlink:href="#icon-keyboard-down"></use>
                                    </svg></span></a>
                            <div class="collapse show" id="E-Commerce">
                                <ul class="sidebar__collapse-menu">
                                    <li class="sidebar__menu-item"><a class="sidebar__link <?php if (basename($_SERVER['PHP_SELF']) == "products.php") echo "active" ?>" href="products.php"><span class="sidebar__link-signal"></span><span class="sidebar__link-text">Sản phẩm</span></a>
                                    </li>

                                    <li class="sidebar__menu-item"><a class="sidebar__link <?php if (basename($_SERVER['PHP_SELF']) == "categories.php") echo "active" ?>" href="categories.php"><span class="sidebar__link-signal"></span><span class="sidebar__link-text">Thể loại</span></a>
                                    </li>
                                    <li class="sidebar__menu-item"><a class="sidebar__link <?php if (basename($_SERVER['PHP_SELF']) == "add-banners.php") echo "active" ?>" href="add-banners.php"><span class="sidebar__link-signal"></span><span class="sidebar__link-text">Banner</span></a>
                                    </li>
                                    <li class="sidebar__menu-item"><a class="sidebar__link <?php if (basename($_SERVER['PHP_SELF']) == "orders.php") echo "active" ?>" href="orders.php"><span class="sidebar__link-signal"></span><span class="sidebar__link-text">Đơn hàng</span></a>
                                    </li>


                                    <li class="sidebar__menu-item"><a class="sidebar__link <?php if (basename($_SERVER['PHP_SELF']) == "customers.php") echo "active" ?>" href="customers.php"><span class="sidebar__link-signal"></span><span class="sidebar__link-text">Khách hàng</span></a>
                                    </li>
                                    <li class="sidebar__menu-item"><a class="sidebar__link <?php if (basename($_SERVER['PHP_SELF']) == "book-request.php") echo "active" ?>" href="book-request.php"><span class="sidebar__link-signal"></span><span class="sidebar__link-text">Yêu cầu sách</span></a>
                                    </li>

                                </ul>
                            </div>
                        </li>


                        <li class="sidebar__menu-item"><a class="sidebar__link" href="#" data-toggle="collapse" data-target="#Auth" aria-expanded="false"><span class="sidebar__link-icon">
                                    <svg class="icon-icon-password">
                                        <use xlink:href="#icon-password"></use>
                                    </svg></span><span class="sidebar__link-text">Quản lý tài khoản</span><span class="sidebar__link-arrow">
                                    <svg class="icon-icon-keyboard-down">
                                        <use xlink:href="#icon-keyboard-down"></use>
                                    </svg></span></a>
                            <div class="collapse" id="Auth">
                                <ul class="sidebar__collapse-menu">
                                    <li class="sidebar__menu-item"><a class="sidebar__link <?php if (basename($_SERVER['PHP_SELF']) == "change-pass.php") echo "active" ?>" href="change-pass.php"><span class="sidebar__link-signal"></span><span class="sidebar__link-text">Đổi mật khẩu</span></a>
                                    </li>
                                    <?php if ($_SESSION['level'] == 2) : ?>
                                        <li class="sidebar__menu-item"><a class="sidebar__link <?php if (basename($_SERVER['PHP_SELF']) == "manage-users.php") echo "active" ?>" href="manage-users.php"><span class="sidebar__link-signal"></span><span class="sidebar__link-text">Quản trị viên</span></a>
                                        </li>
                                    <?php endif; ?>
                                    <li class="sidebar__menu-item"><a class="sidebar__link" href="logout.php"><span class="sidebar__link-signal"></span><span class="sidebar__link-text">Đăng xuất</span></a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="sidebar__menu-item"><a class="sidebar__link" href="404.php" aria-expanded="false"><span class="sidebar__link-icon"></span><span class="sidebar__link-text">404</span></a>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
    </aside>

    <body>