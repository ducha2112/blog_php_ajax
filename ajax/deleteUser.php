<?php
$id = $_POST['id'];

require_once '../lib/mysql.php';

 $sql = 'DELETE FROM `users` WHERE `id` = ?';
 $query=$pdo->prepare($sql);
 $query->execute([$id]);

 echo $id;