<?php 
include '../test1.php';
$paths = array();
	echo "<pre>";
var_dump($_GET);
	echo "</pre>";

if ($_GET["id_story"]){
	echo "Получен айди истории: " . $_GET["id_story"] . "<Br>";
$reference = $database->getReference (request_URL(4));
$data = $reference->getSnapshot()->getValue();	
$size = array_key_last($data);
$max_id = $data[$size]["id"];
echo $max_id . "<br>";
    for ($i = 0; $i <= $max_id; $i++){ //count($data)
    	// var_dump($data[$i]);
    	// echo $data[$i];
		if(isset($data[$i]) && $data[$i]["id"] == $_GET["id_story"]){
	        echo $data[$i]["id"] . " id истории найден в базе" . "<br>" ;
        $target = $i;
     }
     else{
     	// echo "id" . "$i" . "не найден:(" . "<br>" ;
     }
    }

echo "Файл(-ы) для удаления: " . $data[$target]["path"] . "<br>"  . "<br>";

$paths = explode('","' , $data[$target]["path"]);
	// echo "<pre>";
// var_dump($paths);
	// echo "</pre>";

for ($i=0; $i < count($paths) ; $i++) { 
	$delete_path = $paths[$i];
	// echo   "$ delete_path: " . $delete_path . "<br>" ;
	if (unlink($delete_path)){
	// unlink($delete_path);
	echo "Файл(-ы) удален(-ы)" . "<br>";
	}
	else{
		echo "Что то пошло не птак" . "<br>";
	}
}


$delitelink = request_URL(4)."/".$target;

///////////////////////////////////////////////////////!!!!!!!!ОЧЕНЬ ВАЖНОЕ УСЛОВИЕ!!!!!!!!!//////////
if ($target !== null && $data[$target] !== null){
	/////////////////////////////////////////////////////////!!!!!ОЧЕНЬ ВАЖНОЕ УСЛОВИЕ!!!!!!!!!//////////
        $database->getReference($delitelink)->set(null);
        echo "Удалено из базы" . "<br>";
     }
     else{
     	echo "Нет в базе";
     }
}

 ?>