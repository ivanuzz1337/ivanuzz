<?php
include '../test1.php';

$reference = $database->getReference(request_URL(3));
$data = $reference->getSnapshot()->getValue();
// echo count($data) . "<br>";
// var_dump($data[7]);
// var_dump($data);
// echo "<br>";
$size = array_key_last($data);
// echo $size . "size" . "<br>";
// echo $data[$size]["id"];
// $max_id = end($data["id"]);
$max_id = $data[$size]["id"];
// echo $max_id . "<br>";
echo '{"news":[';
    for ($i = 1; $i <= $max_id; $i++){
    	// echo $i . "<br>";
        if (isset($data[$i])){
            echo json_encode($data[$i],JSON_UNESCAPED_UNICODE);
        }
            if($i+1 <= $max_id && isset($data[$i])){
                echo ",";
            }
        
    }
echo "]}";
?>