<?php

function SendCheckEmail($Value, $Email) {

    require_once("phpmailer/PHPMailerAutoload.php");
    $mail = new PHPMailer;
    $mail->CharSet = 'utf-8';


//$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = "smtp.gmail.com";  																							// Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = "UANashaPoshtaUA@gmail.com"; // Ваш логин от почты с которой будут отправляться письма
    $mail->Password = "1P2O3shT2Cpi"; // Ваш пароль от почты с которой будут отправляться письма
    $mail->SMTPSecure = "ssl";                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

    $mail->setFrom("UANashaPoshtaUA@gmail.com"); // от кого будет уходить письмо?
    $mail->addAddress($Email);     // Кому будет уходить письмо
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('Images/0.png', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = "Поштова установа - НАША ПОШТА";
    $mail->Body    = $Value;
    $mail->AltBody = "НАША ПОШТА";

    if(!$mail->send()) {

        return false;

    } else {

        return true;
        //header('location: thank-you.html');
    }

}

?>