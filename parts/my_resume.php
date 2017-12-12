<?php include('scripts/get_filter_data.php'); ?>

<?php if($_GET['page'] === "add") : ?>
    <div class="container">
        <div class="modal-disable"></div>
        <div class="row ml-0 mr-0">
            <nav class="nav nav-tabs list-group col-3" role="tablist">
                <a class="list-group-item list-group-item-action active" href="#uinfo" role="tab" data-toggle="tab">
                    Личная информация
                </a>
                <a class="list-group-item list-group-item-action" href="#post" role="tab" data-toggle="tab">
                    Должность
                </a>
                <a class="list-group-item list-group-item-action" href="#exp" role="tab" data-toggle="tab">
                    Опыт работы
                </a>
                <a class="list-group-item list-group-item-action" href="#edu" role="tab" data-toggle="tab">
                    Образование
                </a>
                <a class="list-group-item list-group-item-action" href="#lang" role="tab" data-toggle="tab">
                    Владение языками
                </a>
                <a class="list-group-item list-group-item-action" href="#add" role="tab" data-toggle="tab">
                    Дополнительная информация
                </a>
            </nav>
            <form action="" class="col-9 pr-0" id="resume">
                <div class="tab-content">
                    <div role="tabpanel" class="card card-block bg-faded tab-pane fade show active" id="uinfo">
                        <div class="group d-inline-block d-flex justify-content-center">
                            <label for="avatar" style="cursor: pointer;">
                                <img src="../images/user.jpg" alt="avatar" title="загрузить фото" class="img-thumbnail rounded" style="width: 200px; height: auto" id="avatar_img">
                            </label>
                            <input type="file" name="avatar" id="avatar" hidden><br>
                        </div>
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label for="lastname" class="d-block text-center">Фамилия :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">@</div>
                                <input name="lastname" type="text" class="form-control" id="lastname">
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label for="firstname" class="d-block text-center">Имя :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">@</div>
                                <input name="firstname" type="text" class="form-control" id="firstname">
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label for="patronymic" class="d-block text-center">Отчество :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">@</div>
                                <input name="patronymic" type="text" class="form-control" id="patronymic">
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label class="d-block text-center">Пол :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">@</div>
                                <select class="form-control custom-select" name="gender">
                                    <option value="Мужской">Мужской</option>
                                    <option value="Женский">Женский</option>
                                </select>
                            </div>
                        </div>
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label for="birth_input" class="d-block text-center">Дата рождения :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">@</div>
                                <input name="birth" type="text" class="form-control datepicker-here" id="birth_input">
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label for="city" class="d-block text-center">Город :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">@</div>
                                <input name="city" type="text" class="form-control" id="city">
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label for="phone" class="d-block text-center">Телефон :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">@</div>
                                <input name="phone" type="text" class="form-control" id="phone">
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label for="email" class="d-block text-center">Почта :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">@</div>
                                <input name="email" type="text" class="form-control" id="email">
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                    </div>
                    <div role="tabpanel" class="card card-block bg-faded tab-pane fade" id="post" style="min-height: 500px;">
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label for="post_input" class="d-block text-center">Должность :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">@</div>
                                <input name="post" type="text" class="form-control" id="post_input">
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label class="d-block text-center">Отрасль :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">@</div>
                                <select class="form-control custom-select" name="industry">
                                    <?php foreach($industry as $res) :?>
                                        <option value="<?=$res['id']?>"><?=$res['industry_name']?></option>
                                    <? endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label class="d-block text-center">График работы :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">@</div>
                                <select class="form-control custom-select" name="schedule">
                                <?php foreach($schedule as $res): ?>
                                    <option value=<?=$res['id']?>><?=$res['schedule_name']?></option>
                                <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label for="salary_input" class="d-block text-center">Желаемый доход (рублей):</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">@</div>
                                <input name="salary" type="text" class="form-control" id="salary_input">
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label class="d-block text-center">Желаемое место работы :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">@</div>
                                <select class="form-control custom-select" name="work_place">
                                    <?php foreach($work_place as $res): ?>
                                        <option value=<?=$res['id']?>><?=$res['work_place_name']?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="card card-block bg-faded tab-pane fade" id="exp" style="min-height: 500px;">
                        <div class="exp_group">
                            <div id="exp_block">
                                <div class="group col-10 pl-0 pr-0 mx-auto hide_exp_block">
                                    <button class="btn btn-outline-primary btn-lg btn-block mt-4 mb-4" role="button" id="remove_exp">
                                        Без опыта работы
                                    </button>
                                </div>
                                <div class="completed_exp_forms col-10 pl-0 pr-0 mx-auto">
                                </div>
                                <div class="group col-10 pl-0 pr-0 mx-auto">
                                    <label for="exp_post_input" class="d-block text-center">Должность :</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-addon">@</div>
                                        <input name="exp_post" type="text" class="form-control" id="exp_post_input">
                                    </div>
                                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                                </div>
                                <div class="group col-10 pl-0 pr-0 mx-auto">
                                    <label for="exp_company_input" class="d-block text-center">Компания :</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-addon">@</div>
                                        <input name="exp_company" type="text" class="form-control" id="exp_company_input">
                                    </div>
                                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                                </div>
                                <div class="group col-10 pl-0 pr-0 mx-auto">
                                    <label for="exp_city_input" class="d-block text-center">Город :</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-addon">@</div>
                                        <input name="exp_city" type="text" class="form-control" id="exp_city_input">
                                    </div>
                                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                                </div>
                                <div class="group col-10 pl-0 pr-0 mx-auto">
                                    <label class="d-block text-center">Отрасль :</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-addon">@</div>
                                        <select class="form-control custom-select" name="exp_industry">
                                            <?php foreach($industry as $res) :?>
                                                <option value="<?=$res['id']?>"><?=$res['industry_name']?></option>
                                            <? endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="group col-10 pl-0 pr-0 mx-auto">
                                    <label for="work_period_input" class="d-block text-center">Период работы :</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-addon">@</div>
                                        <input name="work_period" type="text" class="form-control datepicker-here" id="work_period_input" 
                                        data-min-view="months"
                                        data-view="months"
                                        data-date-format="MM yyyy"
                                        data-range="true" 
                                        data-multiple-dates-separator=" - ">
                                    </div>
                                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                                </div>
                                <div class="group col-10 pl-0 pr-0 mx-auto">
                                    <label for="exp_func_input" class="d-block text-center">Обязанности и функции :</label>
                                    <div class="input-group mb-2">
                                        <textarea name="exp_func" id="exp_func_input" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                                </div>
                                <div class="group col-10 pl-0 pr-0 mx-auto">
                                    <button class="btn btn-outline-primary btn-lg btn-block mt-4" role="button" id="add_exp">
                                        Добавить место работы
                                    </button>
                                </div>
                            </div>
                            <div class="no_exp_block hidden-xl-down col-10 pl-0 pr-0 mx-auto mt-4">
                                <div class="alert alert-info" role="alert">
                                    <strong class="d-block text-center">У Вас нет опыта работы.</strong> 
                                </div>
                                <div class="pl-0 pr-0 mx-auto">
                                    <button class="btn btn-outline-primary btn-lg btn-block mt-4 mb-4" role="button" id="restore_exp">
                                        Вернуть форму
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="card card-block bg-faded tab-pane fade" id="edu" style="min-height: 500px;">
                    <div class="edu_group">
                            <div class="completed_edu_forms col-10 pl-0 pr-0 mx-auto">
                            </div>
                            <div class="group col-10 pl-0 pr-0 mx-auto">
                                <label class="d-block text-center">Уровень образования :</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-addon">@</div>
                                    <select class="form-control custom-select" name="edu_level">
                                        <?php foreach($education as $res) :?>
                                            <option value="<?=$res['id']?>"><?=$res['education_name']?></option>
                                        <? endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="group col-10 pl-0 pr-0 mx-auto">
                                <label for="edu_inst_input" class="d-block text-center">Учебное заведение :</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-addon">@</div>
                                    <input name="edu_inst" type="text" class="form-control" id="edu_inst_input">
                                </div>
                                <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                            </div>
                            <div class="group col-10 pl-0 pr-0 mx-auto">
                                <label for="edu_city" class="d-block text-center">Город :</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-addon">@</div>
                                    <input name="edu_city" type="text" class="form-control" id="edu_city">
                                </div>
                                <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                            </div>
                            <div class="group col-10 pl-0 pr-0 mx-auto edu_facult">
                                <label for="edu_fac_input" class="d-block text-center">Факультет, специальность :</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-addon">@</div>
                                    <input name="edu_fac" type="text" class="form-control" id="edu_fac_input">
                                </div>
                                <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                            </div>
                            <div class="group col-10 pl-0 pr-0 mx-auto">
                                <label for="edu_period_input" class="d-block text-center">Период учебы :</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-addon">@</div>
                                    <input name="edu_period" type="text" class="form-control datepicker-here" id="edu_period_input" 
                                    data-min-view="years"
                                    data-view="years"
                                    data-date-format="yyyy"
                                    data-range="true" 
                                    data-multiple-dates-separator=" - ">
                                </div>
                                <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                            </div>
                            <div class="group col-10 pl-0 pr-0 mx-auto">
                                <button class="btn btn-outline-primary btn-lg btn-block mt-4" role="button" id="add_edu">
                                    Добавить место учебы
                                </button>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="card card-block bg-faded tab-pane fade" id="lang" style="min-height: 500px;">
                        <div class="lang_block"></div>
                        <div class="add_lang">
                            <div class="group col-10 pl-0 pr-0 mx-auto">
                                <label class="d-block text-center">Языки :</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-addon">@</div>
                                    <select class="form-control custom-select" name="lang_list">
                                        <?php foreach($languages as $res) :?>
                                            <option value="<?=$res['id']?>"><?=$res['lang_name']?></option>
                                        <? endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="group col-10 pl-0 pr-0 mx-auto">
                                <button class="btn btn-outline-primary btn-lg btn-block mt-4 mb-4" role="button" id="add_lang">
                                    Добавить язык
                                </button>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="card card-block bg-faded tab-pane fade" id="add">
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label class="d-block text-center">Владение компьютером :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">@</div>
                                <select class="form-control custom-select" name="comp_skills">
                                        <option value=""></option>
                                    <?php foreach($comp_skills as $res) :?>
                                        <option value="<?=$res['id']?>"><?=$res['cs_name']?></option>
                                    <? endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label class="d-block text-center">Наличие авто :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">@</div>
                                <select class="form-control custom-select" name="add_auto_exist">
                                    <option value=""></option>
                                    <option value="Нет">Нет</option>
                                    <option value="Да">Да</option>
                                </select>
                            </div>
                        </div>
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label for="add_couses_input" class="d-block text-center">Курсы и тренинги :</label>
                            <div class="input-group mb-2">
                                <textarea name="add_courses" id="add_courses_input" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                        <div class="group col-10 pl-0 pr-0 mx-auto">
                            <label for="add_skills_input" class="d-block text-center">Навыки и умения :</label>
                            <div class="input-group mb-2">
                                <textarea name="add_skills" id="add_skills_input" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                    </div>
                </div>
                <input type="submit" id="sub_form" hidden>
            </form>
        </div>
        <label for="sub_form" class="btn btn-outline-primary btn-lg btn-block mt-4 mb-5" role="button" id="send_form">
                Отправить
        </label>
    </div>
<?php else : ?>
    <?php if(!isset($is_result)) : ?>
        <div class="mx-auto">
            <div class="alert alert-info" role="alert">
                <strong>Вы еще не заполнили резюме.</strong>
            </div>
            <a class="btn btn-outline-primary btn-lg btn-block" href="resume.php?page=add" role="button">
                Заполнить резюме
            </a>
        </div>
    <?php else : ?>
    <?php include('scripts/get_resume_secondary_data.php'); ?>
        <div class="mx-auto d-flex">
            <div class="col-8 mb-4">
                <div class="card">
                    <div class="card-block bg-faded">
                        <div class="d-flex">
                            <div class="avatar col-4 pl-0">
                                <img src="../<?=$avatar_data['source']?>" alt="" class="img-thumbnail rounded">
                            </div>
                            <div class="info col-8 pr-0">
                                <h4>Личная информация</h4>
                                <table class="table resume-info">
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="text-muted">Ф.И.О.</th>
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
                                    <tr>
                                        <th scope="row" class="text-muted">Владение языками</th>
                                        <td><?=$langs?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted w-35">Владение компьютером</th>
                                        <td><?=$resume_data['cs_name']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Наличие автомобиля</th>
                                        <td><?=$resume_data['car']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Пройденные курсы</th>
                                        <td><?=$resume_data['courses']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-muted">Навыки</th>
                                        <td><?=$resume_data['skills']?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <a class="btn btn-primary btn-lg btn-block" href="resume.php?page=edit" role="button">
                    Редактировать резюме
                </a>
                <a class="btn btn-outline-primary btn-lg btn-block" href="#" role="button" id="delete_resume">
                    Удалить резюме
                </a>
            </div>
        </div>
    <?php endif ?>
<?php endif ?>




<!-- Modal Alert -->
<div class="modal fade ns" id="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alert</h5>
        <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary hand btn-close" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Confirm -->
<div class="modal fade ns" id="confirm">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary hand option1">Закрыть</button>
        <button type="button" class="btn btn-outline-primary hand option2">Закрыть</button>
      </div>
    </div>
  </div>
</div>


<!-- 
                                    <div class="card mb-4" style="font-size: 14px;">
                                        <div class="card-block">
                                            <h3 class="card-title">Парикмахер</h3>
                                            <div class="card-text mb-2">
                                                <div class="d-flex justify-content-between">
                                                    <div class="left d-flex">
                                                        <div class="company mr-2 text-muted">
                                                            ООО Васи Пупкина
                                                        </div>
                                                        <div class="city text-muted">
                                                            Архангельск
                                                        </div>
                                                    </div>
                                                    <div class="right text-muted">
                                                        Май 2017 - Июнь 2017
                                                    </div>
                                                </div>
                                                <div class="text-muted">
                                                    Отрасль
                                                </div>
                                                <div>
                                                    Описание
                                                </div>
                                            </div>
                                            <button href="#" class="btn btn-primary">
                                                Редактировать
                                            </button>
                                            <button href="#" class="btn btn-secondary">
                                                Удалить
                                            </button>
                                        </div>
                                    </div> -->


    <!-- <div class="d-flex col-10 pl-0 pr-0 mx-auto">
        <div class="group col-11">
            <div class="form-group row">
                <div class="hidden-xl-down lang_id">1</div>
                <label class="col-3 col-form-label">Английский</label>
                <div class="col-9">
                    <select class="form-control custom-select" name="lang">
                            <option value="Не владею">Не владею</option>
                            <option value="Базовый">Базовый</option>
                            <option value="Технический">Технический</option>
                            <option value="Разговорный">Разговорный</option>
                            <option value="Свободно владею">Свободно владею</option>
                    </select>
                </div>
            </div>
        </div>
        <a class="btn btn-outline-primary col-1 delete_lang" href="#" role="button" style="height: 37px; padding: .5rem .3rem;">&#151;</a>
    </div> -->