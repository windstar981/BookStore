
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
    $mail->Username   = 'mailcanhbao981@gmail.com';
    $mail->Password   = 'arfqorjbghnvxsuk';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;
    $mail->CharSet  = "utf-8";
    $mail->setFrom('mailcanhbao981@gmail.com', 'Cover letter');
    $mail->addReplyTo('mailcanhbao981@gmail.com', 'Cover letter');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Account Verification - Cover letter';
    $mail->Body    = '<p>Hello <b>' . $name . ',</b></p>';
    $mail->Body .= '<p>You have successfully registered an account. To verify your account, please click on the link below:</p>';
    $mail->Body .= '<a href="http://localhost/bookstore/core/activation.php?account=' . $email . '&code=' . $activationCode . '">Click here</a>';
    $mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();
    echo "Mail has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>