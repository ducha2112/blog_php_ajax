<?php 

if($_POST['mess']){
            require_once '../lib/mysql.php';

            $sql =  'SELECT `message` FROM `chat` ORDER BY `id` ASC';
            $query = $pdo->query($sql);
         
            $messages = [];
            while($row = $query->fetch(PDO::FETCH_OBJ)){
                echo ','.$row->message;
                
            }
           
}
        