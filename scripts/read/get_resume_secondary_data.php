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

        $sql_avatar = "SELECT * FROM user_avatar WHERE user_id = " . $id;
        $sql_education = "
            SELECT 
            user_education.*,
            education.education_name
            FROM user_education
            LEFT JOIN education ON user_education.level_id = education.id
            WHERE user_id =" . $id;
        $sql_experience = "
            SELECT 
            user_experience.*,
            industry.industry_name
            FROM user_experience
            LEFT JOIN industry ON user_experience.industry_id = industry.id
            WHERE user_id =" . $id;
        $sql_lang = "
            SELECT 
            user_lang_skills.*,
            languages.lang_name
            FROM user_lang_skills
            LEFT JOIN languages ON user_lang_skills.lang_id = languages.id
            WHERE user_id =" . $id;

        $avatar_data = $db->query($sql_avatar);
        $education_data = $db->query($sql_education);
        $experience_data = $db->query($sql_experience);
        $lang_data = $db->query($sql_lang);

        $avatar_data = $avatar_data->fetch();
        $education_data = $education_data->fetchAll();
        $experience_data = $experience_data->fetchAll();
        $lang_data = $lang_data->fetchAll();

        foreach ($lang_data as $value) {
            $langs .= mb_strtolower($value['lang_name']) . " (" . mb_strtolower($value['lang_level'], 'UTF-8') . "), ";
        }

        $langs = substr($langs, 0, -2);

    } catch (Exception $e) {
        echo $e->getMessage(); 
    }