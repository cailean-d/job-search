<?php include('scripts/get_filter_data.php');?>
<h3>Фильтры</h3>
<form id="filters">
    <div class="option search">
        <h4>Поиск</h4>
        <input name="query" type="text" placeholder="найти..."
            value="<?=($_GET['query']) ? $_GET['query'] : ''?>"
        >
    </div>
    <div class="option">
        <h4>Зарплата от: </h4>
        <span id="salary-view">0</span><span> p.</span>
        <input name="salary" id="salary" type="range" min="0" max="100000" step="5000" 
        value="<?=($_GET['salary']) ? $_GET['salary'] : '0'?>">
    </div>
    <div class="option industry">
        <h4>Отрасль : </h4>
        <select name="industry">
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
        <h4>Город : </h4>
        <select name="location">
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
        <h4>Период : </h4>
        <select name="time">
            <option value="0"  <?=($_GET['time']=="0")  ? 'selected': ''?>>За все время</option>
            <option value="1"  <?=($_GET['time']=="1")  ? 'selected': ''?>>За последний день</option>
            <option value="3"  <?=($_GET['time']=="3")  ? 'selected': ''?>>За последние три дня</option>
            <option value="7"  <?=($_GET['time']=="7")  ? 'selected': ''?>>За последнюю неделю</option>
            <option value="30" <?=($_GET['time']=="30") ? 'selected': ''?>>За последний месяц</option>
        </select>
    </div>
    <div class="option">
        <h4>Тип занятости : </h4>
        <select name="schedule">
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
    <button type="submit" class="apply">Применить фильтр</button>
</form>