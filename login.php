<!DOCTYPE html>
<html lang="ru">

<head>

    <?php
    $website_title = 'Авторизация';
    include 'blocks/head.php' ?>
</head>


<body>
    <?php include 'blocks/header.php';?>
    <main>
        <?php if(!isset($_COOKIE['log'])): ?>
        <h1>Авторизация</h1>
        <form>
            <label for="login">Логин</label>
            <input type="login" name="login" id='login'>

            <label for="password">Пароль</label>
            <input type="password" name="password" id='password'>

            <div class="error-mess" id="error-block"></div>

            <button type="button" id="login_user">Войти</button>
        </form>
        <?php else: ?>
        <?php
        require_once 'lib/mysql.php';
        $sql = 'SELECT * FROM `users` WHERE `login` = ?';
        $query = $pdo->prepare($sql);
         $query->execute([$_COOKIE['log']]);
        $user = $query->fetch(PDO::FETCH_OBJ)
            ?>
        <h2>Здравствуйте, <?=$user->name?></h2>
            <p>Ваш логин: <?=$user->login?></p>
            <p>Ваша почта: <?=$user->email?></p>
        <form>
            <button type="button" id="exit_user">Выйти</button>
        </form>
        <?php endif; ?>

    </main>
    <?php include 'blocks/aside.php';?>


    <?php include 'blocks/footer.php';?>
    <script>
    $('#login_user').click(() => {
        let login = $('#login').val();
        let pass = $('#password').val();

        $.ajax({
            url: 'ajax/login.php', // куда предаем данные
            type: 'POST', // тип передачи
            cache: false, //  ничего не кэшируетя
            data: {
                'login': login,
                'password': pass
            }, // данные
            dataType: 'html', // формат, вкотором получаем данные обратно
            success: (data) => { // функция, которая сработает, когда весь код в reg.php будет ыполнен
                if (data === "Done") {
                    $('#login_user').text('Все получилось!');
                    $('#error-block').hide();
                    document.location.reload(true);
                } else {
                    $('#error-block').show();
                    $('#error-block').text(data);

                }
            }
        });
    });

    $('#exit_user').click(() => {

        $.ajax({
            url: 'ajax/exit.php', // куда предаем данные
            type: 'POST', // тип передачи
            cache: false, //  ничего не кэшируетя
            data: {}, // данные
            dataType: 'html', // формат, вкотором получаем данные обратно
            success: (data) => { // функция, которая сработает, когда весь код в reg.php будет ыполнен
                document.location.reload(true);
            }
        });
    });
    </script>
</body>

</html>