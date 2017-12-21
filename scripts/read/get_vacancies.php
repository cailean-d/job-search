<?php
    try {
        // $start = microtime(true); 
        
        // include('redis_connection.php');
        
        $sort = 'date';
        $salary = '';
        $industry = '';
        $location = '';
        $time = '';
        $schedule = '';        
        $query = '';
    
    
        if($_GET['sort'] && $_GET['sort'] == 'salary'){
            $sort = 'salary_min';
        } 
    
        if($_GET['time']){
            if($_GET['time'] == '1'){
                $time = ' AND date >= ( CURDATE() - INTERVAL 1 DAY )';
            } else if($_GET['time'] == '3'){
                $time = ' AND date >= ( CURDATE() - INTERVAL 3 DAY )';
            } else if($_GET['time'] == '7'){
                $time = ' AND date >= ( CURDATE() - INTERVAL 7 DAY )';
            } else if($_GET['time'] == '30'){
                $time = ' AND date >= ( CURDATE() - INTERVAL 30 DAY )';
            } else {
                $time =  '';
            }
        }
    
        if($_GET['salary']){
            if($_GET['salary'] == '-1'){
                $salary = '';
            } else{
                $salary = ' AND `salary_min` >='.$_GET['salary'];
            } 
        }
    
        if($_GET['industry']){
            if($_GET['industry'] == '-1'){
                $industry = '';
            } else{
                $industry = ' AND `industry`='.$_GET['industry'];
            } 
        }
    
        if($_GET['schedule']){
            if($_GET['schedule'] == '-1'){
                $schedule = '';
            } else{
                $schedule = ' AND `schedule`='.$_GET['schedule'];
            } 
        }
    
        if($_GET['location']){
            if($_GET['location'] == '-1'){
                $location = '';
            } else{
                $location = ' AND `location`="'.$_GET['location'].'"';
            } 
        }
    
        if($_GET['query']){
            $query = " AND 
                    `vacancy` LIKE '%".$_GET['query']."%' 
                    OR 
                    `description` LIKE '%".$_GET['query']."%'
                    ";
        }
    
        $sql = '
            SELECT 
            vacancies.*,
            schedule.schedule_name
            FROM `vacancies` 
            LEFT JOIN schedule ON vacancies.schedule = schedule.id
            WHERE status="1"
            '.$salary.'
            '.$industry.'
            '.$location.'
            '.$time.'
            '.$schedule.'
            '.$query.'
            ORDER BY '.$sort.' DESC
        ';

        // $hash = md5($sql);

        // if($result = $redis->hget("vacancies", $hash)){
            
        // } else {
        
            include('scripts/db_connection.php');
            $result = $db->prepare($sql);
            $result->execute();
                
            $error = $result->errorInfo();
        
            if($error && $error[0] != 00000){
                die($error);
            } else {
                $result = $result->fetchAll(PDO::FETCH_BOTH);
                // $redis->hset("vacancies", $hash, $result);
            }
        // }

        // $result = json_decode($result);

        if(count($result) > 0){
            $is_result = true;
        }

        // printf('Скрипт выполнялся %.5F сек.', microtime(true) - $start);

    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br/>";
        die();
    }