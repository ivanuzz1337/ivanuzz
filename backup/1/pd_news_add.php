<!DOCTYPE html>
<html>
<head>
	<title>Сохранение новостей</title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
</head>
<body>
<?php 
include '../test1.php';
$setpros = array();
var_dump($_POST);
var_dump($_FILES);
echo "<br>" . "Добавление новости и фото (если есть) на сервер..." . "<br>";
echo "Существует ли фото в этом мире?" . "<br>";
// echo isset($_FILES['photo']['name']);//существуют
if($_FILES['photo']['name'] !== ""){
	$a=date("Y-m-d-H-i-s");
	$setpros = explode("/",$_FILES['photo']['type']); //фото
	$uploadfile = '/var/www/ivanuzz.pushkeen.ru/html/pd/'.$a.'.'.$setpros[1]; // ссылки на файлы
		if (move_uploaded_file ($_FILES['photo']['tmp_name'], $uploadfile)){
		echo "Фото загружено" . "<br>";
		}
	}
else{
	echo "Без фото" . "<br>";
	$uploadfile = null;	
}
echo $uploadfile . "<br>";
// if ($_FILES['photo']['name'] !== null)
$reference = $database->getReference (request_URL(3));
    $data = $reference->getSnapshot()->getValue();
    $maxid = max(array_keys($data)) + 1;
    $link = request_URL(3) . "/" . $maxid;
    $reference = $database->getReference ($link);
    $reference->update([
        "id"=>"$maxid",
        "content"=>$_POST['textarea'],
        "comment"=>
            ["0"=>[
                "user_id"=>"0",
                "content"=>"",
                "id"=>"0"
            ]],
        "likes"=>"",
        "dislikes"=>"",
        "title"=>$_POST['title'],
        "path"=>"$uploadfile",
        "img"=>"https://ivanuzz.pushkeen.ru/pd/$a.$setpros[1]",
    ]);
    echo "Успех";
    







 ?>
</body>
</html>
