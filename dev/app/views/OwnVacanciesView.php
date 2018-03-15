<main>
<?php 
    if(count($vacancy) == 0) : ?>
        <div class="alert alert-info" role="alert">
            <strong>Вакансий нет.</strong>
        </div>
    <?php else : 
        foreach($vacancy as $res) :?>
            <div class="card mb-4 col-10 vacancyz mx-auto">
                <div class="id" hidden="hidden"><?=$res->getId()?></div> 
                <div class="card-block">
                    <article class='vacancy'>
                        <header>
                            <div class="top">
                                <div class='title' style="display: flex; justify-content: space-between;">
                                    <a href='vacancy/<?=$res->getId()?>'><?=$res->getVacancyName()?></a>
                                    <?php if ($res->getStatus() == '1') : ?>
                                        <div class="bg-success text-white" style="margin-left: 1rem; padding: 0.1rem 0.5rem; border-radius: 4px;">
                                            Размещено
                                        </div>
                                    <?php elseif ($res->getStatus() == '0' && !empty($res->getMistake())) : ?>
                                        <div class="bg-danger text-white" style="margin-left: 1rem; padding: 0.1rem 0.5rem; border-radius: 4px;">
                                            Исправьте ошибки
                                        </div>
                                    <?php elseif ($res->getStatus() == '0') : ?>
                                        <div class="bg-warning text-white" style="margin-left: 1rem; padding: 0.1rem 0.5rem; border-radius: 4px;">
                                            Обрабатывается
                                        </div>
                                    <?php endif ?>
                                </div>
                                <div class='salary'>
                                    <span>
                                        <?=
                                        
                                        $res->getSalaryMin()?>
                                        
                                        <?

                                        if(!empty($res->getSalaryMax())){

                                            echo "-".$res->getSalaryMax();

                                        } else {

                                            echo "";

                                        }
                                        
                                        ?>р.
                                    </span>
                                </div>
                            </div>
                            <div class="bottom">
                                <div>
                                    в компанию <span class="company">"<?=$res->getCompany()?>"</span>
                                </div>
                                <div>
                                    график: <span class="emp"><?=mb_strtolower($res->getScheduleName(), "UTF-8")?></span>
                                </div>
                            </div>
                        </header>
                        <p>
                            <span class="dem">Требования: </span><?=str_replace(",", ", ", mb_strtolower($res->getDemands(), 'UTF-8'))?>
                        </p>
                        <footer>
                            <div>
                                <?=$res->getLocation()?>
                            </div>
                            <div>
                                <?=date("d.m.Y H:i:s", strtotime($res->getDate()));?>
                            </div>
                        </footer>
                    </article>
                </div>
                <div class="edit-buttons">
                    <a class="btn btn-primary btn-block" role="button" href="vacancy/edit/<?=$res->getId()?>">
                        Редактировать
                    </a>
                    <a class="btn btn-outline-primary btn-block del" role="button" href="#">
                        Удалить
                    </a>
                </div>
            </div>
        <?php endforeach; 
    endif ?>
</main>