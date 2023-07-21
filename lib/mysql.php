<?php

$user = 'root';
$password = 'root';
$host = 'localhost';
$db = 'web-blog';
$port = 3306;

$dsn = 'mysql:host='.$host.';dbname='.$db.';port='.$port;
$pdo = new PDO($dsn,$user,$password);

//return $pdo =new PDO('sqlite:web-blog.db','','admin', [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
//                  PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ]);