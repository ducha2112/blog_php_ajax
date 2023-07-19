<?php

$user = 'root';
$password = 'root';
$host = 'localhost';
$db = 'web-blog';
$port = 3306;

$dsn = 'mysql:host='.$host.';dbname='.$db.';port='.$port;
$pdo = new PDO($dsn,$user,$password);