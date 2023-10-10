
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

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
    $mail->setFrom('ngoduykhanh2001@gmail.com', 'Book Store');
    $mail->addReplyTo('ngoduykhanh2001@gmail.com', 'Book Store');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Xác thực tài khoản Book Store';
    $mail->Body    = '<p>Xin chào<b> ' . $name . ',</b></p>';
    $mail->Body .= '<p>Bạn đã đăng ký tài khoản thành công, để xác thực tài khoản, bạn vui lòng nhấp vào đường link dưới đây:</p>';
    $mail->Body .= '<a href="http://localhost:3000/bookstore/core/activation.php?accout=' . $email . '&code=' . $activationCode . '">Click here</a>';
    $mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();
    echo "Mail has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>