<!DOCTYPE html>
<html lang="ru">
<head>
    <title>
        Сохранение файлов
    </title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
</head>
<body>
<?php
include '../test1.php';

echo "Добавление фото и видео и, возможно, объедка на сервер..." . "<br>";
$a=date("Y-m-d-H-i-s");
$setpros = explode("/",$_FILES['photo']['type']); //фото
$setprosvid = explode("/",$_FILES['video']['type']); //видео 
$setprosobj_ios = explode("/",$_FILES['obj_ios']['type']); // ios
$setprosobj_andr = explode("/",$_FILES['obj_andr']['type']); // android


//////////////////////////////////////////////////
echo "РАСШИРЕНИЕ IOS" . "<br>";
$extension_ios = explode(".",$_FILES['obj_ios']['name']);
echo $_FILES['obj_ios']['name'] . "<br>";
var_dump($_FILES['obj_ios']['name']) . "<br>";
var_dump($extension_ios);
echo "<br>";
//////////////////////////////////////////////////

//////////////////////////////////////////////////
echo "РАСШИРЕНИЕ Android" . "<br>";
$extension_andr = explode(".",$_FILES['obj_andr']['name']);
echo $_FILES['obj_andr']['name'] . "<br>";
var_dump($_FILES['obj_andr']['name']) . "<br>";
var_dump($extension_andr);
echo "<br>";

//////////////////////////////////////////////////

print "<br>" . "<br>";
echo "Файлы:" . "<br>";
print_r ($_FILES);
print "<br>" . "<br>";  
echo count($_FILES);
echo "<br>";
print_r ($setpros); // форматы
echo "<br>";
print_r ($setprosvid);
echo "<br>";

print_r ($setprosobj_ios); // формат ios
echo "<br>";
array_push($setprosobj_ios, "$extension_ios[1]");
print_r ($setprosobj_ios) . " Добавляю новый формат IOS"; 
echo "<br>";

print_r ($setprosobj_andr);
array_push($setprosobj_andr, "$extension_andr[1]");
print_r ($setprosobj_andr) . " Добавляю новый формат Android"; 

echo "<br>" . "<br>";

$uploadfile = '/var/www/ivanuzz.pushkeen.ru/html/pd/'.$a.'.'.$setpros[1]; // ссылки на файлы
$uploadfile2 = '/var/www/ivanuzz.pushkeen.ru/html/pd/'.$a.'.'.$setprosvid[1];
$uploadfile3 = '/var/www/ivanuzz.pushkeen.ru/html/pd/'.$a.'.'.$setprosobj_ios[2];
$uploadfile4 = '/var/www/ivanuzz.pushkeen.ru/html/pd/'.$a.'.'.$setprosobj_andr[2];


echo $uploadfile . "<br>";
echo $uploadfile2 . "<br>";
echo $uploadfile3 . "<br>";
echo $uploadfile4 . "<br>";


echo $_FILES['video']['error'] . "<br>";
echo $_FILES['obj_ios']['error'] . "<br>";
echo $_FILES['obj_andr']['error'] . "<br>";

// echo $_FILES['obj']['name'] ."<br>";
// var_dump($_FILES['obj']['name']);
if ($_FILES['obj_ios']['name'] == null && $_FILES['obj_ios']['name'] == null &&
    $_FILES['video']['name'] !== null && $_FILES['photo']['name'] !== null){
    echo "obj is void = > is video" . "<br>";
    if (move_uploaded_file ($_FILES['photo']['tmp_name'], $uploadfile)
    && move_uploaded_file ($_FILES['video']['tmp_name'], $uploadfile2)
    ){
    echo "Фото и видик успешно загружены на сервер" . "<br>";
    echo "Пытаюсь записать в базу..." . "<br>";
    $reference = $database->getReference (request_URL(1));
    $data = $reference->getSnapshot()->getValue();
    $maxid = max(array_keys($data)) + 1;
    $link = request_URL(1) . "/" . $maxid;
    $reference = $database->getReference ($link);
    $reference->update([
        "is_video"=>true,
        "photo"=>"https://ivanuzz.pushkeen.ru/pd/$a.$setpros[1]",
        "video"=>"https://ivanuzz.pushkeen.ru/pd/$a.$setprosvid[1]",
        "ios_model"=>"null",
        "android_model"=>"null",
        "id"=>"$maxid"
    ]);
    echo "Успех";
    }
    else{
        echo "Что-то пошло не птак " . "<br>" .
    $_FILES['video']['error'] . "<br>" .
    $_FILES['obj_ios']['error'] . "<br>" .
    $_FILES['obj_andr']['error'] . "<br>";
    }
}
if ($_FILES['obj_ios']['name'] !== null && $_FILES['obj_andr']['name'] !== null &&
    $_FILES['video']['name'] == null && $_FILES['photo']['name'] !== null
    ){
    echo "video is void = > is objedok" . "<br>";
if (move_uploaded_file ($_FILES['photo']['tmp_name'], $uploadfile) &&
    move_uploaded_file ($_FILES['obj_ios']['tmp_name'], $uploadfile3) &&
    move_uploaded_file ($_FILES['obj_andr']['tmp_name'], $uploadfile4)
    ){
    echo "Фото и объекты успешно загружены на сервер" . "<br>";
    echo "Пытаюсь записать в базу..." . "<br>";
    $reference = $database->getReference (request_URL(1));
    $data = $reference->getSnapshot()->getValue();
    $maxid = max(array_keys($data)) + 1;
    $link = request_URL(1) . "/" . $maxid;
    $reference = $database->getReference ($link);
    $reference->update([
        "is_video"=>false,
        "photo"=>"https://ivanuzz.pushkeen.ru/pd/$a.$setpros[1]",
        "video"=>"null",
        "ios_model"=>"https://ivanuzz.pushkeen.ru/pd/$a.$setprosobj_ios[2]",
        "android_model"=>"https://ivanuzz.pushkeen.ru/pd/$a.$setprosobj_andr[2]",
        "id"=>"$maxid"
    ]);
    echo "Успех";
}
}
else{
    echo "Что-то пошло не птак " . "<br>" .
    $_FILES['video']['error'] . "<br>" .
    $_FILES['obj_ios']['error'] . "<br>" .
    $_FILES['obj_andr']['error'] . "<br>";

}

?>
</body>
</html>
