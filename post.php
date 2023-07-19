<!DOCTYPE html>
<html lang="ru">

<head>

    <?php
     require_once 'lib/mysql.php';
     $sql =  'SELECT * FROM articles WHERE `id`=?';
     $query = $pdo->prepare($sql);
     $query->execute([$_GET['id']]);

     $article = $query->fetch(PDO::FETCH_OBJ);

    $website_title = $article->title;
    $date  = date("Y-m-d ", $article->date).'в '.date("H:i:s", $article->date);
    include 'blocks/head.php';?>
</head>


<body>
    <?php
   include 'blocks/header.php';
   
   ?>
    <main>
        <?php
        if (!isset($_COOKIE['log'])) $_COOKIE['log']='';
            echo <<< _HTML_
            <div class = 'post'>
                <img src="/uploads/$article->name_image" alt="$article->name_image">
                <h1>$article->title</h1>
                <p>$article->full_text</p>
                <p class = 'author'>Автор: <span>$article->author</span></p><br>
                <p><b>Дата публикации: </b> $date</p>
            </div>
            _HTML_;
        if($_COOKIE['log'] == $article->author) {
            echo '<button id="article_del" type="button">Удалить статью</button>';
        }
        ?>

        <h3>Комментарии</h3>

        <form>
            <label for="username">Ваше имя</label>
            <?php if(isset($_COOKIE['log'])): ?>
            <input type="text" name="username" id='username' value="<?=$_COOKIE['log']?>">
            <?php else: ?>
            <input type="text" name="username" id='username'>
            <?php endif; ?>

            <label for="mess">Сообщение</label>
            <textarea name="mess" id='mess'></textarea>


            <div class="error-mess" id="error-block"></div>

            <button type="button" id="mess_send">Добавить комментарий</button>
        </form>

        <div class="comments">
            <?php
            $sql =  'SELECT * FROM comments WHERE `article_id`=? ORDER BY `id` DESC';
            $query = $pdo->prepare($sql);
            $query->execute([$_GET['id']]);

            $comments = $query->fetchAll(PDO::FETCH_OBJ);

            foreach($comments as $el){
                echo <<<_HTML_
                <div class="comment">
                <h3>$el->name</h3>
                <p>$el->mess</p>
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
    $('#mess_send').click(() => {
        let name = $('#username').val();
        let mess = $('#mess').val();


        $.ajax({
            url: 'ajax/comment_add.php', // куда предаем данные
            type: 'POST', // тип передачи
            cache: false, //  ничего не кэшируетя
            data: {
                'username': name,
                'mess': mess,
                'id': '<?=$_GET['id']?>'

            }, // данные
            dataType: 'html', // формат, вкотором получаем данные обратно
            success: (data) => { // функция, которая сработает, когда весь код в reg.php будет ыполнен
                if (data === "Done") {
                    $(".comments").prepend(
                        `<div class='comment'>
                        <h2>${name}</h2>
                        <p>${mess}</p>
                        </div>`);
                    $('#mess_send').text('Все получилось!');
                    $('#error-block').hide();
                    $(
                        '#mess').val('');

                } else {
                    $('#error-block').show();
                    $('#error-block').text(data);

                }
            }
        });
    });
    $('#article_del').click(() => {

        $.ajax({
            url: 'ajax/del_article.php', // куда предаем данные
            type: 'POST', // тип передачи
            cache: false, //  ничего не кэшируетя
            data: {
                'article_id': '<?=$article->id?>',

            }, // данные
            dataType: 'html', // формат, вкотором получаем данные обратно
            success: (data) => { // функция, которая сработает, когда весь код в reg.php будет ыполнен
                if (data === "Done") {
                    $('#article_del').text('Статья удалена!')

                }
            }
        });
    });
    </script>
</body>

</html>