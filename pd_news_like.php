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
if($_GET["user_id"] && $_GET["news_id"]){
	$reference = $database->getReference (request_URL(3));
	$data = $reference->getSnapshot()->getValue();
    $reference1 = $database->getReference (request_URL(2));
    $data_user = $reference1->getSnapshot()->getValue();
///////////////////////ПОИСК НОВОСТИ//////////////////\\\\
    	for ($i=0; $i < count($data); $i++) { 
    		if($data[$i]["id"] == $_GET["news_id"]){
            $content_dislikes = explode(",", $data[$i]["dislikes"]);
            $content = explode(",", $data[$i]["likes"]);

// echo "<pre>";
// var_dump($content);
// echo "</pre>";
//             $content_trim = trim('"', $data[$i]["likes"]);
// echo "<pre>";
// var_dump($data[$i]["likes"]);
// echo "</pre>";
//             $content_trim = explode(",", $content_trim);

// echo "<pre>";
// var_dump($content_trim);
// echo "</pre>";
            //события разбитые строки посредством запятой
			$target = $i;

		break;
    		}
    	}
    	if (!isset($target))//Если новость не найдена
    		// echo "id not found";
            echo '{"code":["failed"]}"';
        // else
            // echo $target . "<br>" ;

////////////////ПОИСК ПОЛЬЗОВАТЕЛЯ///////////////////////\
        for ($i=0; $i < count($data_user); $i++) { 
            if($data_user[$i]["id"] == $_GET["user_id"]){
            $content_dislikes_user = explode(",", $data_user[$i]["dislikes"]);
            $content_user = explode(",", $data_user[$i]["likes"]);
            //события разбитые строки посредством запятой
            $target_user = $i;
        break;
            }
        }

//////////////////////////ПРОВЕРКА НА СУЩЕСТВОВАНИЕ ЛАЙКА В НОВОСТЯХ///////////////////////\
		if(isset($target)){
			for ($i = 0; $i < count($content); $i++){
            if ($content[$i] == $_GET["user_id"]){
                // echo " Лайк уже поставлен" . "<br>";
                $is_set = true; // Лайк уже поставлен
                // echo $content[$i] . "==" . $_GET["id"] . "<br>";
            break;
            }
         }
//////////////////////////ПРОВЕРКА НА СУЩЕСТВОВАНИЕ ДИЗЛАЙКА В НОВОСТЯХ///////////////////////\
         for ($i = 0; $i < count($content_dislikes); $i++){
            if ($content_dislikes[$i] == $_GET["user_id"]){
                // echo " Дизайк уже поставлен" . "<br>";
                $is_set_dis = true;
                // echo $content[$i] . "==" . $_GET["id"] . "<br>";
            break;
         }
        }
/////////////////////////////(УБРАТЬ ДИЗ) ДОБАВИТЬ ЛАЙК///////////////////////////////////
		if ($is_set_dis == true){//ЕСЛИ ПОСТАВЛЕН ДИЗ
	         for ($i = 0; $i < count($content_dislikes); $i++){
            // echo $content[$i] . "<br>";
            	if ($content_dislikes[$i] == $_GET["user_id"]){
                unset($content_dislikes[$i]); //удалить элемент
                $unset_dis = true;
            break;
            	}
				}
            if ($unset_dis == true){
            $content_dislikes1 = implode(",", $content_dislikes);
            $content_dislikes1 = ltrim($content_dislikes1, ",");

            $link = request_URL(3). "/" . $target;
            $reference = $database->getReference ($link);
            $reference->update([
            "dislikes"=>$content_dislikes1,
            ]);
    		}

/////////////////////УБРАТЬ ДИЗ У ПОЛЬЗОВАТЕЛЯ//////////////////
                for ($i = 0; $i < count($content_dislikes_user); $i++){
            // echo $content[$i] . "<br>";
                if ($content_dislikes_user[$i] == $_GET["news_id"]){
                unset($content_dislikes_user[$i]); //удалить элемент
                $unset_dis_user = true;
            break;
                }
            }
                if ($unset_dis_user == true){
            $content_dislikes1_user = implode(",", $content_dislikes_user);
            $content_dislikes1_user = ltrim($content_dislikes1_user, ",");

            $link = request_URL(2). "/" . $target_user;
            $reference = $database->getReference ($link);
            $reference->update([
            "dislikes"=>$content_dislikes1_user,
            ]);
		         }
    }
/////////////////////////////ЗАПИСАТЬ ЛАЙК В НОВОСТИ///////////////////////////////////
        if ($is_set !== true){
            array_push($content, $_GET["user_id"]); 
            $content1 = implode(",", $content);//перевод в строку с дальнейшей записью в бд
            $content1 = ltrim($content1, ",");

            $link = request_URL(3). "/" . $target;
            $reference = $database->getReference ($link);
            $reference->update([
            "likes"=>$content1,
            ]);
            // echo "Данные презаписаны ";
            // echo "{result:" . "added" . "}";
            if($unset_dis == true){
            echo '{"code":["replaced"]}';
            }
            else{
            echo '{"code":["succsess"]}';
            }

/////////////////////////ЗАПИСАТЬ ЛАЙК В ПОЛЬЗОВАТЕЛЯ///////////////////////////
            array_push($content_user, $_GET["news_id"]); 
            $content1_user = implode(",", $content_user);
            //перевод в строку с дальнейшей записью в бд
            $content1_user = ltrim($content1_user, ",");

            $link = request_URL(2). "/" . $target_user;
            $reference = $database->getReference ($link);
            $reference->update([
            "likes"=>$content1_user,
            ]);
        	}



        	else{
	         for ($i = 0; $i < count($content); $i++){
            // echo $content[$i] . "<br>";
            if ($content[$i] == $_GET["user_id"]){
                unset($content[$i]); //удалить элемент
                $unset = true;
            break;
            }
            }
                for ($i=0; $i <count($content_user) ; $i++) { 
                    if ($content_user[$i] == $_GET["news_id"]){
                    unset($content[$i]); //удалить элемент
                    $unset_user = true;
                break;
                }
                }
/////////////////////////////УБРАТЬ ЛАЙК///////////////////////////////////
            if ($unset == true){
            $content1 = implode(",", $content);//перевод в строку с дальнейшей записью в бд
            $content1 = ltrim($content1, ",");

            $link = request_URL(3). "/" . $target;
            $reference = $database->getReference ($link);
            $reference->update([
            "likes"=>$content1,
            ]);
            // echo "Данные презаписаны ";
            // echo "{result:" . "deleted" . "}";
            echo '{"code":["deleted"]}';
            }
            else{
            // echo "Данные не презаписаны ";
                // echo "1";
            }
            if ($unset_user == true){
            $content1_user = implode(",", $content_user);
            //перевод в строку с дальнейшей записью в бд
            $content1_user = ltrim($content1_user, ",");

            $link = request_URL(2). "/" . $target_user;
            $reference = $database->getReference ($link);
            $reference->update([
            "likes"=>$content1,
            ]);
            // echo "Данные презаписаны ";
            // echo "{result:" . "deleted" . "}";
            // echo '{"code":"deleted"}';

            
            }
        	}
		}
}

 ?>