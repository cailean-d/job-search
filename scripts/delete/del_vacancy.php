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

        if(!isset($_POST['id'])){
            http_response_code(400);
            exit("необходим -id-");
        }

        // id пользователя
        $user_id = $_SESSION['id'];
        $id = $_POST['id'];

        // подготовка запроса
        $query = $db->prepare("DELETE FROM `vacancies` WHERE sender_id = ? AND id = ?");

        // выполнение запросов
        $query->execute([$user_id, $id]);
        


    } catch (Exception $e) {
        echo $e->getMessage(); 
    }