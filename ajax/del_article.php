<?php
$article_id = $_POST['article_id'];

if(isset($article_id)) {
    require_once '../lib/mysql.php';

    $sql = 'DELETE FROM `articles` WHERE `id` = ?';
    $query=$pdo->prepare($sql);
    $query->execute([$article_id]);

    echo 'Done';
}