<?php 
include '../test1.php';
$content = array();
$is_set = false;
if ($_GET["login"] && $_GET["password"]){
	$reference = $database->getReference (request_URL(2)); // ссылка на нужную "таблицу"
	$data = $reference->getSnapshot()->getValue();
	$exists_login = false;

    for ($i = 0; $i < count($data); $i++){
        if ($data[$i]["login"] == $_GET["login"] && $data[$i]["password"] == $_GET["password"]){ 
            $content = explode(",", $data[$i]["favorite_news"]);//события разбитые строки посредством запято
            $exists_login = true; // cуществует. это буду возвращать как status_code
            $target_user = $i; //подопечный
	break; 
     		}
	}

	if ($exists_login == true && $_GET["id"] && $_GET["status"] == "add"){
		// echo $target_user . "<br>";
    //ПРОВЕРКА НА СУЩЕСТВОВАНИЕ
        for ($i = 0; $i < count($content); $i++){
            // echo $content[$i] . "<br>";
            if ($content[$i] == $_GET["id"]){
                echo "1";
                // echo " Событие уже есть в избранном" . "<br>";
                $is_set = true;
                // echo $content[$i] . "==" . $_GET["id"] . "<br>";
            break;
            }
        }

            if ($is_set !== true){
            array_push($content, $_GET["id"]); 
            $content1 = implode(",", $content);//перевод в строку с дальнейшей записью в бд
            $content1 = ltrim($content1, ",");

            $link = request_URL(2). "/" . $target_user;
            $reference = $database->getReference ($link);
            $reference->update([
            "favorite_news"=>$content1,
            ]);
            // echo "Данные презаписаны ";
            echo "0";
        	}

    }
    if ($exists_login == true && $_GET["id"] && $_GET["status"] == "delete"){
        // echo $target_user . "<br>";
    //ПРОВЕРКА НА СУЩЕСТВОВАНИЕ
        for ($i = 0; $i < count($content); $i++){
            // echo $content[$i] . "<br>";
            if ($content[$i] == $_GET["id"]){
                unset($content[$i]); //удалить элемент
                $is_set = true;
            break;
            }
        }

            if ($is_set == true){
            $content1 = implode(",", $content);//перевод в строку с дальнейшей записью в бд
            $content1 = ltrim($content1, ",");

            $link = request_URL(2). "/" . $target_user;
            $reference = $database->getReference ($link);
            $reference->update([
            "favorite_news"=>$content1,
            ]);
            // echo "Данные презаписаны ";
            echo "0";
            }
            else{
                echo "1";
            }

    }
}
 ?>