<header>
    <span class="logo">Blog Master</span>

    <nav>
        <a href="index.php">Главная</a>
        <a href="contacts.php">Контакты</a>
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