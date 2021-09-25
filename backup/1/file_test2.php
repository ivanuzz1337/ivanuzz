<?php 
	echo "<pre>";
var_dump($_POST);
	echo "</pre>";
	$test = strtotime($_POST["date"]); // тут может преобразование отличаться
echo "week: ".date("Y-W", $test);
  ?>