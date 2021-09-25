<?php 
include '../test1.php';
	// echo "<pre>";
// var_dump($_GET);
	// echo "</pre>";
$is_set = false;
$is_set_user = false;

if($_GET["news_id"] && $_GET["user_id"] && $_GET["content"]){
	// echo "Получен заголовок новости: " . $_GET["title"] . "<Br>";
$reference = $database->getReference (request_URL(3));
$data = $reference->getSnapshot()->getValue();	
$size = array_key_last($data);
$max_id = $data[$size]["id"];
// echo $max_id . "<br>";



    for ($i = 0; $i <= $max_id; $i++){ //count($data)
    	// var_dump($data[$i]);
    	// echo $data[$i];
		if(isset($data[$i]) && $data[$i]["id"] == $_GET["news_id"]){
        $is_set = true;
	        // echo $data[$i]["id"] . " Загловок найден в базе найден в базе" . "<br>" ;
        $target = $i;
        break;
     	}
     }

/////////////\\имя комментатора/////////////////\\\
$reference = $database->getReference (request_URL(2));
$data_user = $reference->getSnapshot()->getValue();  
$size = array_key_last($data_user);
$max_id = $data_user[$size]["id"];
    for ($i = 0; $i <= $max_id; $i++){ //count($data)
        // var_dump($data[$i]);
        // echo $data[$i];
        if(isset($data_user[$i]) && $data_user[$i]["id"] == $_GET["user_id"]){
        $name = $data_user[$i]["login"];
        $is_set_user = true;
        break;
        }
     }
//////////////////////////////////

     if($is_set == true && $is_set_user == true){
$comment_link = request_URL(3)."/".$target."/comment";
$comment_data = $database->getReference ($comment_link);
$data1 = $comment_data->getSnapshot()->getValue();	

$size_comments = array_key_last($data1);
// var_dump($size_comments);
// var_dump(array_key_last($data1));
// if($size_comments == 0 || array_key_last($data1) == null){
    // echo "DA";
// $max_id_comments = 2;
// }
// else{
$max_id_comments = $size_comments + 1;
// }

$write_id = strval($max_id_comments);
// echo $write_id;
// echo "<br>";
// echo $max_id_comments;

$reference = $database->getReference ($comment_link);
$reference->update([$max_id_comments=>[
// "user_id"=>$_GET["user_id"],
"content"=>$_GET["content"],
"name"=>$name,
"id"=>$write_id
// "id"=>$write_id
]]);
// echo "Что-то сделалось";
echo '{"code":["0"]}';
}
else{
echo '{"code":["1"]}';
}
}
else{
echo '{"code":["2"]}';
}
 ?>
