<!-- выдать id аккаунта по имени и фамилии 
(для релиза надо будет потом переделать под данные авторизации),
 если пользователя не было, то добавить аккаунт пользователя -->
 <?php 
include '../test1.php';

if ($_GET["login"] && $_GET["password"]){
$reference = $database->getReference (request_URL(2)); // ссылка на нужную "таблицу"
$data = $reference->getSnapshot()->getValue();
$exists_login = false;
// var_dump($data[0]) . "<br>"; // нулевой элемент в массиве data от users_data

    for ($i = 0; $i < count($data); $i++){
        if ($data[$i]["login"] == $_GET["login"] && $data[$i]["password"] == $_GET["password"]){ 
            // echo $data[$i]["favorite_events"] . "<br>";
            // var_dump($data[$i]);
            
            echo json_encode($data[$i]["id"]);
            $exists_login = true; // cуществует. это буду возвращать как status_code
        break; 
        }
            // else {
            // echo "Пользователь с таким id не найден" . "<br>";
            // }   
}

    // var_dump($exists_vk);
    // echo "<br>";

//id не найден -> регистрация. обратиться к этому же массиву users_data, создать новый элемент, заполнить
        if ($exists_login !== true){
            // echo $reference . "<br>";
            $maxelement = max(array_keys($data)) + 1;
            // $link = $reference . "/" . $maxelement; //вариант 1
            $link = request_URL(2) . "/" . $maxelement; //вариант 2 ДАДАДАДАДДАДАДАДАДДАДАДАД
            $reference = $database->getReference ($link); // ссылка на нужную "таблицу"
            $reference->update([
                "id"=>"$maxelement",
                "login"=>$_GET["login"],
                "password"=>$_GET["password"],
                "likes"=>"",
                "nickname"=>"",
                "favorite_news"=>"",
                "dislikes"=>"",
            ]);

            $reference = $database->getReference ($link); 
            $data = $reference->getSnapshot()->getValue();
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            // echo "{favorite_events: "", favorite_places: "", user_vk_id: "565304810", users_score: "0", users_visited_count: ""}";

                // echo "Успех, новый пользователь vk записан в БД";
        }
}

  ?>