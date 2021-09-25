<?php
include '../test1.php';


if ($_GET["login"] && $_GET["password"]){
    $exists_login = false;

    $reference = $database->getReference (request_URL(2)); // ссылка на нужную "таблицу"
    $data = $reference->getSnapshot()->getValue();
// echo '{"favorite_news:":[';
    for ($i = 0; $i < count($data); $i++){
        if ($data[$i]["login"] == $_GET["login"] && $data[$i]["password"] == $_GET["password"]){ 
            $exists_login = true; 
            // echo "Пользователь найден, вот его избранные события:" . "<br>";
            $favorite_news =  $data[$i]["favorite_news"];
            $exit = json_encode($favorite_news,JSON_UNESCAPED_UNICODE);
        break;
        }
    }
// echo "]}";

    if ($exists_login == true){
        $exit = trim($exit, '"');
        echo '{"code":"0","result":[' . $exit .']}';
        // echo "{result:" . "found" . "}";

    }    
    else{
        echo '{"code":"1","result":[]}';
        // echo "{result:" . "not_found" . "}";


    }
}