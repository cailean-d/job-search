<main class="col-xl-9 col-lg-9 col-md-12">
        
    <!-- ************************************************************ -->
    <!--                      Список вакансий                         -->
    <!-- ************************************************************ -->
    
    <?php 
    if(count($vacancies) == 0) : ?>
        <div class="alert alert-info" role="alert">
            <strong>Вакансий нет.</strong>
        </div>
    <?php else : 
        foreach($vacancies as $vacancy) :?>
            <div class="card vacancy_block">
                <div class="card-block">
                    <article class='vacancy'>
                        <header>
                            <div class="top">
                                <div class='title'>
                                    <a href='vacancy/<?=$vacancy->getId()?>'><?=$vacancy->getVacancyName()?></a>
                                </div>
                                <div class='salary'>
                                    <span>
                                        <?=$vacancy->getSalaryMin()?><?=(!empty($vacancy->getSalaryMax())) ? "-".$vacancy->getSalaryMax(): ""?>р.
                                    </span>
                                </div>
                            </div>
                            <div class="bottom">
                                <div>
                                    Компания <span class="company">"<?=$vacancy->getCompany()?>"</span>
                                </div>
                                <div>
                                    График: <span class="emp"><?=mb_strtolower($vacancy->getScheduleName(), "UTF-8")?></span>
                                </div>
                            </div>
                        </header>
                        <p>
                            <span class="dem">Требования: </span><?=str_replace(",", ", ", mb_strtolower($vacancy->getDemands(), 'UTF-8'))?>
                        </p>
                        <footer>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="text">
                                    <?=$vacancy->getLocation();?>
                                </div>
                            </div>
                            <div class="date">
                                <i class="fas fa-calendar-alt"></i>
                                <div class="text">
                                    <?=date("d.m.Y H:i:s", strtotime($vacancy->getDate()));?>
                                </div>
                            </div>
                        </footer>
                    </article>
                </div>
            </div>
        <?php endforeach; 
    endif ?>

</main>
<aside class="col-xl-4 col-lg-4">
    
    <!-- ************************************************************ -->
    <!--                        Фильтры                               -->
    <!-- ************************************************************ -->

    <div class="card filter">
        <div class="card-block bg-faded filter-less-padding">
            <h5 class="filter__header">Фильтры</h5>
            <form id="filters">
                <div class="option search">
                    <input name="query" type="text" placeholder="найти..."
                        value="<?=$filter['query']?>"
                    class="form-control">
                </div>
                <div class="option">
                    <label>Зарплата :</label>
                    <span id="salary-view">
                        <?=$minSalaryInterval . " - " . $maxSalaryInterval?></span><span> p.
                    </span>
                    <input id="salary" type="text" class="span2" value="" data-slider-min="0" data-slider-max="<?=$maxSalaryInterval?>" data-slider-step="5000" data-slider-value="[<?=$minSalaryInterval?>,<?=$maxSalaryInterval?>]"/>
                </div>
                <div class="option industry">
                    <label>Отрасль :</label>
                    <select name="industry" class="form-control custom-select">
                        <option value="-1">Не имеет значения</option>
                        <?php foreach($industry as $res) :?>
                            <option 
                            value="<?=$res->getId()?>"
                            <?=($filter['industry'] == $res->getId()) ? 'selected' : '' ?>
                            >
                                <?=$res->getName()?>
                            </option>
                        <? endforeach ?>
                    </select>
                </div>
                <div class="option">
                    <label>Город :</label>
                    <select name="location" class="form-control custom-select">
                        <option value="-1">Любой город</option>
                        <?php foreach($cities as $res): ?>
                            <option value=<?=$res?>
                            <?=($filter['location'] == $res) ? 'selected' : '' ?>
                            >
                            <?=$res?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="option">
                    <label>Период : </label>
                    <select name="time" class="form-control custom-select">
                        <option value="0"  <?=($filter['time']=="0")  ? 'selected': ''?>>За все время</option>
                        <option value="1"  <?=($filter['time']=="1")  ? 'selected': ''?>>За последний день</option>
                        <option value="3"  <?=($filter['time']=="3")  ? 'selected': ''?>>За последние три дня</option>
                        <option value="7"  <?=($filter['time']=="7")  ? 'selected': ''?>>За последнюю неделю</option>
                        <option value="30" <?=($filter['time']=="30") ? 'selected': ''?>>За последний месяц</option>
                    </select>
                </div>
                <div class="option">
                    <label>Тип занятости : </label>
                    <select name="schedule" class="form-control custom-select">
                        <option value="-1">Не имеет значения</option>
                        <?php foreach($schedule as $res): ?>
                            <option value=<?=$res->getId()?>
                            <?=($filter['schedule'] == $res->getId()) ? 'selected' : '' ?>
                            >
                            <?=$res->getName()?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <button type="submit" class="apply btn btn-primary btn-block hand">
                    Применить фильтр
                </button>
            </form>
        </div>
    </div>

</aside>