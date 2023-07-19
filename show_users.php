<!DOCTYPE html>
<html lang="ru">

<head>

    <?php
    $website_title = 'Список пользователей';
    include 'blocks/head.php';?>
</head>


<body>
    <?php
   include 'blocks/header.php';
   
   ?>
    <main>
        <h1>Список пользователей</h1>
        <div class="container">
            <?php 
        require_once 'lib/mysql.php';

        $sql = 'SELECT id, name, login FROM users';
        $result  = $pdo->query($sql);
        

        while($row = $result->fetch(PDO::FETCH_OBJ)){

            echo <<<_HTML_
            <div class = 'user' id="$row->id">
            <div><b>Имя:  </b> <span>$row->name </span>____<b>Логин: </b> <span>$row->login</span></div>
            <button onclick = 'deleteUser($row->id)' class = 'btn_del' ">Удалить</button>
            </div>
            _HTML_;   
        }
        
        ?>
        </div>

    </main>
    <?php
   include 'blocks/aside.php';
   
   ?>


    <?php
   include 'blocks/footer.php';
   
?>
    <script>
    function deleteUser(id) {

        $.ajax({
            url: 'ajax/deleteUser.php', // куда предаем данные
            type: 'POST', // тип передачи
            cache: false, //  ничего не кэшируетя
            data: {
                'id': id
            }, // данные
            dataType: 'html', // формат, вкотором получаем данные обратно
            success: (data) => { // функция, которая сработает, когда весь код в reg.php будет ыполнен
                if (data == id) {
                    console.log(data);
                    $('#' + data).hide();
                    document.location.reload(true);
                }
            }
        });

    }
    </script>
</body>

</html>