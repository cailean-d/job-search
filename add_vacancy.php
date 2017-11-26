<?php session_start();?>
<?php if($_SESSION['type'] != '1'){header("Location: /index.php");}?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/style.css?qqsessweweweweeqwqsqgq">
    <link rel="stylesheet" href="css/add_vacancy.css?qseeewewweewweweweweewweewewewwwwqqqqssq">
    <title>Разместить вакансию</title>
</head>
<body>
    <div class="wrapper">
        <?php include("parts/header.php")?>
        <div class="app-body">
            <main>
                <?php if(isset($_SESSION['authorized'])) :
                    include("parts/add_vacancy.php");
                else :?>
                <p style="font-size: 22px">Для того, чтобы разместить вакансию, необходимо 
                    <a href="registration.php">зарегистрироваться</a> или 
                    <a id="show_login" href="">войти</a>
                </p>
                <?php endif ?>
            </main>
        </div>
    </div>
<script src="js/modal.js?ewewewewqew"></script>
<script src="js/vacancy_valid.js?eqew"></script>
</body>
</html>