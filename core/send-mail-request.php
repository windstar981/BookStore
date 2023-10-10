<?php

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
    $mail->Subject = '[H&K-StoreBook] - Xác nhận yêu cầu sách ';
    $php_template = '<div style="padding:50px;line-height:25px;">Xin chào <b>' . $name . '</b>,<br/>'
        . 'Cảm ơn bạn đã gửi yêu cầu cho H&K, H&K sẽ xem xét yêu cầu của bạn và phản hồi lại bạn khi yêu cầu được chấp nhận.<br/><br/>'
        . '<strong style="color:#f00a77;">Họ tên:</strong>  ' . $name . '<br/>'
        . '<strong style="color:#f00a77;">Email:</strong>  ' . $email . '<br/>'
        . '<strong style="color:#f00a77;">Yêu cầu:</strong>  ' . $books . '<br/><br/>'
        . 'Chúc bạn ngày mới tốt lành!!';

    $mail->Body    = "<div style=\"background-color:#f5f5f5; color:#333;\">" . $php_template . "</div>";
    $mail->AltBody = 'Body in plain text for non-HTML mail clients';
    if ($mail->send()) {
        echo '';
    } else {
        echo 'Lỗi. Thư chưa gửi được';
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
