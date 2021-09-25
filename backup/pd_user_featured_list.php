<?php
include '../test1.php';


if ($_GET["login"] && $_GET["password"]){
    $exists_login = false;

    $reference = $database->getReference (request_URL(2)); // ссылка на нужную "таблицу"
    $data = $reference->getSnapshot()->getValue();

    for ($i = 0; $i < count($data); $i++){
        if ($data[$i]["login"] == $_GET["login"] && $data[$i]["password"] == $_GET["password"]){ 
            $exists_login = true; 
            // echo "Пользователь найден, вот его избранные события:" . "<br>";
            $favorite_news =  $data[$i]["favorite_news"];
            echo json_encode($favorite_news,JSON_UNESCAPED_UNICODE);
        break;
        }
    }
    if ($exists_login == true){
        echo "0";
    }    
    else{
        echo "1";   
    }
}