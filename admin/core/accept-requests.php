<?php
include('../config/db_connect.php');
if (!isset($_GET['id'])) {
    header('Location: ../404.php');
    exit;
}
$id = $_GET['id'];
$sql = "SELECT * FROM request,customers where request.cus_id = customers.cus_id having re_id = '$id'";
$res = mysqli_query($conn, $sql);
$customer = mysqli_fetch_assoc($res);
if (mysqli_num_rows($res) <= 0) {
    header('Location: ../404.php');
    exit;
}
$name = $customer['cus_name'];
$email = $customer['cus_mail'];
$books = $customer['re_book'];
// Put contacting email here
$php_main_email = "ngoduykhanh2001@gmail.com";

//Fetching Values from URL



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = false;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com;';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'ngoduykhanh2001@gmail.com';
    $mail->Password   = 'cbukfmstfoqnuyan';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;
    $mail->CharSet  = "utf-8";
    $mail->setFrom($php_main_email, 'Duy Khanh');
    $mail->addReplyTo('ngoduykhanh2001@gmail.com', 'Duy Khanh');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = '[H&K-StoreBook] - Phản hồi yêu cầu sách ';
    $php_template = '<div style="padding:50px;line-height:25px;">Xin chào <b>' . $name . '</b>,<br/>'
        . 'Yêu cầu sách của bạn đã được chấp nhận.<br/><br/>'
        . '<strong style="color:#f00a77;">Yêu cầu:</strong>  ' . $books . '.<br/><br/>'
        . 'Cảm ơn bạn đã liên hệ shop, chúc bạn mua sắm vui vẻ tại H&K!<br/><br/>';

    $mail->Body    = "<div style=\"background-color:#f5f5f5; color:#333;\">" . $php_template . "</div>";
    $mail->AltBody = 'Body in plain text for non-HTML mail clients';
    if ($mail->send()) {
        echo '';
        $sql = "DELETE FROM request where re_id = '$id'";
        $res = mysqli_query($conn, $sql);
        header("Location: ../book-request.php");
    } else {
        echo 'Lỗi. Thư chưa gửi được';
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
