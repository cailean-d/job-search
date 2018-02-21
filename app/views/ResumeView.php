<?php if(empty($resume->getId())) : ?>


    <div class="mx-auto w-100">


        <?php if($user['id'] == $router['id']) : ?>


            <div class="alert alert-info" role="alert">
                <strong>Вы еще не заполнили резюме.</strong>
            </div>
            <a class="btn btn-outline-primary btn-lg btn-block" href="resume/add" role="button">
                Заполнить резюме
            </a>


        <? else : ?>


            <div class="alert alert-info" role="alert">
                <strong>Пользователь еще не создал резюме.</strong>
            </div>


        <? endif ?>
    </div>


<?php else : ?>


    <div class="mx-auto d-flex w-100 <?php if($user['id'] != $router['id']){echo 'justify-content-center';}?>">
        <div class="col-9 mb-4">
            <div class="card">
                <div class="card-block bg-faded">
                    <div class="d-flex">
                        <div class="avatar pl-0 col-4 minw-30">
                            <img src="<?

                            if(!empty($avatar->getSource())){

                                echo $avatar->getSource();

                            } else {

                                echo '/../../../public/images/user.jpg';
                                
                            }


                            ?>" alt="" class="img-thumbnail rounded" draggable="false">
                        </div>
                        <div class="info pl-2 pr-0">
                            <h4>Личная информация</h4>
                            <table class="table resume-info">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="text-muted" style="min-width: 150px">Ф.И.О.</th>
                                        <td>
                                            <?=$resume_user->getLastname()?> 
                                            <?=$resume_user->getFirstname()?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Пол</th>
                                        <td><?=$resume_user->getGender()?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Дата рождения</th>
                                        <td><?=$resume->getBirthday()?> г.</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Город</th>
                                        <td><?=$resume->getCity()?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4>Контактная информация</h4>
                        <table class="table resume-info">
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-muted w-35">Телефон</th>
                                    <td><?=$resume->getPhone()?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-muted">Email</th>
                                    <td><?=$resume->getEmail()?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <h4>Желаемая работа</h4>
                        <table class="table resume-info">
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-muted w-35">Должность</th>
                                    <td><?=$resume->getPost()?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-muted">Отрасль</th>
                                    <td><?=$resume->getIndustryName()?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-muted">График работы</th>
                                    <td><?=$resume->getScheduleName()?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-muted">Зарплата</th>
                                    <td><?= number_format($resume->getSalary(), 0, ',', ' ')?> р.</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-muted">Место работы</th>
                                    <td><?=$resume->getWorkPlaceName()?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php foreach ($education as $key => $edu) : ?>
                        <div class="mt-4">
                            <h4>Образование №<?=$key+1?></h4>
                            <table class="table resume-info">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="text-muted w-35">Уровень образования</th>
                                        <td><?=$edu->getLevelName()?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Учебное заведение</th>
                                        <td><?=$edu->getInstitute()?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Город</th>
                                        <td><?=$edu->getCity()?></td>
                                    </tr>
                                    <?php if(!empty($edu->getFaculty())) : ?>
                                    <tr>
                                        <th scope="row" class="text-muted">Факультет</th>
                                        <td><?=$edu->getFaculty()?></td>
                                    </tr>
                                    <?php endif ?>
                                    <tr>
                                        <th scope="row" class="text-muted">Период учебы</th>
                                        <td><?=$edu->getStudyPeriod()?> гг.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach ?>
                    <?php foreach ($experience as $key => $exp) : ?>
                        <div class="mt-4">
                            <h4>Опыт работы №<?=$key+1?></h4>
                            <table class="table resume-info">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="text-muted w-35">Должность</th>
                                        <td><?=$exp->getPost()?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Компания</th>
                                        <td><?=$exp->getCompany()?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Город</th>
                                        <td><?=$exp->getCity()?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Отрасль</th>
                                        <td><?=$exp->getIndustryName()?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Период работы</th>
                                        <td><?=$exp->getWorkPeriod()?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Функции</th>
                                        <td><?=$exp->getFunctions()?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach ?>
                    <div class="mt-4">
                        <h4>Дополнительная информация</h4>
                        <table class="table resume-info">
                            <tbody>
                                <?php if(!empty($language)) : ?>
                                <tr>
                                    <th scope="row" class="text-muted">Владение языками</th>
                                    <td><?=$language?></td>
                                </tr>
                                <?php endif ?>
                                <?php if(!empty($resume->getCompSkillName())) :?>
                                    <tr>
                                        <th scope="row" class="text-muted w-35">Владение компьютером</th>
                                        <td><?=$resume->getCompSkillName()?></td>
                                    </tr>
                                <?php endif ?>
                                <?php if(!empty($resume->getCar())) : ?>
                                    <tr>
                                        <th scope="row" class="text-muted">Наличие автомобиля</th>
                                        <td><?=$resume->getCar()?></td>
                                    </tr>
                                <?php endif ?>
                                <?php if(!empty($resume->getCourses())) :?>
                                    <tr>
                                        <th scope="row" class="text-muted">Навыки</th>
                                        <td><?=$resume->getCourses()?></td>
                                    </tr>
                                <?php endif ?>
                                <?php if(!empty($resume->getSkills())) :?>
                                    <tr>
                                        <th scope="row" class="text-muted">Пройденные курсы</th>
                                        <td><?=$resume->getSkills()?></td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <?php if($user['id'] == $router['id']) : ?>


            <div class="col-3">
                <a class="btn btn-primary btn-lg btn-block" href="resume/edit" role="button">
                    Редактировать
                </a>
                <a class="btn btn-outline-primary btn-lg btn-block" href="#" role="button" id="delete_resume">
                    Удалить
                </a>
            </div>


        <? endif ?>
    </div>
<?php endif ?>
