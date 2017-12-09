<?php 
    try{
        session_start();
        include('db_connection.php');


        if(!$_POST['data']){
            http_response_code(400);
            exit("необходим data");
        }

        $data = json_decode($_POST['data']);
        $user_id = $_SESSION['id'];

        foreach ($data as $object) {
            $lang_id = htmlspecialchars(trim($object->lang_id));
            $lang_level = htmlspecialchars(trim($object->lang_level));
            $user_id = $_SESSION['id'];
    
            $query = $db->prepare("INSERT INTO user_lang_skills
                (user_id,lang_id,lang_level) 
                VALUES (?,?,?)"
            );
    
            $query->execute(array($user_id, $lang_id, $lang_level));
    
            $error = $query->errorInfo();
    
            if($error && $error[0] != 00000){
                http_response_code(400);
                echo $error;
            } else {
                echo "Запись успешно добавлена!";
            }
        }

    } catch (Exception $e) {
        echo $e->getMessage(); 
    }