<?php 
    try{
        // старт сессии
        session_start();

        if(!isset($_POST['id'])){
            http_response_code(400);
            exit("необходим id");
        }

        $regexp_numbers = '/^[\d]{1,}$/u';

        if(!preg_match($regexp_numbers, $_POST['id'])){
            http_response_code(400);
            exit("Поле -id- заполнено некорректно!");
        }

        // подключение БД
        include("../db_connection.php");

        // не выполнять скрипт, если пользователь не авторизирован
        if(!isset($_SESSION['id'])){
            http_response_code(400);
            exit("Вы не авторизированы");
        }

        // id пользователя
        $user_id = $_SESSION['id'];
        $vacancy_id = $_POST['id'];

        // подготовка запросов
        $query = $db->prepare("DELETE FROM `vacancies_resume` WHERE user_id = ? AND vacancy_id = ?");

        // выполнение запросов
        $query->execute([$user_id, $vacancy_id]);

    } catch (Exception $e) {
        echo $e->getMessage(); 
    }