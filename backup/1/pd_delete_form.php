<?php 
include '../test1.php';
 ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<title>Удалить AR объект или связку</title>
	<link rel="stylesheet" type="text/css" href="css/formstyle.css">
	<meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
</head>
<body>
<P class="textinfo">Удаление</P>
    <form action="pd_delete.php">
    
    <div class="textinfo"><label class="col-sm-2 col-form-label">Выбрать id</label>
        <div class="col-sm-10">
            <select  class="select_block" name="id" id="id" required="">
                <?php
$reference = $database->getReference (request_URL(1));
$data = $reference->getSnapshot()->getValue();
$size = array_key_last($data);
$max_id = $data[$size]["id"];
    for ($i = 0; $i <= $max_id; $i++){ //count($data)
        if($data[$i]["id"] !== null){ 
        // echo $data[$i]["title"] . "  - заголовок новости" . "<br>" ;
        echo '<option value="' .$data[$i]["id"]. '">' .$data[$i]["id"]. "</option>";
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