<?php include('scripts/get_vacancy.php');?>
<div class="full_vacancy">
    <div class="header">
        <div class="vacancy_name">
            <?=$result['vacancy'] ?>
        </div>
        <div class="company">
            <?=$result['company'] ?>
        </div>
        <div class="vacancy_info">
            <div class="salary">
                <div class="header">
                    Зарплата
                </div>
                <div class="body">
                <?=$result['salary_min']?><?=(!empty($result['salary_max'])) ? "-".$result['salary_max'] : ""?>р.
                </div>
            </div>
            <div class="city">
                <div class="header">
                    Город
                </div>
                <div class="body">
                    <?=$result['location'] ?>
                </div>
            </div>
            <div class="exp">
                <div class="header">
                    Требуемый опыт работы
                </div>
                <div class="body">
                    <?=$result['exp'] ?> лет.
                </div>
            </div>
        </div>
    </div>
    <div class="primary_info">
        <?php if(!empty($result['description'])) : ?>
            <div class="description">
                <?=$result['description']?>
            </div>
        <?php endif ?>
        <div class="conditions">
            <h4>Условия</h4>
            <ul>
                <?php foreach($result['conditions'] as $cond) : ?>
                    <li><?=$cond?></li>
                <?php endforeach ?>
            </ul>
        </div>
        <div class="duties">
            <h4>Обязанности</h4>
            <ul>
                <?php foreach($result['duties'] as $dut) : ?>
                    <li><?=$dut?></li>
                <?php endforeach ?>
            </ul>
        </div>
        <div class="demands">
            <h4>Требования</h4>
            <ul>
                <?php foreach($result['demands'] as $dem) : ?>
                    <li><?=$dem?></li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
    <div class="secondary_info">
        <div class="schedule">
            <h3>Тип занятости</h3>
            <div>
                <?=$result['schedule_name']?>
            </div>
        </div>
        <div class="user_info">
            <h3>Контактная информация</h3>
            <div class="name">
                <?=$result['sender_name']?>
            </div>
            <table class="contact_info">
                <tbody>
                    <tr>
                        <td>
                            Телефон:
                        </td>
                        <td>
                            <?=$result['phone']?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Почта:
                        </td>
                        <td>
                            <?=$result['email']?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($_SESSION['type'] == '0') :?>
        <button>Отправить резюме</button>
    <?php endif ?>
    <?php if(!isset($_SESSION['authorized'])) :?>
        <h3 class="error">Для того, чтобы оставить резюме, зарегистрируйтесь или войдите.</h3>
    <?php endif ?>
</div>