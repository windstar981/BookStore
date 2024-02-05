<?php
date_default_timezone_set('Asia/Ho_Chi_Minh'); // Đặt múi giờ cho máy chủ PHP là múi giờ của Việt Nam
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('config/db_connect.php');
ob_start();
if (isset($_GET['lang'])) {
    $selected_lang = $_GET['lang'];

    // Lưu ngôn ngữ đã chọn vào session
    $_SESSION['lang'] = $selected_lang;
} else {
    // Nếu chưa chọn, kiểm tra xem đã lưu trong session chưa
    $selected_lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'vi';
}
require_once "./lang/$selected_lang.php";
require_once "./lang/get_lang.php";

$message = getLang('welcome');

if(!empty($_SESSION['id']))
{
    $user_id = $_SESSION['id'];
    $sql = "select * from logs_login where user_id = $user_id";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
        $last_login = mysqli_fetch_assoc($res)['last_login'];
        $last_login  = date('Y-m-d H:i:s', $last_login );
        $content_last_login = getLang('last_login');
        $content_question_job = " ".getLang('question_job');
        $message = "$message ".$_SESSION['name']." ".$content_last_login." ".$last_login.". ".$content_question_job;
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $selected_lang; ?>">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cover letter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Use Minified Plugins Version For Fast Page Load -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/plugins.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/app.css" />

    <link rel="shortcut icon" type="image/x-icon" href="image/title2.png" alt="">
</head>

<body style="background-color: pink;">
    <div class="site-header header-3  d-none d-lg-block mt-3">
        <div class="container">
            <div class="row">
            <div class="col-lg-7" style="overflow: hidden; white-space: nowrap;">
            </div>
                <div class="col-lg-7" style="overflow: hidden;">
                    <div id="scrollingContainer" style="white-space: nowrap; overflow: hidden;">
                        <p id="scrollingText"><?php echo $message; ?></p>
                    </div>
                </div>
                <div class="col-lg-4 flex-lg-right">
                    <ul class="header-top-list">
                        <li class="dropdown-trigger language-dropdown">
                            <?php if (isset($_SESSION['name'])) : ?>
                                <a href=""><i class="icons-left fas fa-user"></i>
                                    <?php echo $_SESSION['name'] ?>
                                </a>
                                <i class="fas fa-chevron-down dropdown-arrow"></i>
                                <ul class="dropdown-box">
                                    <li> <a href="profile.php"><?= getLang('account') ?></a></li>
                                    <li> <a href="change-password.php"><?= getLang('change_pass') ?></a></li>
                                    <li> <a href="logout.php"><?= getLang('logout') ?></a></li>
                                </ul>
                            <?php else : ?>
                                <a href="login.php"><i class="icons-left fas fa-user"></i>
                                <?= getLang('my_account') ?>
                                </a>
                            <?php endif; ?>
                        </li>
                        <li>
                            <li class="dropdown-trigger language-dropdown"><a href=""><span class="flag-img"><img style="height: 20px;" src="image/icon/<?php echo $selected_lang == "japan" ?  "japan-flag.png" :  "vn-flag.png";  ?>" alt="">   <?= $selected_lang ?></span></a><i class="fas fa-chevron-down dropdown-arrow"></i>
                                <ul class="dropdown-box">
                                    <li> <a href="index.php?lang=vi"> <span class="flag-img"><img style="height: 20px;"  src="image/icon/vn-flag.png" alt=""></span>Viet Nam</a></li>
                                    <li> <a href="index.php?lang=japan"> <span class="flag-img"><img style="height: 20px;"  src="image/icon/japan-flag.png" alt=""></span>Japan</a></li>
                                </ul>
                            </li>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var originalText = "<?php echo $message; ?>";
        var scrollingTextElement = document.getElementById("scrollingText");
        scrollingTextElement.innerText = originalText;

        var elementWidth = scrollingTextElement.offsetWidth;

        var containerWidth = scrollingTextElement.parentElement.offsetWidth;

        var animationDuration = (elementWidth + containerWidth) / 100; // Điều chỉnh tốc độ ở đây

        scrollingTextElement.style.animation = "scrolling " + animationDuration + "s linear infinite";

        var styleSheet = document.styleSheets[0];
        styleSheet.insertRule("@keyframes scrolling { from { transform: translateX(" + containerWidth + "px); } to { transform: translateX(-" + elementWidth + "px); } }", styleSheet.cssRules.length);
    });
</script>