<?php include('scripts/read/get_vacancy.php');?>

<div class="card mb-4 full_vacancy">
    <div class="vacancy_id" hidden><?=$result['id'] ?></div>
    <div class="card-block">
        <div class="header">
            <div class="d-flex justify-content-between mb-4 wq">
                <span class="vacancy_name">
                    <?=$result['vacancy'] ?>
                </span>
                <span class="company">
                    <?=$result['company'] ?>
                </span>
            </div>
            <div class="card">
                <div class="vacancy_info card-block bg-faded">
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
        </div>
        <div class="primary_info">
            <?php if(!empty($result['description'])) : ?>
                <div class="description">
                    <?=$result['description']?>
                </div>
            <?php endif ?>
            <div class="conditions">
                <h4 class="text-muted">Условия</h4>
                <ul>
                    <?php foreach($result['conditions'] as $cond) : ?>
                        <li><?=$cond?></li>
                    <?php endforeach ?>
                </ul>
            </div>
            <div class="duties">
                <h4 class="text-muted">Обязанности</h4>
                <ul>
                    <?php foreach($result['duties'] as $dut) : ?>
                        <li><?=$dut?></li>
                    <?php endforeach ?>
                </ul>
            </div>
            <div class="demands">
                <h4 class="text-muted">Требования</h4>
                <ul>
                    <?php foreach($result['demands'] as $dem) : ?>
                        <li><?=$dem?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
        <div class="secondary_info">
            <div class="schedule">
                <h4 class="text-muted">Тип занятости</h4>
                <div>
                    <?=$result['schedule_name']?>
                </div>
            </div>
            <div class="user_info">
                <h4 class="text-muted">Контактная информация</h4>
                <table class="table contact_info">
                    <tbody>
                        <tr>
                            <th scope="row" class="text-muted">
                                <?=$result['sender_name']?>
                            </th>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-muted">Телефон:</th>
                            <td><?=$result['phone']?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-muted">Почта</th>
                            <td><?=$result['email']?></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <div class="footer">
            <?php if($_SESSION['type'] == '0') : ?>
                <?php include("./scripts/read/get_resume_id.php"); ?>
                <?php if(count($resume_data) == 0) :?>
                    <div class="alert alert-info mb-0" role="alert">
                        <strong>Для того, чтобы оставить резюме, сначала необходимо создать его.</strong>
                    </div>
                <?php else : ?>
                    <?php include('scripts/read/get_vacancy_resume.php');?>
                    <?php if(count($resume) == 0) :?>
                        <button class="btn btn-primary btn-lg btn-block hand" id="send_resume">
                            Отправить резюме
                        </button>
                    <?php else : ?>
                        <div class="alert alert-info" role="alert">
                            <strong>Ваше резюме отправлено</strong>
                        </div>
                        <button class="btn btn-primary btn-lg btn-block hand" id="del_resume">
                            Удалить резюме
                        </button>
                    <?php endif ?>
                <?php endif ?>
            <?php endif ?>
            <?php if($_SESSION['type'] == '1') : ?>
                <div class="card">
                    <div class="card-block">
                        <h4 class="text-muted mb-4">Оставленные резюме : </h4>
                        <?php include('scripts/read/get_vacancy_resume_ids.php') ?>
                        <?php foreach($data_id as $row) :
                            $_POST['id'] = $row['user_id'];
                            include('scripts/read/get_user_data.php')
                            ?>
                            <a class="btn btn-outline-primary btn-lg btn-block" href="resume.php?id=<?=$row['user_id']?>" role="button">
                                <?php
                                    echo $user_data['firstname'] . " ";
                                    echo $user_data['lastname'] . " &lt;";
                                    echo $user_data['email'] . "&gt;";
                                ?>
                            </a>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php endif ?>
            <?php if(!isset($_SESSION['authorized'])) :?>
                <div class="alert alert-info mb-0" role="alert">
                    <strong>Для того, чтобы оставить резюме, зарегистрируйтесь или войдите.</strong>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>

<?php include("./parts/modal_alert.php");?>
