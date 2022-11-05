<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function sendEmailConfirmation(array $user)
{
    $token = sslCrypt($user['email']);

    $subject = 'Confirmação de cadastro ScubaPHP';

    $body = '<h1>Confirme seu cadastro!</h1>';
    $body .= '<div>Para confirmar seu cadastro ScubaPHP <a href="http://scubaphp.com/?page=mail-validation&token='.$token.'">clique aqui</a>.</div>';

    sendEmail($subject, $body, array($user), true);
}

function sendEmailPasswordRedefinition(array $user)
{
    $str   = $user['email'].'|'.date('Y-m-d');
    $token = sslCrypt($str);

    $subject = 'Redefinição de senha';

    $body = '<h1>Redefinir senha!</h1>';
    $body .= '<div>Para redefinir sua senha <a href="http://scubaphp.com/?page=change-password&token='.$token.'">clique aqui</a>.</div>';

    sendEmail($subject, $body, array($user), true);
}

function sendEmail(string $subject, string $body, array $recipients, bool $isHtml)
{
    $mail = new PHPMailer(true);

    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = HOST_EMAIL;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = USER_EMAIL;                     //SMTP username
    $mail->Password   = PASSWORD_EMAIL;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = PORT_EMAIL;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom(USER_EMAIL, utf8_decode(NAME_EMAIL));

    foreach ($recipients as $recipient) {
        $mail->addAddress($recipient['email'], $recipient['name']);     //Add a recipient
    }

    //Content
    $mail->Subject = utf8_decode($subject);

    if ($isHtml === true) {
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Body    = $body;
    } else {
        $mail->AltBody = $body;
    }

    $mail->send();
}