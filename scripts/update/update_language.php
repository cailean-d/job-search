<?php 
    try{
        // старт сессии
        session_start();

        // подключение БД
        include('../db_connection.php');

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

            elseif(!$object->record_id){
                http_response_code(400);
                exit("необходим record_id");
            }

            // проверка все входящих переменных на валидность по регулярному выражению
            elseif(!preg_match($regexp_numbers, $object->lang_id)){
                http_response_code(400);
                exit("Поле -lang_id- заполнено некорректно!");
            }
            elseif(!preg_match($regexp_numbers, $object->record_id)){
                http_response_code(400);
                exit("Поле -record_id- заполнено некорректно!");
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
            $record_id = htmlspecialchars(trim($object->record_id));
            $user_id = $_SESSION['id'];


            $sql = "UPDATE user_lang_skills SET 
                    lang_id = ?
                    lang_level = ?
                    WHERE user_id = ? AND id = ?
                   ";

            $sql_array = [
                $lang_id,
                $lang_level,
                $user_id,
                $record_id
            ];
    
            // подготовка запроса
            $query = $db->prepare($sql);

            // выполнение запроса
            $query->execute($sql_array);
    
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