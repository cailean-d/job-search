<?php
    try{
        $db = new PDO('mysql:host=localhost;dbname=job;charset=utf8', 'root', '');
        $schedule = $db->query("SELECT * FROM `schedule`");
        $industry = $db->query("SELECT * FROM `industry`");
        $cities   = $db->query("SELECT DISTINCT location FROM vacancies");
        
    } catch (Exception $e) {
        echo $e->getMessage(); 
    }
?>
<h3>Фильтры</h3>
<div class="option">
    <h4>Зарплата от: </h4>
    <span id="salary-view">0</span><span> p.</span>
    <input name="salary" id="salary" type="range" min="10000" max="100000" step="5000" value="30000">
</div>
<div class="option industry">
    <h4>Отрасль : </h4>
    <select name="industry">
        <option value="-1">Не имеет значения</option>
        <?php while($res = $industry->fetch(PDO::FETCH_BOTH)) :?>
            <option value="<?=$res['id']?>"><?=$res['name']?></option>
        <? endwhile ?>
    </select>
</div>
<div class="option">
    <h4>Город : </h4>
    <select name="location">
        <option value="-1">Любой город</option>
        <?php while($res = $cities->fetch(PDO::FETCH_BOTH)): ?>
            <option value=<?=$res['location']?>><?=$res['location']?></option>
        <?php endwhile ?>
    </select>
</div>
<div class="option">
    <h4>Период : </h4>
    <select name="time">
        <option value="all">За все время</option>
        <option value="day">За последний день</option>
        <option value="3days">За последние три дня</option>
        <option value="week">За последнюю неделю</option>
        <option value="month">За последний месяц</option>
    </select>
</div>
<div class="option">
    <h4>Тип занятости : </h4>
    <select name="schedule">
        <option value="-1">Не имеет значения</option>
        <?php while($res = $schedule->fetch(PDO::FETCH_BOTH)): ?>
            <option value=<?=$res['id']?>><?=$res['name']?></option>
        <?php endwhile ?>
    </select>
</div>
<button class="apply">Применить фильтр</button>