<?php 
include '../test1.php';
	// echo "<pre>";
// var_dump($_GET);
	// echo "</pre>";

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
	        // echo $data[$i]["id"] . " Загловок найден в базе найден в базе" . "<br>" ;
        $target = $i;
        break;
     	}
     }
$comment_link = request_URL(3)."/".$target."/comment";
// echo "<pre>";
// var_dump($comment_link);
// echo "</pre>";

$comment_data = $database->getReference ($comment_link);
$data1 = $comment_data->getSnapshot()->getValue();	

// echo "<pre>";
// var_dump($data1);
// echo "</pre>";

$size_comments = array_key_last($data1);
$max_id_comments = $size_comments + 1;
// for ($i=0; $i < count($comment_data) ; $i++) { 
// }
// $link = request_URL(3). "/" . $target_user;
// $comment_link = request_URL(3)."/".$target."/comment";
$write_id = strval($max_id_comments);


$reference = $database->getReference ($comment_link);
$reference->update([$max_id_comments=>[
"user_id"=>$_GET["user_id"],
"content"=>$_GET["content"],
"id"=>$write_id
]]);
// echo "Что-то сделалось";
echo "{result:" . "added" . "}";

}
else{
echo "{result:" . "uncorrect_id" . "}";
}
 ?>
