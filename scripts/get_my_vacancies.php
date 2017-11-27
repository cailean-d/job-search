<?php
    try{
        include("db_connection.php");

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
        
    } catch (Exception $e) {
        echo $e->getMessage(); 
    }