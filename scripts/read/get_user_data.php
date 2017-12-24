<?php
    try{

        if(!isset($_POST['id'])){
            http_response_code(400);
            exit("необходимо -id-");
        }

        include("./scripts/db_connection.php");

        $id = $_POST['id'];

        $sql = "SELECT * FROM users WHERE id = " . $id;
        $user_data = $db->query($sql);
        $user_data = $user_data->fetch();


    } catch (Exception $e) {
        echo $e->getMessage(); 
    }