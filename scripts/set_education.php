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

            $level_id = htmlspecialchars(trim($object->edu_level));
            $inst = htmlspecialchars(trim($object->edu_inst));
            $city = htmlspecialchars(trim($object->edu_city));
            $faculty = htmlspecialchars(trim($object->edu_fac));
            $period = htmlspecialchars(trim($object->edu_period));
            
            $query = $db->prepare("INSERT INTO user_education
            (user_id, level_id, inst, city, faculty, study_period) 
            VALUES (?, ?, ?, ?, ?, ?)"
            );

            $query->execute(
                array($user_id, $level_id, $inst, $city, $faculty, $period)
            );

            $error = $query->errorInfo();

            if($error && $error[0] != 00000){
                http_response_code(400);
                exit($error);
            } else {
                echo "Запись успешно добавлена!";
            }
        }

    } catch (Exception $e) {
        echo $e->getMessage(); 
    }