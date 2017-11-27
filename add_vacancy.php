<?php session_start();?>
<?php if($_SESSION['type'] != '1'){header("Location: /index.php");}?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="css/style.css?qqsessweweweweeqwqsqgq">
    <link rel="stylesheet" href="css/add_vacancy.css?qseeewewweewweweweweewweewewewwwwqqqqssq">
    <title>Разместить вакансию</title>
</head>
<body>
    <div class="wrapper">
        <?php include("parts/header.php")?>
        <div class="app-body">
            <main>
                <?php include("parts/add_vacancy.php"); ?>
            </main>
        </div>
    </div>
<script src="js/modal.js?ewewewewqew"></script>
<script src="js/vacancy_valid.js?eqeqeqqqew"></script>
<script src="js/active_page.js?e"></script>
</body>
</html>