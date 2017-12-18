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
        $regexp_work_period = '/^[A-zА-яЁё]{3,8}\s[\d]{4}\s\-\s[A-zА-яЁё]{3,8}\s[\d]{4}$/u';

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
            if(!$object->exp_post){
                http_response_code(400);
                exit("необходим exp_post");
            }
            elseif(!$object->exp_company){
                http_response_code(400);
                exit("необходим exp_company");
            }
            elseif(!$object->exp_city){
                http_response_code(400);
                exit("необходим exp_city");
            }
            elseif(!$object->exp_industry){
                http_response_code(400);
                exit("необходим exp_industry");
            }
            elseif(!$object->work_period){
                http_response_code(400);
                exit("необходим work_period");
            }
            elseif(!$object->exp_func){
                http_response_code(400);
                exit("необходим exp_func");
            }
            elseif(!$object->record_id){
                http_response_code(400);
                exit("необходим record_id");
            }

            // проверка все входящих переменных на валидность по регулярному выражению
            elseif(!preg_match($regexp_sentence, $object->exp_post)){
                http_response_code(400);
                exit("Поле -exp_post- заполнено некорректно!");
            }
            elseif(!preg_match($regexp_sentence, $object->exp_company)){
                http_response_code(400);
                exit("Поле -exp_company- заполнено некорректно!");
            }
            elseif(!preg_match($regexp_city, $object->exp_city)){
                http_response_code(400);
                exit("Поле -exp_city- заполнено некорректно!");
            }
            elseif(!preg_match($regexp_numbers, $object->exp_industry)){
                http_response_code(400);
                exit("Поле -exp_industry- заполнено некорректно!");
            }
            elseif(!preg_match($regexp_work_period, $object->work_period)){
                http_response_code(400);
                exit("Поле -work_period- заполнено некорректно!");
            }
            elseif(!preg_match($regexp_sentence, $object->exp_func)){
                http_response_code(400);
                exit("Поле -exp_func- заполнено некорректно!");
            }
            elseif(!preg_match($regexp_numbers, $object->record_id)){
                http_response_code(400);
                exit("Поле -record_id- заполнено некорректно!");
            }

            // преобразование спецсимволов
            $post = htmlspecialchars(trim($object->exp_post));
            $company = htmlspecialchars(trim($object->exp_company));
            $city = htmlspecialchars(trim($object->exp_city));
            $industry_id = htmlspecialchars(trim($object->exp_industry));
            $work_period = htmlspecialchars(trim($object->work_period));
            $functions = htmlspecialchars(trim($object->exp_func));
            $record_id = htmlspecialchars(trim($object->record_id));


            $sql = "UPDATE user_experience SET 
                    post = ?
                    company = ?
                    city = ?
                    industry_id = ?
                    work_period = ?
                    functions = ?
                    WHERE user_id = ? AND id = ?
                    ";

            $sql_array = [
                $post,
                $company,
                $city,
                $industry_id,
                $work_period,
                $functions,
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