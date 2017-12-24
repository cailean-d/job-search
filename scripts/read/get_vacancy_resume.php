<?php
    try{
        include(realpath("./scripts/db_connection.php"));


        $id = $_GET['id'];

        $sql = ' SELECT * FROM `vacancies_resume` WHERE user_id = ? AND vacancy_id = ?';

        $resume = $db->prepare($sql);
        $resume->execute([$_SESSION['id'], $id]);

        $error = $resume->errorInfo();

        if($error && $error[0] != 00000){
            die($error);
        } else {
            $resume = $resume->fetchAll();
            if(count($resume) > 0){
                $is_resume = true;
            }
        }
        
    } catch (Exception $e) {
        echo $e->getMessage(); 
    }