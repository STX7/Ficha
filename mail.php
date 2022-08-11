<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
$mail = new PHPMailer();
try
{
    
    $mail-> SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username   = 'sistemadefichas@gmail.com';
    $mail->Password   = 'dedculzohbqxgbni';//senha acesso total a conta google
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    
    $mail->setFrom('sistemadefichas@gmail.com');
    $mail->addAddress('sistemadefichas@gmail.com');
    $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
    $mail->Subject = "Ficha Catalografica";
    $mail->Body    = 'Esta mensagem é um envio automatizado, não responda devolta, segue em anexo a ficha catalográfica.';
    $mail->AltBody = 'Esta mensagem é um envio automatizado, não responda devolta, segue em anexo a ficha catalográfica.';
    // Enviar
    $mail->send();

    if ($mail->send()) {
        echo "enviado com sucesso";
    }else{
        echo "não foi enviado";
    }

    
}
catch (Exception $e)
{
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>