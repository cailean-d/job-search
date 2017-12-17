<?php
    try{
        include("db_connection.php");

        if($_GET['page'] === "add" || $_GET['page'] === "edit"){
            $id = $_SESSION['id'];
        } else if(!empty(isset($_GET['id']))){
            $id = $_GET['id'];
        } else {
            $id = $_SESSION['id'];
        }

        $sql = "
            SELECT 
            user_resume.*,
            schedule.schedule_name,
            industry.industry_name,
            work_place.work_place_name,
            comp_skills.cs_name
            FROM user_resume 
            INNER JOIN schedule ON user_resume.schedule_id = schedule.id
            INNER JOIN industry ON user_resume.industry_id = industry.id 
            INNER JOIN work_place ON user_resume.work_place_id = work_place.id 
            INNER JOIN comp_skills ON user_resume.comp_skill_id = comp_skills.id 
            WHERE user_id =" . $id;

        $resume_data = $db->prepare($sql);
        $resume_data->execute();

        $error = $resume_data->errorInfo();

        if($error && $error[0] != 00000){
            die($error);
        } else {
            $resume_data = $resume_data->fetch(PDO::FETCH_BOTH);
            if($resume_data && count($resume_data) > 0){
                $is_result = true;
            }
        }

    } catch (Exception $e) {
        echo $e->getMessage(); 
    }