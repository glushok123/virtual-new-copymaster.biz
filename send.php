<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function sendmessage($emails)
{
    $mail = new PHPMailer(true); // Passing `true` enables exceptions
    try {

        $mail->setLanguage('ru', 'vendor/phpmailer/phpmailer/language/'); // Перевод на русский язык
        $mail->SMTPDebug = 1; // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->SMTPAuth = true; // Enable SMTP authentication
        //$mail->SMTPSecure = 'ssl';                          // secure transfer enabled REQUIRED for Gmail
        //$mail->Port = 465;                                  // TCP port to connect to
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to
        $mail->Host = 'smtp.yandex.ru'; // Specify main and backup SMTP servers
        $mail->Username = 'glushkovkibervoin@yandex.ru'; // SMTP username
        $mail->Password = 'kkmlxetugpikxklw'; // SMTP password
        //Recipients
        $mail->setFrom('glushkovkibervoin@yandex.ru', 'Andrey');
        $mail->addAddress($emails); // Name is optional
        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'НОВАЯ заявка!';
        $mail->Body = 'НОВАЯ заявка! <br> https://copymaster.biz/dashbord/';
        $mail->AltBody = "НОВАЯ заявка! ";
        $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }

}


?>

