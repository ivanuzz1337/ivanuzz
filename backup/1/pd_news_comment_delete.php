<?php 
include '../test1.php';
// require 'pd_news_comment_select_delete.php';
	echo "<pre>";
var_dump($_GET);
	echo "</pre>";

	if ($_GET["id"]){
		$delitelink = $_GET["id"];
$link = request_URL(0)."/".$delitelink;
echo $link . "<br>" ;
$link = substr($link, 1); //удалил /
echo $link;



$link_arr = explode("/", $link);
echo "<pre>";
var_dump($link_arr);
	echo "</pre>";
$link = rtrim($link, $link_arr[4]);
echo $link . "<br>";

$reference = $database->getReference ($link);
$data = $reference->getSnapshot()->getValue();
	echo "<pre>";
var_dump($data[$link_arr[4]]);
	echo "</pre>";
if ($link !== null && $data[$link_arr[4]] !== null){
	echo "Это будет удалено:" . $link . "<br>";
	// echo $data[$delitelink];
	/////////////////////////////////////////////////////////!!!!!ОЧЕНЬ ВАЖНОЕ УСЛОВИЕ!!!!!!!!!//////////
        $database->getReference($delitelink)->set(null);
        echo "Удалено из базы" . "<br>";
      }
     else{
     	echo "Нет в базе";
     }
}

 ?>
