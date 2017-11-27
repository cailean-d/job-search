<?php
    try{
        include("db_connection.php");

        $sql = '
            SELECT 
            vacancies.*,
            schedule.schedule_name,
            industry.industry_name
            FROM `vacancies` 
            INNER JOIN schedule ON vacancies.schedule = schedule.id
            INNER JOIN industry ON vacancies.industry = industry.id
            WHERE vacancies.id='.$_GET['id'];

        $result = $db->prepare($sql);
        $result->execute();

        $error = $result->errorInfo();

        if($error && $error[0] != 00000){
            die($error);
        } else {
            $result = $result->fetch(PDO::FETCH_BOTH);
            if(count($result) > 0){
                $is_result = true;
            }
        }

        $result['demands'] = explode(',', $result['demands']);
        $result['duties'] = explode(',', $result['duties']);
        $result['conditions'] = explode(',', $result['conditions']);
        
    } catch (Exception $e) {
        echo $e->getMessage(); 
    }