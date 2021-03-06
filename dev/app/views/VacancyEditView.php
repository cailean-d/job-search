<main>
    <div class="card mx-auto col-8 bg-faded mb-4 add_vacancy">

    <?php if($router['mode'] === "edit"): ?>

        <div id="vacancy_id" hidden><?=$vacancy->getId()?></div>

    <?php endif ?>

        <div class="card-block">
            <form id="vacancy">
                <div class="group pl-0 pr-0">
                    <label for="company" class="d-block text-center">Название вашей компании :</label>
                    <div class="input-group mb-2">
                        <div class="input-group-addon">
                            <i class="fas fa-building"></i>
                        </div>
                        <input name="company" type="text" class="form-control" id="company" value="<?=$vacancy->getCompany()?>">
                    </div>
                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                </div>
                <div class="group pl-0 pr-0">
                    <label for="phone" class="d-block text-center">Телефонный номер :</label>
                    <div class="input-group mb-2">
                        <div class="input-group-addon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <input name="phone" type="text" class="form-control" id="phone" value="<?=$vacancy->getPhone()?>">
                    </div>
                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                </div>
                <div class="group pl-0 pr-0">
                    <label for="email" class="d-block text-center">Электронная почта :</label>
                    <div class="input-group mb-2">
                        <div class="input-group-addon">
                            <i class="fas fa-at"></i>
                        </div>
                        <input name="email" type="text" class="form-control" id="email" value="<?=$vacancy->getEmail()?>">
                    </div>
                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                </div>
                <div class="group pl-0 pr-0">
                    <label for="vacancy" class="d-block text-center">Название вакансии :</label>
                    <div class="input-group mb-2">
                        <div class="input-group-addon">
                            <i class="fas fa-list-alt"></i>
                        </div>
                        <input name="vacancy" type="text" class="form-control" id="vacancy" value="<?=$vacancy->getVacancyName()?>">
                    </div>
                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                </div>
                <div class="group pl-0 pr-0">
                    <label for="salary" class="d-block text-center">Зарплата :</label>
                    <div class="input-group mb-2">
                        <div class="input-group-addon">
                            <i class="fas fa-ruble-sign"></i>
                        </div>
                        <input name="salary" type="text" class="form-control" id="salary" value="<?=$vacancy->getSalaryMin()?><?php if(!empty($vacancy->getSalaryMax())){echo "-".$vacancy->getSalaryMax();}else{echo "";}?>">
                    </div>
                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                </div>
                <div class="group pl-0 pr-0">
                    <label for="exp" class="d-block text-center">Опыт работы :</label>
                    <div class="input-group mb-2">
                        <div class="input-group-addon">
                        <i class="fas fa-building"></i>
                        </div>
                        <input name="exp" type="text" class="form-control" id="exp" value="<?=$vacancy->getExperience()?>">
                    </div>
                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                </div>
                <div class="group pl-0 pr-0">
                    <label for="location" class="d-block text-center">Местоположение :</label>
                    <div class="input-group mb-2">
                        <div class="input-group-addon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <input name="location" type="text" class="form-control" id="location" value="<?=$vacancy->getLocation()?>">
                    </div>
                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                </div>
                <div class="group pl-0 pr-0">
                    <label class="d-block text-center">Тип занятости :</label>
                    <div class="input-group mb-2">
                        <div class="input-group-addon">
                            <i class="fas fa-building"></i>
                        </div>
                        <select class="form-control custom-select" name="schedule">
                            <?php foreach($schedule as $res): ?>
                                <option value=<?=$res->getId()?>
                                <?php if($vacancy->getScheduleId() == $res->getId()) echo " selected";?>
                                ><?=$res->getName()?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="group pl-0 pr-0">
                    <label class="d-block text-center">Отрасль :</label>
                    <div class="input-group mb-2">
                        <div class="input-group-addon">
                            <i class="fas fa-industry"></i>
                        </div>
                        <select class="form-control custom-select" name="industry">
                            <?php foreach($industry as $res) :?>
                                <option value="<?=$res->getId()?>" 
                                <?php if($vacancy->getIndustryId() == $res->getId()) echo " selected";?>
                                ><?=$res->getName()?></option>
                            <? endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="group pl-0 pr-0 demands">
                    <label for="demands" class="d-block text-center">Требования :</label>
                    <?php if($router['mode'] === "edit" && count($demands) > 0) : ?>
                        <?php for($i=0;$i<count($demands); $i++) : ?>
                            <div class="opt">
                                <div class="d-flex justify-content-between">
                                    <div class="input-group mb-2 col-11 pl-0">
                                        <div class="input-group-addon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <input name="demands" type="text" class="form-control" id="demands" value="<?=$demands[$i]?>">
                                    </div>
                                    <button class="btn btn-outline-primary col-1 <?=($i==0) ? "add": "del";?>" role="button" style="height: 37px; padding: .5rem .3rem;" id="demand"><?=($i==0) ? "+": "-";?></button>
                                </div>
                                <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                            </div>
                        <?php endfor ?>
                    <?php else : ?>
                        <div class="opt">
                            <div class="d-flex justify-content-between">
                                <div class="input-group mb-2 col-11 pl-0">
                                    <div class="input-group-addon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <input name="demands" type="text" class="form-control" id="demands">
                                </div>
                                <button class="btn btn-outline-primary col-1 add" role="button" style="height: 37px; padding: .5rem .3rem;" id="demand">+</button>
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                    <?php endif ?>
                </div>
                <div class="group pl-0 pr-0 duties">
                    <label for="duties" class="d-block text-center">Должностные обязанности :</label>
                    <?php if($router['mode'] === "edit" && count($duties) > 0) : ?>
                        <?php for($i=0;$i<count($duties); $i++) : ?>
                            <div class="opt">
                                <div class="d-flex justify-content-between">
                                    <div class="input-group mb-2 col-11 pl-0">
                                        <div class="input-group-addon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <input name="duties" type="text" class="form-control" id="duties" value="<?=$duties[$i]?>">
                                    </div>
                                    <button class="btn btn-outline-primary col-1 <?=($i==0) ? "add": "del";?>" role="button" style="height: 37px; padding: .5rem .3rem;" id="dutie"><?=($i==0) ? "+": "-";?></button>
                                </div>
                                <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                            </div>
                        <?php endfor ?>
                    <?php else : ?>
                        <div class="opt">
                            <div class="d-flex justify-content-between">
                                <div class="input-group mb-2 col-11 pl-0">
                                    <div class="input-group-addon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <input name="duties" type="text" class="form-control" id="duties">
                                </div>
                                <button class="btn btn-outline-primary col-1 add" role="button" style="height: 37px; padding: .5rem .3rem;" id="dutie">+</button>
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                    <?php endif ?>
                </div>
                <div class="group pl-0 pr-0 conditions">
                    <label for="conditions" class="d-block text-center">Условия работы :</label>
                    <?php if($router['mode'] === "edit" && count($conditions) > 0) : ?>
                        <?php for($i=0;$i<count($conditions); $i++) : ?>
                            <div class="opt">
                                <div class="d-flex justify-content-between">
                                    <div class="input-group mb-2 col-11 pl-0">
                                        <div class="input-group-addon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <input name="conditions" type="text" class="form-control" id="conditions" value="<?=$conditions[$i]?>">
                                    </div>
                                    <button class="btn btn-outline-primary col-1 <?=($i==0) ? "add": "del";?>" role="button" style="height: 37px; padding: .5rem .3rem;" id="condition"><?=($i==0) ? "+": "-";?></button>
                                </div>
                                <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                            </div>
                        <?php endfor ?>
                    <?php else : ?>
                        <div class="opt">
                            <div class="d-flex justify-content-between">
                                <div class="input-group mb-2 col-11 pl-0">
                                    <div class="input-group-addon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <input name="conditions" type="text" class="form-control" id="conditions">
                                </div>
                                <button class="btn btn-outline-primary col-1 add" role="button" style="height: 37px; padding: .5rem .3rem;" id="condition">+</button>
                            </div>
                            <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                        </div>
                    <?php endif ?>
                </div>
                <div class="group pl-0 pr-0">
                    <label for="desc" class="d-block text-center">Дополнительно :</label>
                    <div class="input-group mb-2">
                        <textarea name="desc" id="desc" cols="20" rows="10" class="form-control"><?=$vacancy->getDescription()?></textarea>
                    </div>
                    <div class="error-block form-control-feedback hidden-xl-down text-center mb-2"></div>
                </div>
                <input type="submit" value="Отправить" class="btn btn-primary btn-lg btn-block mt-4" role="button">
            </form>
        </div>
    </div>

</main>