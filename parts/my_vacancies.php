<?php 
    include('scripts/read/get_my_vacancies.php');
    if(!isset($is_result)) : ?>
        <h2>Вакансий нет</h2>
    <?php else : 
        foreach($result as $res) :?>
            <div class="card mb-4">
                <div class="card-block">
                    <article class='vacancy'>
                        <header>
                            <div class="top">
                                <div class='title'>
                                    <a href='vacancy.php?id=<?=$res['id']?>'><?=$res['vacancy']?></a>
                                </div>
                                <div class='salary'>
                                    <span>
                                        <?=$res['salary_min']?><?=(!empty($res['salary_max'])) ? "-".$res['salary_max'] : ""?>р.
                                    </span>
                                </div>
                            </div>
                            <div class="bottom">
                                <div>
                                    в компанию <span class="company">"<?=$res['company']?>"</span>
                                </div>
                                <div>
                                    график: <span class="emp"><?=mb_strtolower($res['schedule_name'], "UTF-8")?></span>
                                </div>
                            </div>
                        </header>
                        <p>
                            <span class="dem">Требования: </span><?=str_replace(",", ", ", mb_strtolower($res['demands'], 'UTF-8'))?>
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
                </div>
            </div>
        <?php endforeach; 
    endif ?>