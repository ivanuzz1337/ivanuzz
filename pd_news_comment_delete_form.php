<?php 
include '../test1.php';
 ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<title>Удаление комментария</title>
	<link rel="stylesheet" type="text/css" href="css/formstyle.css">
	<meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
</head>
<body>
<P class="textinfo">Удаление комментария. Выбрать новость по заголовку</P>
    <form action="pd_news_comment_select_delete.php">
    
    <div class="textinfo"><label class="col-sm-2 col-form-label">Заголовок новости</label>
        <div class="col-sm-10">
            <select  class="select_block" name="title" id="title" required="">
                <?php
$reference = $database->getReference (request_URL(3));
$data = $reference->getSnapshot()->getValue();
$size = array_key_last($data);
$max_id = $data[$size]["id"];
    for ($i = 1; $i <= $max_id; $i++){ //count($data)
        if($data[$i]["title"] !== null){ 
        echo $data[$i]["title"] . "  - заголовок новости" . "<br>" ;
        echo '<option value="' .$data[$i]["title"]. '">' .$data[$i]["title"]. "</option>";
        }
    }
?>
    </select>
</div>
</div>

    <br>
<div>
    <button type="submit" class="textbutton">Отправить</button>
    <button type="reset" class="textbutton">Очистить</button>
</div>
    </form>

</body>
</html>