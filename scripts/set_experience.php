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

            $post = htmlspecialchars(trim($object->exp_post));
            $company = htmlspecialchars(trim($object->exp_company));
            $city = htmlspecialchars(trim($object->exp_city));
            $industry_id = htmlspecialchars(trim($object->exp_industry));
            $work_period = htmlspecialchars(trim($object->work_period));
            $functions = htmlspecialchars(trim($object->exp_func));
            
            $query = $db->prepare("INSERT INTO user_experience
            (user_id, post, company, city, industry_id, work_period, functions) 
            VALUES (?, ?, ?, ?, ?, ?, ?)"
            );

            $query->execute(
                array($user_id, $post, $company, $city, $industry_id, $work_period, $functions)
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