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


        $max_salary = $db->query("SELECT MAX(salary_max) as MAX FROM vacancies WHERE status=\"1\"");
        $max_salary = $max_salary->fetch();
        $max_salary = $max_salary["MAX"];
        
        $min_salary = $db->query("SELECT MIN(salary_min) as MIN FROM vacancies WHERE status=\"1\"");
        $min_salary = $min_salary->fetch();
        $min_salary = $min_salary["MIN"];
        
        if((int)$max_salary % 5000 != 0){
            $a = (int)$max_salary / 5000;
            $max_salary_interval = 5000 * (int)++$a;
        } else {
            $max_salary_interval = $max_salary;
        }

        if((int)$min_salary % 5000 != 0){
            $a = (int)$min_salary / 5000;
            $min_salary_interval = 5000 * (int)$a;
        } else {
            $min_salary_interval = $min_salary;
        }
        
    } catch (Exception $e) {
        echo $e->getMessage(); 
    }