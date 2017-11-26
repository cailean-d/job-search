<?php
    try{
        include("db_connection.php");
        $schedule = $db->query("SELECT * FROM `schedule`");
        $industry = $db->query("SELECT * FROM `industry`");
        $cities   = $db->query("SELECT DISTINCT location FROM vacancies");
        
    } catch (Exception $e) {
        echo $e->getMessage(); 
    }