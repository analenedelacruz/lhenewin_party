<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["submit"]))
{
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'aniamaesantos0@gmail.com';
    $mail->Password = 'eskmnqzpoblrpruw';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('aniamaesantos0@gmail.com');

    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);

    $mail->Subject = 'Reset Password';
    $mail->Body = '<div>
    <p><b>Hello!</b></p>
    <p>You are recieving this email because we recieved a password reset request for your account.</p>
    <br>
    <p><button class="btn btn-primary"><a href="http://localhost/WEBSITE/reset.php">Reset Password</a></button></p>
    <br>
    <p>If you did not request a password reset, no further action is required.</p>
    </div>';

    $mail->send();

    echo
    "
    <script>
    alert('Sent Successfully');
    document.location.href = 'forgot.php';
    </script>
    ";
}
?>