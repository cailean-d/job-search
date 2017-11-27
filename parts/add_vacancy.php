<?php include('scripts/get_filter_data.php');?>
<div class="add_vacancy">
    <form action="scripts/set_vacancy.php" method="post" id="vacancy">
        <div class="option">
            <h3>Название вашей компании</h3>
            <input name="company" type="text" placeholder='Допустимы только буквы и ""' required>
            <div class="error"></div>
        </div>
        <div class="option">
            <h3>Телефонный номер</h3>
            <input name="phone" type="text" placeholder="+12345678901" required>
            <div class="error"></div>
        </div>
        <div class="option">
            <h3>Электронная почта</h3>
            <input name="email" type="email" placeholder="test@email.com" required>
            <div class="error"></div>
        </div>
        <div class="option">
            <h3>Название вакансии</h3>
            <input name="vacancy" type="text" placeholder='Допустимы только буквы и ""' required>
            <div class="error"></div>
        </div>
        <div class="option">
            <h3>Зарплата</h3>
            <input name="salary" type="text" placeholder="Введите целое число либо диапазон чисел (1-2) в рублях" required>
            <div class="error"></div>
        </div>
        <div class="option">
            <h3>Опыт работы</h3>
            <input name="exp" type="text" placeholder="Введите целое число либо диапазон чисел (1-2) в годах" required>
            <div class="error"></div>
        </div>
        <div class="option">
            <h3>Местоположение</h3>
            <input name="location" type="text" placeholder="Город" required>
            <div class="error"></div>
        </div>
        <div class="option">
            <h3>Тип занятости</h3>
            <select name="schedule" required>
                <?php while($res = $schedule->fetch(PDO::FETCH_BOTH)): ?>
                    <option value=<?=$res['id']?>><?=$res['schedule_name']?></option>
                <?php endwhile ?>
            </select>
        </div>
        <div class="option">
            <h3>Отрасль</h3>
            <select name="industry" required>
                <?php while($res = $industry->fetch(PDO::FETCH_BOTH)) :?>
                    <option value="<?=$res['id']?>"><?=$res['industry_name']?></option>
                <? endwhile ?>
            </select>
        </div>
        <div class="option demands">
            <h3>Требования</h3>
            <div class="opt">
                <div class="row">
                    <input name="demands" type="text" placeholder="Требование" required>
                    <button id="demand" title="Добавить поле">+</button>
                </div>
                <div class="error error2"></div>
            </div>
        </div>
        <div class="option duties">
            <h3>Должностные обязанности</h3>
            <div class="opt">
                <div class="row">
                    <input name="duties" type="text" placeholder="Обязанность" required>
                    <button id="dutie" title="Добавить поле">+</button>
                </div>
                <div class="error error2"></div>
            </div>
        </div>
        <div class="option conditions">
            <h3>Условия работы</h3>
            <div class="opt">
                <div class="row">
                    <input name="conditions" type="text" placeholder="Условие" required>
                    <button id="condition" title="Добавить поле">+</button>
                </div>
                <div class="error error2"></div>
            </div>
        </div>
        <div class="option">
            <h3>Дополнительно</h3>
            <textarea name="desc" rows="10" placeholder="Дополнительная информация, которую вы бы хотели указать..."></textarea>
            <div class="error"></div>
        </div>
        <input type="submit" value="Отправить">
    </form>
</div>