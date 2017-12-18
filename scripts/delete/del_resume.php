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

        // id пользователя
        $user_id = $_SESSION['id'];

        // подготовка запросов
        $query1 = $db->prepare("DELETE FROM `user_resume` WHERE user_id = ?");
        $query2 = $db->prepare("DELETE FROM `user_avatar` WHERE user_id = ?");
        $query3 = $db->prepare("DELETE FROM `user_education` WHERE user_id = ?");
        $query4 = $db->prepare("DELETE FROM `user_experience` WHERE user_id = ?");
        $query5 = $db->prepare("DELETE FROM `user_lang_skills` WHERE user_id = ?");

        // выполнение запросов
        $query1->execute([$user_id]);
        $query2->execute([$user_id]);
        $query3->execute([$user_id]);
        $query4->execute([$user_id]);
        $query5->execute([$user_id]);

    } catch (Exception $e) {
        echo $e->getMessage(); 
    }