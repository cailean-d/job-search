<main class="col-8">
        
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
            <div class="card mb-4">
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
                                    в компанию <span class="company">"<?=$vacancy->getCompany()?>"</span>
                                </div>
                                <div>
                                    график: <span class="emp"><?=mb_strtolower($vacancy->getScheduleName(), "UTF-8")?></span>
                                </div>
                            </div>
                        </header>
                        <p>
                            <span class="dem">Требования: </span><?=str_replace(",", ", ", mb_strtolower($vacancy->getDemands(), 'UTF-8'))?>
                        </p>
                        <footer>
                            <div>
                                <?=$vacancy->getLocation();?>
                            </div>
                            <div>
                                <?=date("d.m.Y H:i:s", strtotime($vacancy->getDate()));?>
                            </div>
                        </footer>
                    </article>
                </div>
            </div>
        <?php endforeach; 
    endif ?>

</main>
<aside class="col-4">
    
    <!-- ************************************************************ -->
    <!--                        Фильтры                               -->
    <!-- ************************************************************ -->

    <div class="card">
        <div class="card-block bg-faded">
            <h5 class="text-center">Фильтры</h5>
            <form id="filters">
                <div class="option search">
                    <input name="query" type="text" placeholder="найти..."
                        value="<?=($_GET['query']) ? $_GET['query'] : ''?>"
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
                            <?=($_GET['industry'] == $res->getId()) ? 'selected' : '' ?>
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
                            <?=($_GET['location'] == $res) ? 'selected' : '' ?>
                            >
                            <?=$res?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="option">
                    <label>Период : </label>
                    <select name="time" class="form-control custom-select">
                        <option value="0"  <?=($_GET['time']=="0")  ? 'selected': ''?>>За все время</option>
                        <option value="1"  <?=($_GET['time']=="1")  ? 'selected': ''?>>За последний день</option>
                        <option value="3"  <?=($_GET['time']=="3")  ? 'selected': ''?>>За последние три дня</option>
                        <option value="7"  <?=($_GET['time']=="7")  ? 'selected': ''?>>За последнюю неделю</option>
                        <option value="30" <?=($_GET['time']=="30") ? 'selected': ''?>>За последний месяц</option>
                    </select>
                </div>
                <div class="option">
                    <label>Тип занятости : </label>
                    <select name="schedule" class="form-control custom-select">
                        <option value="-1">Не имеет значения</option>
                        <?php foreach($schedule as $res): ?>
                            <option value=<?=$res->getId()?>
                            <?=($_GET['schedule'] == $res->getId()) ? 'selected' : '' ?>
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