<?php
include '../test1.php';


    $reference = $database->getReference (request_URL(4)); // ссылка на нужную "таблицу"
    $data = $reference->getSnapshot()->getValue();

    $size = array_key_last($data);
    $max_id = $data[$size]["id"];
// echo $max_id . "<br>";
echo '{"stories":[';
    for ($i = 0; $i <= $max_id; $i++){
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