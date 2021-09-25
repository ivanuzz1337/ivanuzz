<?php 
include '../test1.php';
// $paths = array();
	echo "<pre>";
var_dump($_GET);
	echo "</pre>";
	if ($_GET["id"]){
	// echo "Получен заголовок новости: " . $_GET["title"] . "<Br>";
$reference = $database->getReference (request_URL(1));
$data = $reference->getSnapshot()->getValue();	
$size = array_key_last($data);
$max_id = $data[$size]["id"];
// echo $max_id . "<br>";
    for ($i = 0; $i <= $max_id; $i++){ //count($data)
    	// var_dump($data[$i]);
    	// echo $data[$i];
		if(isset($data[$i]) && $data[$i]["id"] == $_GET["id"]){
	        // echo $data[$i]["id"] . " Загловок найден в базе найден в базе" . "<br>" ;
        $target = $i;
        break;
     }
     else{
     	// echo "id" . "$i" . "не найден:(" . "<br>" ;
     }
    }

echo "Файл(-ы) для удаления: " . $data[$target]["path"] . "<br>"  . "<br>";

$paths = explode('","' , $data[$target]["path"]);
	echo "<pre>";
var_dump($paths);
	echo "</pre>";

for ($i=0; $i < count($paths) ; $i++) 
{ 
	$delete_path = $paths[$i];
	// print($delete_path);
	// echo   " $ delete_path: " . "<br>" ;
	// echo "<br>" ;
	if (unlink($delete_path)){
	unlink($delete_path);
	echo "Файл(-ы) удален(-ы)" . "<br>";
	}
	else{
		echo "Что то пошло не птак" . "<br>";
	}
}
var_dump($delete_path);

$delitelink = request_URL(1)."/".$target;

///////////////////////////////////////////////////////!!!!!!!!ОЧЕНЬ ВАЖНОЕ УСЛОВИЕ!!!!!!!!!//////////
if ($target !== null && $data[$target] !== null){
	/////////////////////////////////////////////////////////!!!!!ОЧЕНЬ ВАЖНОЕ УСЛОВИЕ!!!!!!!!!//////////
		// echo $data[$target];
	var_dump($data[$target]);
        $database->getReference($delitelink)->set(null);
        echo "Удалено из базы" . "<br>";
     }
     else{
     	echo "Нет в базе";
     }
}

 ?>