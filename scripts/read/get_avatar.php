<?php
    try{
        include("scripts/db_connection.php");

        $id = $_SESSION['id'];

        $sql_avatar = "SELECT * FROM user_avatar WHERE user_id = " . $id;
        $avatar_data = $db->query($sql_avatar);
        $avatar_data = $avatar_data->fetch();

        if($avatar_data && count($avatar_data) > 0){
            $avatar = $avatar_data['source'];
        } else {
            $avatar = "images/user.jpg";
        }

    } catch (Exception $e) {
        echo $e->getMessage(); 
    }