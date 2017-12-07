<?php
    try{
        include("db_connection.php");
        $schedule = $db->query("SELECT * FROM `schedule`");
        $industry = $db->query("SELECT * FROM `industry`");
        $work_place = $db->query("SELECT * FROM `work_place`");
        $education = $db->query("SELECT * FROM `education`");
        $comp_skills = $db->query("SELECT * FROM `comp_skills`");
        $languages = $db->query("SELECT * FROM `languages`");
        $cities   = $db->query("SELECT DISTINCT location FROM vacancies");

        $schedule = $schedule->fetchAll();
        $industry = $industry->fetchAll();
        $work_place = $work_place->fetchAll();
        $education = $education->fetchAll();
        $comp_skills = $comp_skills->fetchAll();
        $languages = $languages->fetchAll();
        $cities = $cities->fetchAll();
        
    } catch (Exception $e) {
        echo $e->getMessage(); 
    }