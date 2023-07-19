<?php

$login = trim(filter_var($_POST['login'],FILTER_SANITIZE_SPECIAL_CHARS));
$pass = trim(filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS));


# тестирование
// echo $username;
// exit();

/*------------------------------------------------*/ 

$error = '';

 if(strlen($login)<3)
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

$sql = 'SELECT id,password FROM users WHERE `login` = ?';
$query = $pdo->prepare($sql);
$query->execute([$login]);
$user = $query->fetch(PDO::FETCH_OBJ);

if($query->rowCount() == 0)
    echo "Такого пользователя нет";
elseif ($user->password !=$pass ) {
    echo "Пароль неверный";
}
else{
        setcookie('log',$login, time() + 3600*24*30,"/");
        echo "Done";// выводим в консоль и это будет получено в функции success (data) при отработке всего кода

    } 