<?php 
include '../test1.php';

	// echo "<pre>";
// var_dump($_GET);
	// echo "</pre>";
	$is_set = false;
if($_GET["date"]){
// $week = ($_GET["date"]);
$week = strtotime($_GET["date"]); // тут может преобразование отличаться
$week_number = date("Y-W", $week);
// echo $week_number . "<br>" ;
// var_dump($week_number);
// echo "week: ".date("Y-W", $test);

$reference = $database->getReference(request_URL(1));
$data = $reference->getSnapshot()->getValue();
$size = array_key_last($data);
$max_id = $data[$size]["id"];
echo '{"twosome":[';
    for ($i = 1; $i <= $max_id; $i++){
    	// echo "<br>" . $data[$i]["week"] . " < from db; from post > " . $week_number . "<br>";
    	// $db_week = trim($data[$i]["week"], "W");
    	$db_week = str_replace("W", "", $data[$i]["week"]);
    	// echo  $db_week .  "?" . $week_number . "<br>";
        	if (isset($data[$i]) && $db_week == $week_number){
				$is_set = true;
            echo json_encode($data[$i],JSON_UNESCAPED_UNICODE);
        }
        else{
        		$is_set = false;
        }
            if($i+1 <= $max_id && isset($data[$i]) && $is_set == true){
                echo ",";
            }
        
    }
echo "]}";


}


 ?>