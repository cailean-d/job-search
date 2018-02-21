<main>

    <div class="container">

        
        <div class="row ml-0 mr-0">


            <!-- Навигация -->
            <nav class="nav nav-tabs list-group col-3 border-bottom-0" role="tablist">
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


                    <!-- Основная информация -->
                    <div role="tabpanel" class="card card-block bg-faded tab-pane fade show active" id="uinfo" style="min-height: 500px;">
                        <div class="group col-11 pl-0 pr-0 mx-auto">
                            <label for="birth_input" class="d-block text-center">Дата рождения :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon input-type">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <input name="birth" type="text" class="form-control datepicker-here" id="birth_input" <?="value=" . $resume->getBirthday()?>>
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                        <div class="group col-11 pl-0 pr-0 mx-auto">
                            <label for="city" class="d-block text-center">Город :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon input-type">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <input name="city" type="text" class="form-control" id="city" 
                                <?="value=" . $resume->getCity()?>>
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                        <div class="group col-11 pl-0 pr-0 mx-auto">
                            <label for="phone" class="d-block text-center">Телефон :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon input-type">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <input name="phone" type="text" class="form-control" id="phone" 
                                <?="value=" . $resume->getPhone()?>>
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                        <div class="group col-11 pl-0 pr-0 mx-auto">
                            <label for="email" class="d-block text-center">Почта :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon input-type">
                                    <i class="fas fa-at"></i>
                                </div>
                                <input name="email" type="text" class="form-control" id="email" 
                                <?="value=" . $resume->getEmail()?>>
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                    </div>


                    <!-- Должность -->
                    <div role="tabpanel" class="card card-block bg-faded tab-pane fade" id="post" style="min-height: 500px;">
                        <div class="group col-11 pl-0 pr-0 mx-auto">
                            <label for="post_input" class="d-block text-center">Должность :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon input-type">
                                    <i class="fas fa-clipboard"></i>
                                </div>
                                <input name="post" type="text" class="form-control" id="post_input" 
                                <?="value=" . $resume->getPost()?>>
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                        <div class="group col-11 pl-0 pr-0 mx-auto">
                            <label class="d-block text-center">Отрасль :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon input-type">
                                    <i class="fas fa-industry"></i>
                                </div>
                                <select class="form-control custom-select" name="industry">
                                    <?php foreach($industry as $res) :?>
                                        <option value="<?=$res->getId()?>" 
                                        <?php 

                                            if($resume->getIndustryName() == $res->getName()){
                                                
                                                echo "selected";

                                            }

                                        ?>
                                        ><?=$res->getName()?></option>
                                    <? endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="group col-11 pl-0 pr-0 mx-auto">
                            <label class="d-block text-center">График работы :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon input-type">
                                    <i class="fas fa-building"></i>
                                </div>
                                <select class="form-control custom-select" name="schedule">
                                <?php foreach($schedule as $res): ?>
                                    <option value=<?=$res->getId()?> 
                                    <?php 
                                        if($resume->getScheduleName() == $res->getName()){
                                            echo "selected";
                                        }
                                    ?>
                                    ><?=$res->getName()?></option>
                                <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="group col-11 pl-0 pr-0 mx-auto">
                            <label for="salary_input" class="d-block text-center">Желаемый доход (рублей):</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon input-type">
                                    <i class="fas fa-ruble-sign"></i>
                                </div>
                                <input name="salary" type="text" class="form-control" id="salary_input" <?="value=" . $resume->getSalary()?>>
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                        <div class="group col-11 pl-0 pr-0 mx-auto">
                            <label class="d-block text-center">Желаемое место работы :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon input-type">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <select class="form-control custom-select" name="work_place">
                                    <?php foreach($workPlace as $res): ?>
                                        <option value=<?=$res->getId()?> 
                                        <?php 
                                            if($resume->getWorkPlaceName() == $res->getName()){

                                                echo "selected";

                                            }
                                        ?>
                                        ><?=$res->getName()?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <!-- Опыт работы -->
                    <div role="tabpanel" class="card card-block bg-faded tab-pane fade" id="exp" style="min-height: 500px;">
                        <div class="exp_group">
                            <div id="exp_block" 
                                <?php 
                                
                                    if($router['mode'] == "edit" && count($experience) == 0){

                                        echo "class=\"hidden-xl-down\"";

                                    }

                                ?>>
                                <div class="group col-11 pl-0 pr-0 mx-auto hide_exp_block 
                                <?php 
                                
                                    if($router['mode'] == "edit" && count($experience) > 0){

                                        echo "hidden-xl-down";

                                    }

                                ?>">
                                    <button class="btn btn-outline-primary btn-lg btn-block mt-4 mb-4" role="button" id="remove_exp">
                                        Без опыта работы
                                    </button>
                                </div>
                                <div class="completed_exp_forms col-11 pl-0 pr-0 mx-auto">


                                    <?php if ($router['mode'] == "edit")?>
                                    <?php if(count($experience) > 0) :
                                        foreach ($experience as $exp) :?>


                                            <div class="exp_job">
                                                <div hidden class="job_id"><?=$exp->getId()?></div>
                                                <div hidden class="industry_id"><?=$exp->getIndustryId()?></div>
                                                <div class="card mb-4" style="font-size: 14px;">
                                                    <div class="card-block">
                                                        <h3 class="card-title post"><?=$exp->getPost()?></h3>
                                                        <div class="card-text mb-2">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="left d-flex">
                                                                    <div class="company mr-2 text-muted">
                                                                        <?=$exp->getCompany()?>
                                                                    </div>
                                                                    <div class="city text-muted">
                                                                        <?=$exp->getCity()?>
                                                                    </div>
                                                                </div>
                                                                <div class="right text-muted">
                                                                    <?=$exp->getWorkPeriod()?>
                                                                </div>
                                                            </div>
                                                            <div class="text-muted industry">
                                                                <?=$exp->getIndustryName()?>
                                                            </div>
                                                            <div class="func">
                                                                <?=$exp->getFunctions()?>
                                                            </div>
                                                        </div>
                                                        <a href="#" class="btn btn-primary mr-1 edit_job">Редактировать</a>
                                                        <a href="#" class="btn btn-secondary delete_job">Удалить</a>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                    <?php endforeach; endif; ?>
                                </div>
                                <div class="group col-11 pl-0 pr-0 mx-auto">
                                    <label for="exp_post_input" class="d-block text-center">Должность :</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-addon input-type">
                                            <i class="fas fa-clipboard"></i>
                                        </div>
                                        <input name="exp_post" type="text" class="form-control" id="exp_post_input">
                                    </div>
                                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                                </div>
                                <div class="group col-11 pl-0 pr-0 mx-auto">
                                    <label for="exp_company_input" class="d-block text-center">Компания :</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-addon input-type">
                                            <i class="fas fa-building"></i>
                                        </div>
                                        <input name="exp_company" type="text" class="form-control" id="exp_company_input">
                                    </div>
                                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                                </div>
                                <div class="group col-11 pl-0 pr-0 mx-auto">
                                    <label for="exp_city_input" class="d-block text-center">Город :</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-addon input-type">
                                            <i class="fas fa-globe"></i>
                                        </div>
                                        <input name="exp_city" type="text" class="form-control" id="exp_city_input">
                                    </div>
                                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                                </div>
                                <div class="group col-11 pl-0 pr-0 mx-auto">
                                    <label class="d-block text-center">Отрасль :</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-addon input-type">
                                            <i class="fas fa-industry"></i>
                                        </div>
                                        <select class="form-control custom-select" name="exp_industry">
                                            <?php foreach($industry as $res) :?>
                                                <option value="<?=$res->getId()?>"><?=$res->getName()?></option>
                                            <? endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="group col-11 pl-0 pr-0 mx-auto">
                                    <label for="work_period_input" class="d-block text-center">Период работы :</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-addon input-type">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <input name="work_period" type="text" class="form-control datepicker-here" id="work_period_input" 
                                        data-min-view="months"
                                        data-view="months"
                                        data-date-format="MM yyyy"
                                        data-range="true" 
                                        data-multiple-dates-separator=" - ">
                                    </div>
                                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                                </div>
                                <div class="group col-11 pl-0 pr-0 mx-auto">
                                    <label for="exp_func_input" class="d-block text-center">Обязанности и функции :</label>
                                    <div class="input-group mb-2">
                                        <textarea name="exp_func" id="exp_func_input" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                                </div>
                                <div class="group col-11 pl-0 pr-0 mx-auto">
                                    <button class="btn btn-outline-primary btn-lg btn-block mt-4" role="button" id="add_exp">
                                        Добавить место работы
                                    </button>
                                </div>
                            </div>
                            <div class="no_exp_block 
                                <?php 
                                    if($router['mode'] == "edit" && count($experience) == 0){

                                        echo "";

                                    } else {

                                        echo "hidden-xl-down";

                                    }

                                ?> col-11 pl-0 pr-0 mx-auto mt-4">
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


                    <!-- Образование -->
                    <div role="tabpanel" class="card card-block bg-faded tab-pane fade" id="edu" style="min-height: 500px;">
                    <div class="edu_group">
                            <div class="completed_edu_forms col-11 pl-0 pr-0 mx-auto">


                                <?php if ($router['mode'] == "edit")?>
                                <?php if(count($own_education) > 0) :
                                    foreach ($own_education as $edu) :?>
                                        <div class="edu">
                                            <div hidden class="edu_id"><?=$edu->getId()?></div>
                                            <div hidden class="level_id"><?=$edu->getLevelId()?></div>
                                            <div class="card mb-4" style="font-size: 14px;">
                                            <div class="card-block">
                                                <h3 class="card-title inst">
                                                    <?=$edu->getInstitute()?>
                                                </h3>
                                                <div class="card-text mb-2">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="left d-flex">
                                                            <div class=" mr-2 text-muted">
                                                                <?=$edu->getLevelName()?>
                                                            </div>
                                                            <div class="city text-muted">
                                                                <?=$edu->getCity()?>
                                                            </div>
                                                        </div>
                                                        <div class="right text-muted">
                                                            <?=$edu->getStudyPeriod()?> гг.
                                                        </div>
                                                    </div>
                                                    <div class="text-muted fac">
                                                        <?=$edu->getFaculty()?>
                                                    </div>
                                                </div>
                                                <a href="#" class="btn btn-primary mr-1 edit_edu">Редактировать</a>
                                                <a href="#" class="btn btn-secondary delete_edu">Удалить</a>
                                                </div>
                                            </div>
                                        </div>

                                <?php endforeach; endif; ?>

                                
                            </div>
                            <div class="group col-11 pl-0 pr-0 mx-auto">
                                <label class="d-block text-center">Уровень образования :</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-addon input-type">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <select class="form-control custom-select" name="edu_level">
                                        <?php foreach($education as $res) :?>
                                            <option value="<?=$res->getId()?>"><?=$res->getName()?></option>
                                        <? endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="group col-11 pl-0 pr-0 mx-auto">
                                <label for="edu_inst_input" class="d-block text-center">Учебное заведение :</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-addon input-type">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <input name="edu_inst" type="text" class="form-control" id="edu_inst_input">
                                </div>
                                <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                            </div>
                            <div class="group col-11 pl-0 pr-0 mx-auto">
                                <label for="edu_city" class="d-block text-center">Город :</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-addon input-type">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                    <input name="edu_city" type="text" class="form-control" id="edu_city">
                                </div>
                                <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                            </div>
                            <div class="group col-11 pl-0 pr-0 mx-auto edu_facult">
                                <label for="edu_fac_input" class="d-block text-center">Факультет, специальность :</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-addon input-type">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <input name="edu_fac" type="text" class="form-control" id="edu_fac_input">
                                </div>
                                <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                            </div>
                            <div class="group col-11 pl-0 pr-0 mx-auto">
                                <label for="edu_period_input" class="d-block text-center">Период учебы :</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-addon input-type">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <input name="edu_period" type="text" class="form-control datepicker-here" id="edu_period_input" 
                                    data-min-view="years"
                                    data-view="years"
                                    data-date-format="yyyy"
                                    data-range="true" 
                                    data-multiple-dates-separator=" - ">
                                </div>
                                <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                            </div>
                            <div class="group col-11 pl-0 pr-0 mx-auto">
                                <button class="btn btn-outline-primary btn-lg btn-block mt-4" role="button" id="add_edu">
                                    Добавить место учебы
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- Владение языками -->
                    <div role="tabpanel" class="card card-block bg-faded tab-pane fade" id="lang" style="min-height: 500px;">
                        <div class="lang_block">


                            <?php if ($router['mode'] == "edit")?>
                                <?php if(count($language) > 0) :
                                    foreach ($language as $lang) :?>


                                        <div class="d-flex col-11 pl-0 pr-0 mx-auto xlang">
                                            <div hidden class="xlang_id"><?=$lang->getId()?></div>
                                            <div class="group col-11">
                                                <div class="form-group row">
                                                    <div class="hidden-xl-down lang_id"><?=$lang->getLangId()?></div>
                                                    <label class="col-3 col-form-label pl-0"><?=$lang->getLangName()?></label>
                                                    <div class="col-9">
                                                        <select class="form-control custom-select" name="lang">
                                                            <option value="Не владею" 
                                                            <?php 
                                                            
                                                            if($lang->getLangLevel() == "Не владею"){

                                                                echo "selected";

                                                            }

                                                            ?>
                                                            >Не владею</option>
                                                            <option value="Базовый" 
                                                            <?php 

                                                            if($lang->getLangLevel() == "Базовый"){

                                                                echo "selected";

                                                            }

                                                            ?>
                                                            >Базовый</option>
                                                            <option value="Технический" 
                                                            <?php
                                                            
                                                            if($lang->getLangLevel() == "Технический"){

                                                                echo "selected";

                                                            }
                                                            
                                                            ?>
                                                            >Технический</option>
                                                            <option value="Разговорный"  
                                                            <?php
                                                            
                                                            if($lang->getLangLevel() == "Разговорный"){

                                                                echo "selected";

                                                            }
                                                            
                                                            ?>
                                                            >Разговорный</option>
                                                            <option value="Свободно владею"  
                                                            <?php 
                                                            
                                                            if($lang->getLangLevel() == "Свободно владею"){

                                                                echo "selected";

                                                            }
                                                            
                                                            ?>
                                                            >Свободно владею</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="btn btn-outline-primary col-1 delete_lang" href="#" role="button" style="height: 37px; padding: .5rem .3rem;">&#151;</a>
                                        </div>


                            <?php endforeach; endif; ?>


                        </div>
                        <div class="add_lang">
                            <div class="group col-11 pl-0 pr-0 mx-auto">
                                <label class="d-block text-center">Языки :</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-addon">
                                        <i class="fas fa-language"></i>
                                    </div>
                                    <select class="form-control custom-select" name="lang_list">
                                        <?php foreach($languages as $res) :?>
                                            <option value="<?=$res->getId()?>"><?=$res->getName()?></option>
                                        <? endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="group col-11 pl-0 pr-0 mx-auto">
                                <button class="btn btn-outline-primary btn-lg btn-block mt-4 mb-4" role="button" id="add_lang">
                                    Добавить язык
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- Дополнительная информакия -->
                    <div role="tabpanel" class="card card-block bg-faded tab-pane fade" id="add">
                        <div class="group col-11 pl-0 pr-0 mx-auto">
                            <label class="d-block text-center">Владение компьютером :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">
                                    <i class="fas fa-desktop"></i>
                                </div>
                                <select class="form-control custom-select" name="comp_skills">
                                        <option value=""></option>
                                    <?php foreach($compSkills as $res) :?>
                                        <option value="<?=$res->getId()?>" 
                                        <?php 

                                            if($resume->getCompSkillName() == $res->getName()){
                                           
                                                echo "selected";

                                            }

                                        ?>
                                        ><?=$res->getName()?></option>
                                    <? endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="group col-11 pl-0 pr-0 mx-auto">
                            <label class="d-block text-center">Наличие авто :</label>
                            <div class="input-group mb-2">
                                <div class="input-group-addon">
                                <i class="fas fa-car"></i>
                                </div>
                                <select class="form-control custom-select" name="add_auto_exist">
                                    <option value=""></option>
                                    <option value="Нет" 
                                    <?php 
                                        if($resume->getCar() == "Нет"){
                                            
                                            echo "selected";

                                        }
                                    ?>
                                    >Нет</option>
                                    <option value="Да" 
                                    <?php 
                                        if($resume->getCar() == "Да"){

                                            echo "selected";

                                        }
                                    ?>
                                    >Да</option>
                                </select>
                            </div>
                        </div>
                        <div class="group col-11 pl-0 pr-0 mx-auto">
                            <label for="add_couses_input" class="d-block text-center">Курсы и тренинги :</label>
                            <div class="input-group mb-2">
                                <textarea name="add_courses" id="add_courses_input" cols="30" rows="10" class="form-control"><?=$resume->getCourses() ?></textarea>
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                        <div class="group col-11 pl-0 pr-0 mx-auto">
                            <label for="add_skills_input" class="d-block text-center">Навыки и умения :</label>
                            <div class="input-group mb-2">
                                <textarea name="add_skills" id="add_skills_input" cols="30" rows="10" class="form-control"><?=$resume->getSkills() ?></textarea>
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                    </div>
                </div>
                <input type="submit" id="sub_form" hidden>
                <label for="sub_form" class="btn btn-primary btn-lg btn-block mt-4 mb-5" role="button" id="send_form">
                    <?php 
                        if($router['mode'] == 'edit'){

                            echo "Редактировать";

                        } else {

                            echo "Отправить";
                            
                        }
                    ?>
                </label>
            </form>
        </div>
    </div>
</main>