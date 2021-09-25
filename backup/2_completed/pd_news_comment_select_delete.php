<?php 
include '../test1.php';
$paths = array();
// global $link;
	echo "<pre>";
var_dump($_GET);
	echo "</pre>";

if ($_GET["title"]){
echo "Получен заголовок новости: " . $_GET["title"] . "<Br>";
$reference = $database->getReference (request_URL(3));
$data = $reference->getSnapshot()->getValue();	
$size = array_key_last($data);
$max_id = $data[$size]["id"];
// echo $max_id . "<br>";
    for ($i = 0; $i <= $max_id; $i++){ //count($data)
    	// var_dump($data[$i]);
    	// echo $data[$i];
		if(isset($data[$i]) && $data[$i]["title"] == $_GET["title"]){
	        // echo $data[$i]["id"] . " Загловок найден в базе найден в базе" . "<br>" ;
        $target = $i;
        echo $target;
        break;
     }
     else{
     	// echo "id" . "$i" . "не найден:(" . "<br>" ;
     }
    }
$link = request_URL(3)."/".$target."/comment";
}
 ?>
 <!DOCTYPE html>
<html lang="ru">
<head>
	<title>Удаление комментария</title>
	<link rel="stylesheet" type="text/css" href="css/formstyle.css">
	<meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
</head>
<body>
<P class="textinfo">Удаление комментария</P>
    <form action="pd_news_comment_delete.php">
    
    <div class="textinfo"><label class="col-sm-2 col-form-label">Комментарий</label>
        <div class="col-sm-10">
            <select  class="select_block" name="id" id="id" required="">
                <?php
array_push($_GET["link"], $link);

$reference = $database->getReference ($link);
$data = $reference->getSnapshot()->getValue();
$size = array_key_last($data);
$max_id = $data[$size]["id"];
	echo "<pre>";
var_dump($data);
	echo "</pre>";

    for ($i = 1; $i <= $max_id; $i++){ //count($data)
        if($data[$i]["content"] !== null){ 
        // echo $data[$i]["content"] . "  - заголовок новости" . "<br>" ;
            $result_link = $link . "/" . $data[$i]["id"];
            // ' .$link '"/"' $data[$i]["id"] '
        echo '<option value="'.$result_link. '">' .$data[$i]["content"]. "</option>";
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

