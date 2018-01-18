<?php include('scripts/read/get_resume.php'); ?>

<?php if(!isset($is_result)) : ?>
    <div class="mx-auto">
        <?php if($_SESSION['id'] == $id) : ?>
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
    <?php include('scripts/read/get_resume_secondary_data.php'); ?>
    <div class="mx-auto d-flex <?php if($_SESSION['id'] != $id){echo 'justify-content-center';} ?>">
        <div class="col-9 mb-4">
            <div class="card">
                <div class="card-block bg-faded">
                    <div class="d-flex">
                        <div class="avatar pl-0 col-4 minw-30">
                            <img src="../<?=$avatar_data['source']?>" alt="" class="img-thumbnail rounded">
                        </div>
                        <div class="info pl-2 pr-0">
                            <h4>Личная информация</h4>
                            <table class="table resume-info">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="text-muted w-35">Ф.И.О.</th>
                                        <td>
                                            <?=$resume_data['lastname']?> 
                                            <?=$resume_data['firstname']?> 
                                            <?=$resume_data['patronymic']?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Пол</th>
                                        <td><?=$resume_data['gender']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Дата рождения</th>
                                        <td><?=$resume_data['birthday']?> г.</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Город</th>
                                        <td><?=$resume_data['city']?></td>
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
                                    <td><?=$resume_data['phone']?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-muted">Email</th>
                                    <td><?=$resume_data['email']?></td>
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
                                    <td><?=$resume_data['post']?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-muted">Отрасль</th>
                                    <td><?=$resume_data['industry_name']?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-muted">График работы</th>
                                    <td><?=$resume_data['schedule_name']?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-muted">Зарплата</th>
                                    <td><?= number_format($resume_data['salary'], 0, ',', ' ')?> р.</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-muted">Место работы</th>
                                    <td><?=$resume_data['work_place_name']?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php foreach ($education_data as $key => $edu) : ?>
                        <div class="mt-4">
                            <h4>Образование #<?=$key+1?></h4>
                            <table class="table resume-info">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="text-muted w-35">Уровень образования</th>
                                        <td><?=$edu['education_name']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Учебное заведение</th>
                                        <td><?=$edu['inst']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Город</th>
                                        <td><?=$edu['city']?></td>
                                    </tr>
                                    <?php if(!empty($edu['faculty'])) : ?>
                                    <tr>
                                        <th scope="row" class="text-muted">Факультет</th>
                                        <td><?=$edu['faculty']?></td>
                                    </tr>
                                    <?php endif ?>
                                    <tr>
                                        <th scope="row" class="text-muted">Период учебы</th>
                                        <td><?=$edu['study_period']?> гг.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach ?>
                    <?php foreach ($experience_data as $key => $exp) : ?>
                        <div class="mt-4">
                            <h4>Опыт работы #<?=$key+1?></h4>
                            <table class="table resume-info">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="text-muted w-35">Должность</th>
                                        <td><?=$exp['post']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Компания</th>
                                        <td><?=$exp['company']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Город</th>
                                        <td><?=$exp['city']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Отрасль</th>
                                        <td><?=$exp['industry_name']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Период работы</th>
                                        <td><?=$exp['work_period']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Функции</th>
                                        <td><?=$exp['functions']?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach ?>
                    <div class="mt-4">
                        <h4>Дополнительная информация</h4>
                        <table class="table resume-info">
                            <tbody>
                                <?php if(!empty($langs)) : ?>
                                <tr>
                                    <th scope="row" class="text-muted">Владение языками</th>
                                    <td><?=$langs?></td>
                                </tr>
                                <?php endif ?>
                                <?php if(!empty($resume_data['cs_name'])) :?>
                                    <tr>
                                        <th scope="row" class="text-muted w-35">Владение компьютером</th>
                                        <td><?=$resume_data['cs_name']?></td>
                                    </tr>
                                <?php endif ?>
                                <?php if(!empty($resume_data['car'])) : ?>
                                    <tr>
                                        <th scope="row" class="text-muted">Наличие автомобиля</th>
                                        <td><?=$resume_data['car']?></td>
                                    </tr>
                                <?php endif ?>
                                <?php if(!empty($resume_data['courses'])) :?>
                                    <tr>
                                        <th scope="row" class="text-muted">Навыки</th>
                                        <td><?=$resume_data['courses']?></td>
                                    </tr>
                                <?php endif ?>
                                <?php if(!empty($resume_data['skills'])) :?>
                                    <tr>
                                        <th scope="row" class="text-muted">Пройденные курсы</th>
                                        <td><?=$resume_data['skills']?></td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php if($_SESSION['id'] == $id) : ?>
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