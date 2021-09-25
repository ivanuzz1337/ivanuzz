<!DOCTYPE html>
<html lang="ru">
<head>
    <title>
        Форма для перебургского дневника
    </title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
</head>
<body>
    <form action="pd_saves.php" method="post" enctype="multipart/form-data">
    <!-- "saves.php" -->
    <div>
        <p>Загрузка фото</p>
        <input type="file" name="photo" id = "photo">

    </div>

    <div>
        <p>Загрузка видео</p>

        <input type="file" name="video" id = "video">
    </div>
    <br>
    <div>
    	<p>Загрузка объедка для величесвенного IOs</p>
        <input type="file" name="obj_ios" id = "obj_ios">
    </div>
    <br>
    <div>
    	<p>Загрузка объедка для Android</p>
        <input type="file" name="obj_andr" id = "obj_andr">
    </div>
    <div>
        <p>Выбор недели</p>
        <input type="week" name="week" required>
    </div>

    <br>
    <div>
    <button type="submit">Отправить</button>
    <button type="reset">Очистить</button>

    </div>
    </form>

    <?php

        // var_dump($_POST);
        // var_dump($_FILES);
        // echo $_POST["photo"];
?>

</body>
</html>