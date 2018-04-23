<?php
	$config = require realpath(__DIR__.'/../config/admin_panel.php');
	$db_config = require realpath(__DIR__.'/../config/database_connection.php');

	if (isset($_GET['ADMIN'])) {
		if ($_GET['login'] != $config['login']) {
		  	$no_login = true;
		  if ($_GET['password'] != $config['password']) {
			$no_pass = true;
		  }
		}

		if (!isset($no_pass) && !isset($no_login)) {
			$_SESSION['admin'] = true;
		}
	}

	if(isset($_GET['logout'])) {
		unset($_SESSION['admin']);
	}

	if(isset($_GET['mistake'])) {
		$pdo = new PDO(
			$db_config['type'].':host='.
			$db_config['host'].';dbname='.
			$db_config['database_name'].';charset=utf8', 
			$db_config['user'],
			$db_config['password'], 
			$db_config['options']
		);

		$stmt = $pdo->prepare('INSERT INTO vacancy_mistakes(vacancy_id, description) 
		VALUES (?, ?)');
		
		$stmt->execute([$_GET['id'], $_GET['message']]);
	}

	if(isset($_GET['public'])) {
		$pdo = new PDO(
			$db_config['type'].':host='.
			$db_config['host'].';dbname='.
			$db_config['database_name'].';charset=utf8', 
			$db_config['user'],
			$db_config['password'], 
			$db_config['options']
		);

		$stmt = $pdo->prepare('UPDATE `vacancies` SET status = ? WHERE id =  ?');
		
		$stmt->execute(['1', $_GET['id']]);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Админ панель</title>
	<link rel="stylesheet" href="../../public/style/admin.bundle.css?<?=uniqid()?>">
	<link rel="shortcut icon" href="../../public/favicon.png">
</head>
<body>
	<?php if (!isset($_SESSION['admin'])) : ?>
		<div class="container">
			<h1>Админ панель</h1>
			<div class="contact-form">
			<div class="signin">
			<form>
				<div class="field">
					<input type="text" class="user" placeholder="Логин" name="login"/>
					<?php if ($no_login) {echo "<div class='valid'>Неверный логин</div>";}?>
				</div>
				<div class="field">
					<input type="password" class="pass" placeholder="Пароль" name="password"/>
					<?php if ($no_pass) {echo "<div class='valid'>Неверный пароль</div>";}?>
				</div>
				<input type="submit" value="ВХОД" name="ADMIN"/>
			</form>
			</div>
			</div>
		</div>
	<?php else : ?>
		<div class="container2">
			<form hidden>
				<input type="submit" name="logout" id="exit" value="q"/>
			</form>
			<aside class="side-panel">
				<nav>
					<a href="" class="active">Новые вакансии</a>
					<a href=""><label for="exit">Выход</label></a>
					<?php 
					
						if(isset($_GET['qqq'])) {
							echo "qqww";
						}
					?>
				</nav>
			</aside>
			<main>
				<?php 
					$pdo = new PDO(
						$db_config['type'].':host='.
						$db_config['host'].';dbname='.
						$db_config['database_name'].';charset=utf8', 
						$db_config['user'],
						$db_config['password'], 
						$db_config['options']
					);

					$stmt = $pdo->prepare('
					SELECT 
					vacancies.*,
					help_schedule.schedule_name
					FROM vacancies 
					LEFT JOIN help_schedule ON vacancies.schedule = help_schedule.id
					WHERE status = ?
					ORDER BY `date` DESC');
					
					$stmt->execute(['0']);

					foreach ($stmt as $row): ?>
			<div class="card mb-4 col-8 vacancyz mx-auto">
                <div class="id" hidden="hidden"><?=$row['id']?></div> 
                <div class="card-block">
                    <article class='vacancy'>
                        <header>
                            <div class="top">
                                <div class='title' style="display: flex; justify-content: space-between;">
                                    <a href='vacancy/<?=$row['id']?>'><?=$row['vacancy']?></a>
                                </div>
                                <div class='salary'>
                                    <div class="description">
                                        Зарплата: 
                                    </div>
                                    <span>
                                        <?=$row['salary_min']?>
                                        
                                        <?

                                        if(!empty($row['salary_max'])){

                                            echo "-".$row['salary_max'];

                                        } else {

                                            echo "";

                                        }
                                        
                                        ?>р.
                                    </span>
                                </div>
                            </div>
                            <div class="bottom">
                                <div class="company">
                                    <div class="description">
                                        Компания: 
                                    </div>
                                    <span class="company">
                                        "<?=$row['company']?>"
                                    </span>
                                </div>
                                <div class="schedule">
                                    <div class="description">
                                        График:
                                    </div>
                                    <span class="emp">
                                        <?=mb_strtolower($row['schedule_name'], "UTF-8")?>
                                    </span>
                                </div>
                            </div>
                        </header>
                        <div class="body">
                            <div class="demands">
                                <div class="description">
                                    Требования:
                                </div>
                                <span>
                                    <?=str_replace(",", ", ", mb_strtolower($row['demands'], 'UTF-8'))?>
                                </span>
                            </div>
                        </div>
                        <footer>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="text">
                                    <?=$row['location'];?>
                                </div>
                            </div>
                            <div class="date">
                                <i class="fas fa-calendar-alt"></i>
                                <div class="text">
                                    <?=date("d.m.Y H:i:s", strtotime($row['date']));?>
                                </div>
                            </div>
                        </footer>
                    </article>
                </div>
                <div class="edit-buttons">
                    <a class="btn btn-primary btn-block public" role="button" href="#">
                        Опубликовать
                    </a>
                    <a class="btn btn-outline-primary btn-block del" role="button" href="#"  data-toggle="modal" data-target="#confirm">
                        Отказать
                    </a>
                </div>
            </div>
					<?php endforeach ?>
			</main>
		</div>
		<div class="modal fade ns" id="confirm">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Укажите причину</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<textarea class="form-control" id="textarea" rows="5"></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary hand option1" id="confirm_button">Подтвердить</button>
					<button type="button" class="btn btn-outline-primary hand option2"  data-dismiss="modal">Закрыть</button>
				</div>
				</div>
			</div>
		</div>
	<?php endif ?>
<script src="../../public/script/admin.bundle.js?<?=uniqid()?>"></script>
</body>
</html>
