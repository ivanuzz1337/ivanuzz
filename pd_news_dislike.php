<?php 
include '../test1.php';
// echo "<pre>";
// var_dump($_GET);
	// echo "</pre>";
$content = array();
$content_dislikes = array();
$is_set = false;
$is_set_dis = false;
$unset_dis = false;
$unset_user = false;
$is_set_like = false;
$unset = false;


if($_GET["user_id"] && $_GET["news_id"]){
	$reference = $database->getReference (request_URL(3));
	$data = $reference->getSnapshot()->getValue();
    $reference1 = $database->getReference (request_URL(2));
    $data_user = $reference1->getSnapshot()->getValue();
///////////////////////ПОИСК НОВОСТИ//////////////////\\\\
    	for ($i=0; $i < count($data); $i++) { 
    		// echo $data[$i]["id"] . " " . $_GET["news_id"] . "<br>"  ;
    		if($data[$i]["id"] == $_GET["news_id"]){
                $content = explode(",", $data[$i]["likes"]);
                //события разбитые строки посредством запятой
                $content_dislikes = explode(",", $data[$i]["dislikes"]);
                $target = $i;
		break;
    		}
    	}
    	if (!isset($target))
            echo '{"code":["failed"]}"';

        ////////////////ПОИСК ПОЛЬЗОВАТЕЛЯ///////////////////////\
        for ($i=1; $i < count($data_user); $i++) { 
            if($data_user[$i]["id"] == $_GET["user_id"]){
            $content_dislikes_user = explode(",", $data_user[$i]["dislikes"]);
            $content_user = explode(",", $data_user[$i]["likes"]);
            //события разбитые строки посредством запятой
            $target_user = $i;
        break;
            }
        }
        //////////////////////////ПРОВЕРКА НА СУЩЕСТВОВАНИЕ ЛАЙКА В НОВОСТЯХ///////////////////////\
                    for ($i = 0; $i < count($content); $i++){
            if ($content[$i] == $_GET["user_id"]){
                // echo " Лайк уже поставлен" . "<br>";
                $is_set = true;
                // echo $content[$i] . "==" . $_GET["id"] . "<br>";
            break;
            }
         }
//////////////////////////ПРОВЕРКА НА СУЩЕСТВОВАНИЕ ДИЗА В НОВОСТЯХ///////////////////////\
		if(isset($target)){
			for ($i = 0; $i < count($content_dislikes); $i++){
            if ($content_dislikes[$i] == $_GET["user_id"]){
                // echo " Лайк уже поставлен" . "<br>";
                $is_set_dis = true;
                // echo $content[$i] . "==" . $_GET["id"] . "<br>";
            break;
            }
         }



/////////////////////////////(УБРАТЬ ЛАЙК) ДОБАВИТЬ ДИЗ///////////////////////////////////
		if ($is_set == true){//ЕСЛИ ПОСТАВЛЕН ЛАЙК
	         for ($i = 0; $i < count($content); $i++){
            // echo $content[$i] . "<br>";
            	if ($content[$i] == $_GET["user_id"]){
                unset($content[$i]); //удалить элемент
                $unset = true;
            break;
            	}
				}
            if ($unset == true){
            $content1 = implode(",", $content);
            $content1 = ltrim($content1, ",");

            $link = request_URL(3). "/" . $target;
            $reference = $database->getReference ($link);
            $reference->update([
            "likes"=>$content1,
            ]);
            }

            ////////УБРАТЬ ЛАЙК У ПОЛЬЗОВАТЕЛЯ/////////
            // var_dump($content_user);
            for ($i = 0; $i < count($content_user); $i++){
            // echo $content[$i] . "<br>";
            if ($content_user[$i] == $_GET["news_id"]){
            unset($content_user[$i]); //удалить элемент
            $unset_like_user = true;
            break;
                }
            }
                if ($unset_like_user == true){
            $content1_user = implode(",", $content_user);
            $content1_user = ltrim($content1_user, ",");

            $link = request_URL(2). "/" . $target_user;
            $reference = $database->getReference ($link);
            $reference->update([
            "likes"=>$content1_user,
            ]);
                 }
        }

/////////////////////////////ЗАПИСАТЬ ДИЗ В НОВОСТИ///////////////////////////////////
        if ($is_set_dis !== true){
            array_push($content_dislikes, $_GET["user_id"]); 
            $content_dislikes1 = implode(",", $content_dislikes);//перевод в строку с дальнейшей записью в бд
            $content_dislikes1 = ltrim($content_dislikes1, ",");

            $link = request_URL(3). "/" . $target;
            $reference = $database->getReference ($link);
            $reference->update([
            "dislikes"=>$content_dislikes1,
            ]);
            // echo "Данные презаписаны ";
            // echo "{result:" . "added" . "}";
            if($unset == true){
            echo '{"code":["replaced"]}';
            }
            else{
            echo '{"code":["succsess"]}';
            }
            /////////////////////////ЗАПИСАТЬ ДИЗ В ПОЛЬЗОВАТЕЛЯ///////////////////////////
            array_push($content_dislikes_user, $_GET["news_id"]); 
            $content_dislikes_user1 = implode(",", $content_dislikes_user);
            //перевод в строку с дальнейшей записью в бд
            $content_dislikes_user1 = ltrim($content_dislikes_user1, ",");

            $link = request_URL(2). "/" . $target_user;
            $reference = $database->getReference ($link);
            $reference->update([
            "dislikes"=>$content_dislikes_user1,
            ]);
            }
            // }
        	

        	else{
	         for ($i = 0; $i < count($content_dislikes); $i++){
            // echo $content[$i] . "<br>";
            if ($content_dislikes[$i] == $_GET["user_id"]){
                unset($content_dislikes[$i]); //удалить элемент
                $unset_dis = true;
            break;
            }
            }

                for ($i=0; $i <count($content_dislikes_user) ; $i++) { 
                    if ($content_dislikes_user[$i] == $_GET["news_id"]){
                    unset($content_dislikes_user[$i]); //удалить элемент
                    $unset_user = true;
                break;
                }
            }
/////////////////////////////УБРАТЬ ДИЗ///////////////////////////////////
            if ($unset_dis == true){
            $content_dislikes1 = implode(",", $content_dislikes);//перевод в строку с дальнейшей записью в бд
            $content_dislikes1 = ltrim($content_dislikes1, ",");

            $link = request_URL(3). "/" . $target;
            $reference = $database->getReference ($link);
            $reference->update([
            "dislikes"=>$content_dislikes1,
            ]);
            echo '{"code":["deleted"]}';
            // echo "Данные презаписаны ";
            // echo "0";
            }
            else{
            // echo "Данные не презаписаны ";
                // echo "1";
            }
            if ($unset_user == true){
            $content_dislikes_user1 = implode(",", $content_dislikes_user);
            //перевод в строку с дальнейшей записью в бд
            $content_dislikes_user1 = ltrim($content_dislikes_user1, ",");

            $link = request_URL(2). "/" . $target_user;
            $reference = $database->getReference ($link);
            $reference->update([
            "dislikes"=>$content_dislikes_user1,
            ]);
            // echo "Данные презаписаны ";
            // echo "{result:" . "deleted" . "}";
            // echo '{"code":"deleted"}';
            }
        	}
		}
}

 ?>