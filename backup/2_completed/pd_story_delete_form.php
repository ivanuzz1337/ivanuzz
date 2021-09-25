<?php
include '../test1.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<title>
		Удаление истории
	</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
</head>
<body>
	<P class="textinfo">Удаление истории</P>
<form action="pd_story_delete.php" >

	<div class="textinfo"><label class="col-sm-2 col-form-label">История</label>
        <div class="col-sm-10">
            <select class="select_block" name="id_story" id="id_story" required="">
                <?php
$reference = $database->getReference (request_URL(4));
$data = $reference->getSnapshot()->getValue();
$size = array_key_last($data);
$max_id = $data[$size]["id"];
    for ($i = 0; $i <= $max_id; $i++){ //count($data)
        if($data[$i] !== null){ 
        echo $data[$i]["id"] . " id истории" . "<br>" ;
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