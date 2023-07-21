<header>
    <span class="logo">Blog Master</span>
    <?php if(!isset($_COOKIE['log'])):?>
        <div id="show_if_not_auth"></div>
    <?php endif; ?>
    <nav>
        <a href="index.php">Главная</a>
        <a href="contacts.php"id="if_not_auth">Контакты</a>
        <?php if(isset($_COOKIE['log'])): ?>
        <a href="add-article.php">Добавить статью</a>
            <?php if($_COOKIE['log'] == 'admin'): ?>
        <a href="show_users.php" class='btn'>Список пользователей</a>
            <?php endif; ?>
        <a href="login.php" class='btn'>Кабинет пользователя</a>

        <?php else:?>
        <a href="login.php" class='btn'>Войти</a>
        <a href="register.php" class='btn'>Регистрация</a>
        <?php endif; ?>

    </nav>
</header>

<script>
    document.querySelector('#if_not_auth').addEventListener('mouseover',()=>{
        document.querySelector('#show_if_not_auth').innerHTML = "<h3 style='color: #ea5353'>Для отправки корреспонденции нужно зарегистрироваться</h3>";
    });
</script>