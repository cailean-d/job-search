<?php 
    try{
        // старт сессии
        session_start();

        // подключение БД
        include('../db_connection.php');

        // регулярные выражения для проверки валидности
        $regexp_city = '/^[A-zА-яЁё\"\-\s?]{4,}$/u';
        $regexp_sentence = '/^[A-zА-яЁё0-9\.,!:\\(\)#"\-\s?]{4,}$/u';
        $regexp_numbers = '/^[\d]{1,}$/u';
        $regexp_edu_period = '/^[\d]{4}\s\-\s[\d]{4}$/u';

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
            if(!$object->edu_level){
                http_response_code(400);
                exit("необходим edu_level");
            }
            elseif(!$object->edu_inst){
                http_response_code(400);
                exit("необходим edu_inst");
            }
            elseif(!$object->edu_city){
                http_response_code(400);
                exit("необходим edu_city");
            }
            elseif(!$object->edu_period){
                http_response_code(400);
                exit("необходим edu_period");
            }
            elseif(!$object->record_id){
                http_response_code(400);
                exit("необходим record_id");
            }

            // проверка все входящих переменных на валидность по регулярному выражению
            elseif(!preg_match($regexp_numbers, $object->edu_level)){
                http_response_code(400);
                exit("Поле -edu_level- заполнено некорректно!");
            }
            elseif(!preg_match($regexp_sentence, $object->edu_inst)){
                http_response_code(400);
                exit("Поле -edu_inst- заполнено некорректно!");
            }
            elseif(!preg_match($regexp_city, $object->edu_city)){
                http_response_code(400);
                exit("Поле -edu_city- заполнено некорректно!");
            }
            elseif(!empty($object->edu_fac) && !preg_match($regexp_sentence, $object->edu_fac)){
                http_response_code(400);
                exit("Поле -edu_fac- заполнено некорректно!");
            }
            elseif(!preg_match($regexp_edu_period, $object->edu_period)){
                http_response_code(400);
                exit("Поле -edu_period- заполнено некорректно!");
            }
            elseif(!preg_match($regexp_numbers, (string)$object->record_id)){
                http_response_code(400);
                exit("Поле -record_id- заполнено некорректно!");
            }

            // преобразование спецсимволов
            $level_id = htmlspecialchars(trim($object->edu_level));
            $inst = htmlspecialchars(trim($object->edu_inst));
            $city = htmlspecialchars(trim($object->edu_city));
            $faculty = htmlspecialchars(trim($object->edu_fac));
            $period = htmlspecialchars(trim($object->edu_period));
            $record_id = htmlspecialchars(trim($object->record_id));

            $sql = "UPDATE user_education SET 
                    level_id = ?
                    inst = ?
                    city = ?
                    faculty = ?
                    study_period = ?
                    WHERE user_id = ? AND id = ?
                    ";

            $sql_array = [
                $level_id,
                $inst,
                $city,
                $faculty,
                $period,
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
                exit($error);
            } else {
                echo "Запись успешно добавлена!";
            }
        }

    } catch (Exception $e) {
        echo $e->getMessage(); 
    }