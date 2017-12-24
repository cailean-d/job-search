<?php 
    try{
        // старт сессии
        session_start();

        // подключение БД
        include(realpath("../db_connection.php"));

        // регулярные выражения для проверки валидности
        $regexp_numbers = '/^[\d]{1,}$/ui';

        // выдать оошибку, если нет массива с данными
        if(!$_POST['data']){
            http_response_code(400);
            exit("необходим data");
        }

        // парсинг json объекта
        $data = json_decode($_POST['data']);
        $user_id = $_SESSION['id'];

        foreach ($data as $object) {

            // если нет необходимых переменных, выдать ошибку
            if(!$object->lang_id){
                http_response_code(400);
                exit("необходим lang_id");
            }
            elseif(!$object->lang_level){
                http_response_code(400);
                exit("необходим lang_level");
            }

            // проверка все входящих переменных на валидность по регулярному выражению
            elseif(!preg_match($regexp_numbers, $object->lang_id)){
                http_response_code(400);
                exit("Поле -lang_id- заполнено некорректно!");
            }
            elseif(
                $object->lang_level != "Не владею" &&
                $object->lang_level != "Базовый" &&
                $object->lang_level != "Технический" &&
                $object->lang_level != "Разговорный" &&
                $object->lang_level != "Свободно владею"
                ){
                http_response_code(400);
                exit("Поле -lang_level- заполнено некорректно!");
            }

            // преобразование спецсимволов
            $lang_id = htmlspecialchars(trim($object->lang_id));
            $lang_level = htmlspecialchars(trim($object->lang_level));
            $user_id = $_SESSION['id'];
    
            // подготовка запроса
            $query = $db->prepare("INSERT INTO user_lang_skills
                (user_id,lang_id,lang_level) 
                VALUES (?,?,?)"
            );

            // выполнение запроса
            $query->execute(array($user_id, $lang_id, $lang_level));
    
            $error = $query->errorInfo();
            
            // проверка произошла ли ошибка при выполнении запроса 
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