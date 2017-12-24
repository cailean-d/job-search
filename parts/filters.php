<?php include('scripts/read/get_filter_data.php');?>
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
                    <?=$min_salary_interval . " - " . $max_salary_interval?></span><span> p.
                </span>
                <input id="salary" type="text" class="span2" value="" data-slider-min="0" data-slider-max="<?=$max_salary_interval?>" data-slider-step="5000" data-slider-value="[<?=$min_salary_interval?>,<?=$max_salary_interval?>]"/>
            </div>
            <div class="option industry">
                <label>Отрасль :</label>
                <select name="industry" class="form-control custom-select">
                    <option value="-1">Не имеет значения</option>
                    <?php foreach($industry as $res) :?>
                        <option 
                        value="<?=$res['id']?>"
                        <?=($_GET['industry'] == $res['id']) ? 'selected' : '' ?>
                        >
                            <?=$res['industry_name']?>
                        </option>
                    <? endforeach ?>
                </select>
            </div>
            <div class="option">
                <label>Город :</label>
                <select name="location" class="form-control custom-select">
                    <option value="-1">Любой город</option>
                    <?php foreach($cities as $res): ?>
                        <option value=<?=$res['location']?>
                        <?=($_GET['location'] == $res['location']) ? 'selected' : '' ?>
                        >
                        <?=$res['location']?>
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
                        <option value=<?=$res['id']?>
                        <?=($_GET['schedule'] == $res['id']) ? 'selected' : '' ?>
                        >
                        <?=$res['schedule_name']?>
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
