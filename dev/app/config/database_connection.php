<?php 

    return array(

        'type' => 'mysql',

        'host' => 'localhost',

        'database_name' => 'job',

        'user' => 'root',

        'password' => '',

        'options' => array(

            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_EMULATE_PREPARES => true
            
        )
    );