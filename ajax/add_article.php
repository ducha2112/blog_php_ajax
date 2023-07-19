<?php

$title = trim(filter_var($_POST['title'],FILTER_SANITIZE_SPECIAL_CHARS));
$anons = trim(filter_var($_POST['anons'],FILTER_SANITIZE_SPECIAL_CHARS));
$full_text = trim(filter_var($_POST['full_text'],FILTER_SANITIZE_SPECIAL_CHARS));

if(!isset($_FILES['uploaded_file'])) $_FILES['uploaded_file'] = '';
$file = $_FILES['uploaded_file'];

$error ='';
if(strlen($title) <5)
    $error = 'Введите название статьи';
else if(strlen($anons)<10)
    $error = 'Введите анонс статьи';
else if(strlen($full_text)<10)
    $error = 'Введите основной текст статьи';
if($error != ''){
    echo $error; // выводим в консоль и это будет получено в функции success (data)
    exit();
}

// Разрешенные расширения файлов.
$allow = array('jpg', 'jpeg', 'png', 'gif','webp');

// Директория, куда будут загружаться файлы.
$path = $_SERVER["DOCUMENT_ROOT"] . '/uploads/';

if (!empty($file)) {
    // Проверим на ошибки загрузки.
    if (!empty($file['error']) || empty($file['tmp_name'])) {
        switch ($file['error']) {
            case 1:
            case 2: $error = 'Превышен размер загружаемого файла.'; break;
            case 3: $error = 'Файл был получен только частично.'; break;
            case 4: $error = 'Файл не был загружен.'; break;
            case 6: $error = 'Файл не загружен - отсутствует временная директория.'; break;
            case 7: $error = 'Не удалось записать файл на диск.'; break;
            case 8: $error = 'PHP-расширение остановило загрузку файла.'; break;
            case 9: $error = 'Файл не был загружен - директория не существует.'; break;
            case 10: $error = 'Превышен максимально допустимый размер файла.'; break;
            case 11: $error = 'Данный тип файла запрещен.'; break;
            case 12: $error = 'Ошибка при копировании файла.'; break;
            default: $error = 'Файл не был загружен - неизвестная ошибка.'; break;
        }
    } elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
        $error = 'Не удалось загрузить файл.';
    } else {
        // Оставляем в имени файла только буквы, цифры и некоторые символы.
        $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
        $name = mb_eregi_replace($pattern, '-', $file['name']);
        $name_image = mb_ereg_replace('[-]+', '-', $name);

        $parts = pathinfo($name);
        if (empty($name) || empty($parts['extension'])) {
            $error = 'Не удалось загрузить файл.';
        } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
            $error = 'Недопустимый тип файла';
        } else {
            // Перемещаем файл в директорию.
            if (move_uploaded_file($file['tmp_name'], $path . $name_image)) {
                // Далее можно сохранить название файла в БД и т.п.
                require_once '../lib/mysql.php';


                $sql = 'INSERT INTO articles(title,anons,full_text, date,author,name_image) VALUES(?,?,?,?,?,?)';
                $query = $pdo->prepare($sql);
                $query->execute([$title,$anons,$full_text,time(), $_COOKIE['log'],$name_image]);

                echo "Done"; // выводим в консоль и это будет получено в функции success (data) при отработке всего кода
            } else {
                echo  $error ;
                exit();
            }
        }
    }

}












