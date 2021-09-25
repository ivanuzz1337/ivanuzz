<?php 
// include '../test1.php';
// include 'file_test.php';
if($_GET["id"] && $_GET["path"]){
$path = $_GET["path"];
echo $path . "<br>";
$content = explode(",", $path);//события разбитые строки посредством запятой

for ($i=0; $i < count($content) ; $i++) { 
if ($content[$i] == $_GET["id"]) {
unset($content[$i]); //удалить элемент
}
}
echo "<pre>";
var_dump($content);
echo "</pre>";

$content_dislikes1 = implode(",", $content);
$content_dislikes1 = ltrim($content_dislikes1, ",");

echo "content_dislikes1:" . "<br>";
echo "<pre>";
var_dump($content_dislikes1);
echo "</pre>";

$content_dislikes2 = implode(",", $content);
echo "content_dislikes2:" . "<br>";
echo "<pre>";
var_dump($content_dislikes2);
echo "</pre>";

}



	// echo "<pre>";
// var_dump($_POST);
	// echo "</pre>";
	// $test = strtotime($_POST["date"]); // тут может преобразование отличаться
// echo "week: ".date("Y-W", $test);
  ?>