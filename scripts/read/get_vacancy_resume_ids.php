<?php
    try{
        session_start();

        if($_SESSION['type'] != '1'){
            http_response_code(400);
            exit("доступно только для работодателей");
        }

        else

        if(!isset($_GET['id'])){
            http_response_code(400);
            exit("необходимо -id-");
        }

        include("./scripts/db_connection.php");

        $id = $_GET['id'];

        $sql = "SELECT * FROM vacancies_resume WHERE vacancy_id = " . $id;
        $data_id = $db->query($sql);
        $data_id = $data_id->fetchAll();

    } catch (Exception $e) {
        echo $e->getMessage(); 
    }