<?php 
    include('scripts/get_vacancies.php');
    if(isset($is_error)){
        echo $error;
    } else if(!isset($is_result)) : ?>
        <h2>Вакансий нет</h2>
    <?php else : 
        foreach($result as $res) :?>
            <article class='vacancy'>
                    <header>
                        <div class="top">
                            <div class='title'>
                                <a href='vacancy.php?id=<?=$res->id?>'><?=$res->vacancy?></a>
                            </div>
                            <div class='salary'>
                                <?=$res->salary_min?><?=(!empty($res->salary_max)) ? "-".$res->salary_max : ""?>р.
                            </div>
                        </div>
                        <div class="bottom">
                            <div>
                                в компанию <span class="company">"<?=$res->company?>"</span>
                            </div>
                            <div>
                                график: <span class="emp"><?=$res->schedule_name?></span>
                            </div>
                        </div>
                    </header>
                    <p>
                        <span class="dem">Требования: </span><?=$res->demands?>
                    </p>
                    <footer>
                        <div>
                            <?=$res->location?>
                        </div>
                        <div>
                            <?=date("d.m.Y H:i:s", strtotime($res->date));?>
                        </div>
                    </footer>
            </article>
        <?php endforeach; 
    endif ?>