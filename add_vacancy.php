<?php session_start();?>
<?php if($_SESSION['type'] != '1'){header("Location: /index.php");}?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-slider.min.css">
    <link rel="stylesheet" href="css/header.css?qqxqwwqqwq">
    <link rel="stylesheet" href="css/style.css?qqsessweweweweeqwqsqgq">
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
<script src="js/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-slider.min.js"></script>
<script src="js/modal.js?eeweeqwewqqws"></script>
<script src="js/active_page.js?eeqqqйqqewq"></script>
<script src="js/login_valid.js?eewqwуewqqqqqew"></script>
<script src="js/reg_valid.js?qqqqqqewцqeqe"></script>
<script src="js/vacancy_valid.js?eqqqeeqweqqqqew"></script>
</body>
</html>