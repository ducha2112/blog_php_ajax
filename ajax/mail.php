<?php

$username = trim(filter_var($_POST['name'],FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL));
$mess = trim(filter_var($_POST['mess'],FILTER_SANITIZE_SPECIAL_CHARS));



$error = '';

if(strlen($username) <2)
    $error = 'Введите имя';
else if(strlen($email)<5)
    $error = 'Введите email';
else if(strlen($mess)<10)
    $error = 'Введите сообщение';

if($error != ''){
    echo $error;
    exit();
}

$to = 'ducha2112@yandex.ru';
//$subject = "?utf-8?B?".base64_decode("Сообщение с сайта Blog Master")."?=";
$subject = "Сообщение с сайта Blog Master";
$mess = "Пользователь: $username <br>$mess";
$message = wordwrap($mess, 70, "\r\n");
$headers = "From: $email\r\nReplay-to: $email\r\nContent-type: text/html; charset=utf-8\r\n";

mail($to,$subject,$mess, $headers);

echo "Done";