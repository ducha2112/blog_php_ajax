<?php

$mess = trim(filter_var($_POST['mess'],FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';

if(strlen($mess) <2)
    $error = 'Введите сообщение';



if($error != ''){
    echo $error; // выводим в консоль и это будет получено в функции success (data)
    exit();
}


require_once '../lib/mysql.php';


$sql = 'INSERT INTO chat(message) VALUES(?)';
$query = $pdo->prepare($sql);
$query->execute([$mess]);

echo "Done"; // выводим в консоль и это будет получено в функции success (data) при отработке всего кода