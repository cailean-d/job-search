<?php 
    function draw_vacancies($vacancies){
        while($res = $vacancies->fetch(PDO::FETCH_BOTH)) :?>
            <article class='vacancy'>
                    <header>
                        <div class="top">
                            <div class='title'>
                                <a href='vacancy.php?id=<?=$res['id']?>'><?=$res['vacancy']?></a>
                            </div>
                            <div class='salary'>
                                <?=$res['salary_min']?><?=(!empty($res['salary_max'])) ? "-".$res['salary_max'] : ""?>р.
                            </div>
                        </div>
                        <div class="bottom">
                            <div>
                                в компанию <span class="company">"<?=$res['company']?>"</span>
                            </div>
                            <div>
                                график: <span class="emp"><?=$res['schedule_name']?></span>
                            </div>
                        </div>
                    </header>
                    <p>
                        <span class="dem">Требования: </span><?=$res['demands']?>
                    </p>
                    <footer>
                        <div>
                            <?=$res['location']?>
                        </div>
                        <div>
                            <?=date("d.m.Y H:i:s", strtotime($res['date']));?>
                        </div>
                    </footer>
            </article>
        <?php endwhile; 
    }

    $db = new PDO('mysql:host=localhost;dbname=job;charset=utf8', 'root', '');

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
        INNER JOIN schedule ON vacancies.schedule = schedule.id
        WHERE status="1"
        '.$salary.'
        '.$industry.'
        '.$location.'
        '.$time.'
        '.$schedule.'
        '.$query.'
        ORDER BY '.$sort.' DESC
    ';
    
    $result = $db->prepare($sql);
    $result->execute();
    
    $error = $result->errorInfo();
    
    if($error && $error[0] != 00000){
        var_dump($error);
    } else {
        if($result->rowCount() > 0){
            draw_vacancies($result);
        } else {
            echo "<h2>Вакансий нет</h2>";
        }
    }
?>