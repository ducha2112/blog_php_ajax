<!DOCTYPE html>
<html lang="ru">

<head>

    <?php
    $website_title = 'Blog Master';
    include 'blocks/head.php';?>
</head>


<body>
    <?php
   include 'blocks/header.php';
   
   ?>
    <main>
        <?php
         require_once 'lib/mysql.php';
         
         $sql =  'SELECT * FROM articles ORDER BY `date` DESC';
         $query = $GLOBALS['pdo']->query($sql);
         while($row = $query->fetch(PDO::FETCH_OBJ)){
            echo <<< _HTML_
            <div class = 'post'>
                <img src="/uploads/$row->name_image" alt="$row->name_image">
                <h3>$row->title</h3>
                <p>$row->anons</p>
                <p class = 'author'>Автор: <span>$row->author</span></p>
                <a href ="post.php?id=$row->id" title="$row->id$row->title">Прочитать</a>
            </div>
            _HTML_;
         }
        ?>

    </main>
    <?php
   include 'blocks/aside.php';
   
   ?>



    <?php
   include 'blocks/footer.php';

?>

</body>

</html>