<?php
    try{

        include(realpath("./scripts/db_connection.php"));

        $id = $_SESSION['id'];

        $sql = "SELECT * FROM `user_resume` WHERE user_id =" . $id;

        $resume_data = $db->prepare($sql);
        $resume_data->execute();

        $error = $resume_data->errorInfo();

        if($error && $error[0] != 00000){
            die($error);
        } else {
            $resume_data = $resume_data->fetchAll();
            if($resume_data && count($resume_data) > 0){
                $is_result = true;
            }
        }

    } catch (Exception $e) {
        echo $e->getMessage(); 
    }