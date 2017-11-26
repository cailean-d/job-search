<?php
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=job;charset=utf8', 
            'root', 
            '', 
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br/>";
        die();
    }