<?php
    try {

        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $db = new PDO('mysql:host=localhost;dbname=job;charset=utf8','root','', $options);
        
    } catch (PDOException $e) {
        
        http_response_code(400);
        echo "Error!: " . $e->getMessage() . "<br/>";
        die();
    }