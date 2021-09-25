<?php 
include '../test1.php';
include 'file_test2.php';

if($_GET["user_id"] && $_GET["news_id"]){
	$reference1 = $database->getReference (request_URL(2));
   $data_user = $reference1->getSnapshot()->getValue();
	$user_id = $_GET["user_id"];
	var_dump($content_user);
}












// echo date("Y-m-d-H-i-s") . "<br>";
// echo date("Y-m-d") . "<br>";
// var_dump(date("Y-m-d"));

// if (unlink("/var/www/ivanuzz.pushkeen.ru/html/pd/2020-12-25-01-40-46.1.jpeg")){
// 
	// unlink("/var/www/ivanuzz.pushkeen.ru/html/pd/2020-12-25-01-40-46.1.jpeg");
	// echo "Успех";
// }
// else{
	// echo "Не успех";
// }
// echo "????";

//это сработало для меня
// unlink("/var/www/ivanuzz.pushkeen.ru/html/pd/2020-12-23-23-19-31.0.jpeg");
//это сработало для меня
 ?>
 <!-- <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 
 <form action="file_test2.php" method="post">
 	<input type="time" name="time">
 	<input type="week" name="week">
 	<input type="month" name="month">
 	<input type="date" name="date">
 	    <div>
    <button type="submit" class="textbutton">Отправить</button>
    <button type="reset" class="textbutton">Очистить</button>
    </div>
 </form>
 </body>
 </html>
 -->