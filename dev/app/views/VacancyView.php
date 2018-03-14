<main>
    <div class="d-flex justify-content-center">
        <div class="card mb-4 full_vacancy col-11 col-sm-10">
            <div class="vacancy_id" hidden><?=$vacancy->getId()?></div>
            <div class="card-block">
                <div class="header">
                    <div class="d-flex justify-content-between mb-4 wq header__top">
                        <span class="vacancy_name">
                            <?=$vacancy->getVacancyName()?>
                        </span>
                        <span class="company">
                            <?=$vacancy->getCompany() ?>
                        </span>
                    </div>
                    <div class="card header__bottom">
                        <div class="vacancy_info card-block bg-faded">
                            <div class="salary">
                                <div class="header">
                                    Зарплата
                                </div>
                                <div class="body">
                                <?=$vacancy->getSalaryMin()?>
                                <?php
                                
                                    if(!empty($vacancy->getSalaryMax())){

                                        echo "-".$vacancy->getSalaryMax();

                                    } else {

                                        echo "";

                                    }

                                ?>р.
                                </div>
                            </div>
                            <div class="city">
                                <div class="header">
                                    Город
                                </div>
                                <div class="body">
                                    <?=$vacancy->getLocation()?>
                                </div>
                            </div>
                            <div class="exp">
                                <div class="header">
                                    Требуемый опыт работы
                                </div>
                                <div class="body">
                                    <?=$vacancy->getExperience()?> лет.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="primary_info">
                    <?php if(!empty($vacancy->getDescription())) : ?>
                        <div class="description">
                            <?=$vacancy->getDescription()?>
                        </div>
                    <?php endif ?>
                    <div class="conditions">
                        <h4 class="text-muted">Условия</h4>
                        <ul>
                            <?php foreach($conditions as $cond) : ?>
                                <li><?=$cond?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="duties">
                        <h4 class="text-muted">Обязанности</h4>
                        <ul>
                            <?php foreach($duties as $dut) : ?>
                                <li><?=$dut?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="demands">
                        <h4 class="text-muted">Требования</h4>
                        <ul>
                            <?php foreach($demands as $dem) : ?>
                                <li><?=$dem?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                <div class="secondary_info">
                    <div class="schedule">
                        <h4 class="text-muted">Тип занятости</h4>
                        <div>
                            <?=$vacancy->getScheduleName()?>
                        </div>
                    </div>
                    <div class="user_info">
                        <h4 class="text-muted">Контактная информация</h4>
                        <table class="table contact_info">
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-muted">
                                        <?=$vacancy->getSenderName()?>
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-muted">Телефон:</th>
                                    <td><?=$vacancy->getPhone()?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-muted">Почта</th>
                                    <td><?=$vacancy->getEmail()?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="footer">


                    <?php if($user['type'] == '0') : ?>


                        <?php if($isResume === false) : ?>
                            <div class="alert alert-info mb-0" role="alert">
                                <strong>Для того, чтобы оставить резюме, необходимо создать его.</strong>
                            </div>
                        <?php else : ?>


                            <?php if($isResumeSent === false) :?>


                                <button class="btn btn-primary btn-lg btn-block hand" id="send_resume">
                                    Отправить резюме
                                </button>


                            <?php else : ?>


                                <div class="alert alert-info" role="alert">
                                    <strong>Ваше резюме отправлено</strong>
                                </div>
                                <button class="btn btn-primary btn-lg btn-block hand" id="del_resume">
                                    Удалить резюме
                                </button>


                            <?php endif ?>

                            
                        <?php endif ?>


                    <?php endif ?>


                    <?php if($user['type'] == '1') : ?>


                        <?php  if($isResumeEmployed === true) : ?>


                            <?php if(count($users) > 0) : ?>


                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="text-muted mb-4">Оставленные резюме : </h4>
                                        <?php foreach($users as $a) : ?>


                                            <a class="btn btn-outline-primary btn-lg btn-block" href="resume/<?=$a->getUserid()?>" role="button">
                                                <?php
                                                    echo $a->getUserFirstname() . " ";
                                                    echo $a->getUserLastname() . " &lt;";
                                                    echo $a->getUserEmail() . "&gt;";
                                                ?>
                                            </a>

                                            
                                        <?php endforeach ?>
                                    </div>
                                </div>


                            <?php else : ?>

                                <div class="alert alert-info mb-0" role="alert">
                                    <strong>Еще никто не оставил резюме.</strong>
                                </div>
                                
                            <?php endif ?>

                        <?php  endif ?>

                    <?php endif ?>


                    <?php if(!isset($user['authorized'])) :?>


                        <div class="alert alert-info mb-0" role="alert">
                            <strong>Для того, чтобы оставить резюме, зарегистрируйтесь или войдите.</strong>
                        </div>


                    <?php endif ?>
                </div>

                <div class="misc">
                    <div class="resume_count">
                        <div class="description">
                            Оставлено резюме: 
                        </div>
                        <div class="counter">
                            <?=$resume_count?>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                    <div class="views">
                        <div class="description">
                            Просмотров: 
                        </div>
                        <div class="counter">
                            <?=$vacancy->getViews()?>
                        </div>
                        <div class="icon">
                            <i class="fas fa-eye"></i>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</main>