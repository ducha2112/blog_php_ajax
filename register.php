<!DOCTYPE html>
<html lang="ru">

<head>

    <?php
    $website_title = 'Регистрация';
    include 'blocks/head.php' ?>
</head>


<body>
    <?php include 'blocks/header.php';?>
    <main>
        <h1>Региcтрация</h1>
        <form>
            <label for="username">Ваше имя</label>
            <input type="text" name="username" id='username'>

            <label for="email">Email</label>
            <input type="email" name="email" id='email'>

            <label for="login">Логин</label>
            <input type="login" name="login" id='login'>

            <label for="password">Пароль</label>
            <input type="password" name="password" id='password'><br>

            <div class="error-mess" id="error-block"></div>


            <button type="button" id="reg_user">Зарегистрироваться</button>
        </form>

    </main>
    <?php include 'blocks/aside.php';?>


    <?php include 'blocks/footer.php';?>
    <script>
    $('#reg_user').click(() => {
        let name = $('#username').val();
        let email = $('#email').val();
        let login = $('#login').val();
        let pass = $('#password').val();

        $.ajax({
            url: 'ajax/reg.php', // куда предаем данные
            type: 'POST', // тип передачи
            cache: false, //  ничего не кэшируетя
            data: {
                'username': name,
                'email': email,
                'login': login,
                'password': pass
            }, // данные
            dataType: 'html', // формат, вкотором получаем данные обратно
            success: (data) => { // функция, которая сработает, когда весь код в reg.php будет ыполнен
                if (data === "Done") {
                    $('#reg_user').text('Все получилось!');
                    $('#error-block').hide();
                    $('#username').val('');
                    $('#email').val('');
                    $('#login').val('');
                    $('#password').val('');
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