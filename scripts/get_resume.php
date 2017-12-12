<?php
    try{
        include("db_connection.php");

        $sql = 'SELECT * FROM user_resume WHERE user_id ='.$_SESSION['id'];

        $result = $db->prepare($sql);
        $result->execute();

        $error = $result->errorInfo();

        if($error && $error[0] != 00000){
            die($error);
        } else {
            $result = $result->fetch(PDO::FETCH_BOTH);
            if($result && count($result) > 0){
                $is_result = true;
            }
        }

    } catch (Exception $e) {
        echo $e->getMessage(); 
    }