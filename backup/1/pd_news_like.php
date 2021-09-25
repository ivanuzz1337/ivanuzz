<?php 
include '../test1.php';
// echo "<pre>";
// var_dump($_GET);
	// echo "</pre>";
$content = array();
$content_dislikes = array();
$is_set = false;
$is_set_dis = false;
if($_GET["user_id"] && $_GET["news_id"]){
	$reference = $database->getReference (request_URL(3));
    	$data = $reference->getSnapshot()->getValue();
    	for ($i=0; $i < count($data); $i++) { 
    		// echo $data[$i]["id"] . " " . $_GET["news_id"] . "<br>"  ;
    		if($data[$i]["id"] == $_GET["news_id"]){
            $content = explode(",", $data[$i]["likes"]);//события разбитые строки посредством запятой
    			$target = $i;
            $content_dislikes = explode(",", $data[$i]["dislikes"]);
    			break;
    		}
    	}
    	if (!isset($target))
    		// echo "id not found";
            echo '{"code":"failed"}"';
    	// else
			// echo $target . "<br>" ;
//////////////////////////ПРОВЕРКА НА СУЩЕСТВОВАНИЕ ЛАЙКА///////////////////////\
		if(isset($target)){
			for ($i = 0; $i < count($content); $i++){
            if ($content[$i] == $_GET["user_id"]){
                // echo " Лайк уже поставлен" . "<br>";
                $is_set = true;
                // echo $content[$i] . "==" . $_GET["id"] . "<br>";
            break;
            }
         }
//////////////////////////ПРОВЕРКА НА СУЩЕСТВОВАНИЕ ДИЗЛАЙКА///////////////////////\
         for ($i = 0; $i < count($content_dislikes); $i++){
            if ($content_dislikes[$i] == $_GET["user_id"]){
                // echo " Дизайк уже поставлен" . "<br>";
                $is_set_dis = true;
                // echo $content[$i] . "==" . $_GET["id"] . "<br>";
            break;
         }
        }
/////////////////////////////(УБРАТЬ ДИЗ) ДОБАВИТЬ ЛАЙК///////////////////////////////////
		if ($is_set_dis == true){
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
		}
/////////////////////////////ЗАПИСАТЬ ЛАЙК///////////////////////////////////
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
            echo '{"code":"succsess"}';
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
            echo '{"code":"deleted"}';

            
            }
            else{
            // echo "Данные не презаписаны ";
                // echo "1";
            }
        	}
		}
}

 ?>