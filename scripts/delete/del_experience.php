<?php 
    try{
        // старт сессии
        session_start();

        // подключение БД
        include('../db_connection.php');

        // не выполнять скрипт, если пользователь не авторизирован
        if(!isset($_SESSION['id'])){
            http_response_code(400);
            exit("Вы не авторизированы");
        }

        // массив с id
        if(!isset($_POST['data'])){
            http_response_code(400);
            exit("Нет данных");
        }

        // id пользователя
        $user_id = $_SESSION['id'];

        // парсинг json объекта
        $data = explode(",", $_POST['data']);

        foreach ($data as $id) {

            // подготовка запроса
            $query = $db->prepare("DELETE FROM `user_experience` WHERE user_id = ? AND id = ?");

            // выполнение запросов
            $query->execute([$user_id, $id]);
        
        }


    } catch (Exception $e) {
        echo $e->getMessage(); 
    }