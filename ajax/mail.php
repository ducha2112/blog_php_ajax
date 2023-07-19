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
    echo $error; // выводим в консоль и это будет получено в функции success (data)
    exit();
}

$to = 'ducha2112@gmail.com';
$subject = "?utf-8?B?".base64_decode("Новое сообщение")."?=";

$mess = "Пользователь: $username <br>$mess";
$headers = "From: $email\r\nReplay-to: $email\r\nContent-type: text/html; charset=utf-8\r\n";

mail($to,$subject,$mess, $headers);

echo "Done"; // выводим в консоль и это будет получено в функции success (data) при отработке всего кода