<?php

$username = trim(filter_var($_POST['username'],FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL));
$login = trim(filter_var($_POST['login'],FILTER_SANITIZE_SPECIAL_CHARS));
$pass = trim(filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS));


# тестирование
// echo $username;
// exit();

/*------------------------------------------------*/ 

$error = '';

if(strlen($username) <2)
    $error = 'Введите имя';
else if(strlen($email)<5)
    $error = 'Введите email';
else if(strlen($login)<3)
    $error = 'Введите логин';
else if(strlen($pass)<5)
    $error = 'Введите пароль';

if($error != ''){
    echo $error; // выводим в консоль и это будет получено в функции success (data)
    exit();
}


require_once '../lib/mysql.php';

$salt='hbfdskfjdbf;%$51654l';
$pass = md5($salt.$pass);

$sql = 'INSERT INTO users(name,email,login,password) VALUES(?,?,?,?)';
$query = $pdo->prepare($sql);
$query->execute([$username,$email,$login,$pass]);

echo "Done"; // выводим в консоль и это будет получено в функции success (data) при отработке всего кода