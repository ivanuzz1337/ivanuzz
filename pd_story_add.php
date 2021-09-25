<!DOCTYPE html>
<html>
<head>
    <title>Сохранение историй</title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>

</head>
<body>
<?php 
include '../test1.php';
$setpros = array(array()); 
$uploadfile = array();
$type = array();
$db_files = array();
$db_paths = array();
// var_dump($_POST);
echo "<pre>";
var_dump($_FILES);
    echo "</pre>";

echo "<br>" . "Добавление фото (или нескольких) на сервер..." . "<br>";

if($_FILES['photo']['name']['0'] !== ""){
    $a=date("Y-m-d-H-i-s");
    echo count($_FILES['photo']['name']);
    $files_count = count($_FILES['photo']['name']);

    for($i = 0; $i < $files_count; $i++){
        $type = explode("/",$_FILES['photo']['type'][$i]);
        echo "<pre>";
        var_dump($type);
        echo "</pre>";

        $count_type = count($type);
        echo $count_type . "<br>";

            for($j = 0; $j < $count_type; $j++){
                $setpros[$i][$j] = $type[$j];
            }
    }

    echo "<br>" . "Файл(-ы) грузятся СЮДА, БЫСТРО" . "<br>"; 
    for($i = 0; $i < $files_count; $i++){
    $uploadfile[$i] = '/var/www/ivanuzz.pushkeen.ru/html/pd/'.$a.'.'.$i.'.'.$setpros[$i][1];
    }

        }
    echo "<pre>";
    var_dump($uploadfile);
    // echo $uploadfile[0] . "<br>";
    echo "</pre>";

    $count_upload = count($uploadfile);

    $reference = $database->getReference (request_URL(4));
    $data = $reference->getSnapshot()->getValue();
    $maxid = max(array_keys($data)) + 1;
    $link = request_URL(4) . "/" . $maxid;
    $reference = $database->getReference ($link);
    $reference->update([
        "id"=>"$maxid",
    ]);

for ($i = 0; $i < $count_upload; $i++){
    if (move_uploaded_file ($_FILES['photo']['tmp_name'][$i], $uploadfile[$i])){ //перемещение файла в новое место (понятно куда)
        $db_file = 'https://ivanuzz.pushkeen.ru/pd/'.$a.'.'.$i.'.'.$setpros[$i][1];//запись нового элемента как положено
        //внедрить этот элемент в массив через array push и на последнем шаге загрузить в базу
        $db_path = '/var/www/ivanuzz.pushkeen.ru/html/pd/'.$a.'.'.$i.'.'.$setpros[$i][1];
        array_push($db_files , $db_file);
        array_push($db_paths , $db_path);
        echo "Фото " . "$i" . " загружено" . "<br>" ;
        //
    if ($i + 1 == $count_upload){
            echo "<pre>";
            var_dump($db_files);
            echo "</pre>";
            echo "<pre>";
            var_dump($db_files);
            echo "</pre>";

            $string_array =  implode('","', $db_files);
            $string_path = implode('","', $db_paths);
            echo $string_array;
            echo $string_path;

            $reference = $database->getReference ($link);
            $reference->update([
            "img"=>["$string_array"],
            "path"=>["$string_path"]
        ]);
        }
    }
    else{
    echo "Фото " . "$i" . " не загружено" . "<br>" ;
}
}


// // if ($_FILES['photo']['name'] !== null)
// $reference = $database->getReference (request_URL(3));
//     $data = $reference->getSnapshot()->getValue();
//     $maxid = max(array_keys($data)) + 1;
//     $link = request_URL(3) . "/" . $maxid;
//     $reference = $database->getReference ($link);
//     $reference->update([
//         "id"=>"$maxid",
//         "content"=>$_POST['textarea'],
//         "comment"=>"",
//         "likes"=>"",
//         "img"=>"https://ivanuzz.pushkeen.ru/pd/$a.$setpros[1]",
//     ]);
//     echo "Успех";
    
 ?>
</body>
</html>
