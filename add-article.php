<!DOCTYPE html>
<html lang="ru">

<head>

    <?php
    $website_title = 'Добавить статью';
    include 'blocks/head.php' ?>
</head>


<body>
    <?php include 'blocks/header.php';?>
    <main>
        <h1>Добавить статью</h1>
        <form id="myForm" method="post" action="ajax/add_article.php" enctype="multipart/form-data">
            <label for="title">Название статьи</label>
            <input type="text" name="title" id='title' required>

            <label for="anons">Анонс статьи</label>
            <textarea name="anons" id='anons' required></textarea>

            <label for="full_text">Основной текст</label>
            <textarea name="full_text" id='full_text' required></textarea>

            <label for="file">Загрузка картинки</label>
            <input type="file" name="uploaded_file" id='uploaded_file'>

            <div class="error-mess" id="error-block"></div>

            <button type="button" id="add_article">Добавить</button>
        </form>

    </main>
    <?php include 'blocks/aside.php';?>


    <?php include 'blocks/footer.php';?>
    <script>
    $('#add_article').click((event) => {
        event.preventDefault();
        // let form = document.getElementById('myForm');
        let formData = new FormData();
        let title = $('#title').val();
        let anons = $('#anons').val();
        let full_text = $('#full_text').val();
        let uploaded_file = $('#uploaded_file')[0].files[0]

//
        formData.append('uploaded_file', uploaded_file);
        formData.append('title', title);
        formData.append('anons', anons);
        formData.append('full_text', full_text);


        $.ajax({

            url: 'ajax/add_article.php', // куда предаем             и
            // данные
            type: 'POST', // тип передачи
            cache: false, //  ничего не кэшируетя
            processData: false,
            data: formData,
            contentType: false,
            dataType: 'html', // формат, вкотором получаем данные обратно
            success: (data) => { // функция, которая сработает, когда весь код в reg.php будет ыполнен
                if (data === "Done") {
                    $('#add_article').text('Все получилось!');
                    $('#error-block').hide();
                    $('#title').val('');
                    $('#anons').val('');
                    $('#full_text').val('');
                    $('#uploaded_file')[0].reset();

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