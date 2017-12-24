<?php 
    try{
        // старт сессии
        session_start();


        if(!isset($_POST['id'])){
            http_response_code(400);
            exit("необходим id");
        }

        $_GET['id'] = $_POST['id'];

        $regexp_numbers = '/^[\d]{1,}$/u';

        if(!preg_match($regexp_numbers, $_POST['id'])){
            http_response_code(400);
            exit("Поле -id- заполнено некорректно!");
        }
       
        // подключение БД
        include(realpath("../db_connection.php"));
        include(realpath("../read/get_resume_id.php"));

        // выдать оошибку, если у пользователя нет резюме
        if(count($resume_data) == 0){
            http_response_code(400);
            exit("Резюме не существует");
        }
        
        include(realpath("../read/get_vacancy_resume.php"));
        
        // выдать оошибку, если по какой-то причине запись уже есть
        if(count($resume) != 0){
            http_response_code(400);
            exit("Резюме уже отправлено");
        }

        $user_id = $_SESSION['id'];
        $vacancy_id = $_POST['id'];


        // подготовка запроса
        $query = $db->prepare("INSERT INTO vacancies_resume
            (vacancy_id,user_id) 
            VALUES (?,?)"
        );

        // выполнение запроса
        $query->execute([$vacancy_id, $user_id]);

        $error = $query->errorInfo();
        
        // проверка произошла ли ошибка при выполнении запроса 
        if($error && $error[0] != 00000){
            http_response_code(400);
            echo $error;
        } else {
            echo "Запись успешно добавлена!";
        }

    } catch (Exception $e) {
        echo $e->getMessage(); 
    }