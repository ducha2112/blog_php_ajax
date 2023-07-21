<?php

if(!isset($_COOKIE['log'])){
    echo "<h3 style='color: darkred'>Для отправки корреспонденции нужно зарегистрироваться</h3>";
  header('Location: register.php');

  exit();
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>

    <?php
    $website_title = 'Контакты';
    include 'blocks/head.php' ?>
</head>
<?php
 require_once 'lib/mysql.php';
$sql = 'SELECT * FROM `users` WHERE `login` = ?';
$query = $pdo->prepare($sql);
$query->execute([$_COOKIE['log']]);
$user = $query->fetch(PDO::FETCH_OBJ);
?>

<body>
    <?php include 'blocks/header.php';?>
    <main>
        <h1>Обратная связь</h1>
        <form>
            <label for="username">Ваше имя</label>
            <input type="text" name="username" id='username' value="<?=$user->name?>">

            <label for="email">Email</label>
            <input type="email" name="email" id='email'>

            <label for="mess">Сообщение</label>
            <textarea name="mess" id='mess'></textarea>

            <div class="error-mess" id="error-block"></div>

            <button type="button" id="mess_send">Отправить</button>
        </form>

    </main>
    <?php include 'blocks/aside.php';?>


    <?php include 'blocks/footer.php';?>
    <script>
    $('#mess_send').click(() => {
        let name = $('#username').val();
        let email = $('#email').val();
        let mess = $('#mess').val();


        $.ajax({
            url: 'ajax/mail.php', // куда предаем данные
            type: 'POST', // тип передачи
            cache: false, //  ничего не кэшируетя
            data: {
                'name': name,
                'email': email,
                'mess': mess,

            }, // данные
            dataType: 'html', // формат, вкотором получаем данные обратно
            success: (data) => { // функция, которая сработает, когда весь код в reg.php будет ыполнен
                if (data === "Done") {
                    $('#mess_send').text('Все получилось!');
                    $('#error-block').hide();
                    $('#username').val('');
                    $('#email').val('');
                    $('#mess').val('');

                } else {
                    $('#error-block').show();
                    $('#error-block').text(data);

                }
            }
        });
    });
    </script>
</body>

</html>