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
                                        <div class="bg-success status">
                                            Размещено
                                        </div>
                                    <?php elseif ($res->getStatus() == '0' && !empty($res->getMistake())) : ?>
                                        <button type="button" class="btn btn-danger dropdown-toggle status" data-toggle="collapse" data-target="#mistake" aria-expanded="false">
                                            Исправьте ошибки
                                        </button>
                                    <?php elseif ($res->getStatus() == '0') : ?>
                                        <div class="bg-warning status">
                                            Обрабатывается
                                        </div>
                                    <?php endif ?>
                                </div>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body bg-danger mistakes">
                                        <?=$res->getMistake()?>
                                    </div>
                                </div>
                                <div class='salary'>
                                    <div class="description">
                                        Зарплата: 
                                    </div>
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
                                <div class="company">
                                    <div class="description">
                                        Компания: 
                                    </div>
                                    <span class="company">
                                        "<?=$res->getCompany()?>"
                                    </span>
                                </div>
                                <div class="schedule">
                                    <div class="description">
                                        График:
                                    </div>
                                    <span class="emp">
                                        <?=mb_strtolower($res->getScheduleName(), "UTF-8")?>
                                    </span>
                                </div>
                            </div>
                        </header>
                        <div class="body">
                            <div class="demands">
                                <div class="description">
                                    Требования:
                                </div>
                                <span>
                                    <?=str_replace(",", ", ", mb_strtolower($res->getDemands(), 'UTF-8'))?>
                                </span>
                            </div>
                        </div>
                        <footer>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="text">
                                    <?=$res->getLocation();?>
                                </div>
                            </div>
                            <div class="date">
                                <i class="fas fa-calendar-alt"></i>
                                <div class="text">
                                    <?=date("d.m.Y H:i:s", strtotime($res->getDate()));?>
                                </div>
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