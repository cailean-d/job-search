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
                                график: <span class="emp"><?=$res['schedule']?></span>
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
                            <?=date("Y.m.d H:i:s", strtotime($res['date']));?>
                        </div>
                    </footer>
            </article>
        <?php endwhile; 
    }

    $db = new PDO('mysql:host=localhost;dbname=job;charset=utf8', 'root', '');

    if(!isset($_GET['query'])){

        if($_GET['sort'] && $_GET['sort'] == 'salary'){
            $sort = 'salary_min';
        } else {
            $sort = 'date';
        }
        
        $result = $db->query("SELECT * FROM `vacancies` WHERE status='1' ORDER BY `".$sort."` DESC");
        
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
    } else {
        $query = $_GET['query'];

        $result = $db->query("SELECT * FROM `vacancies` WHERE status='1' AND vacancy LIKE '%".$query."%' OR `description` LIKE '%".$query."%'");

        if($result->rowCount() > 0){
            draw_vacancies($result);
        } else {
            echo "<h2>Ничего не найдено по запросу \"".$query."\"!</h2>";
        }
    }
?>