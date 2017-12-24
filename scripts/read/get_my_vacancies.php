<?php
    try{
        include("./scripts/db_connection.php");

        $sql = '
            SELECT 
            vacancies.*,
            schedule.schedule_name
            FROM `vacancies` 
            INNER JOIN schedule ON vacancies.schedule = schedule.id
            WHERE sender_id='.$_SESSION['id'].'
            ORDER BY `date` DESC
        ';

        $result = $db->prepare($sql);
        $result->execute();

        $error = $result->errorInfo();

        if($error && $error[0] != 00000){
            die($error);
        } else {
            $result = $result->fetchAll(PDO::FETCH_BOTH);
            if(count($result) > 0){
                $is_result = true;
            }
        }
        
    } catch (Exception $e) {
        echo $e->getMessage(); 
    }