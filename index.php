<?php session_start();?>
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
    <link rel="stylesheet" href="css/style.css?qssqqqqqewwqqeeqqgq">
    <link rel="stylesheet" href="css/vacancy.css?eqweweqqeqq">
    <link rel="stylesheet" href="css/filter.css?qqeewqq">
    <link rel="stylesheet" href="css/login_modal.css?qqwq">
    <link rel="stylesheet" href="css/header.css?qqxqwwqqqwqwwwqwwwqqwqwq">
    <title>Вакансии</title>
</head>
<body>
    <div class="container">
        <?php include("parts/header.php")?>
        <div class="app-body">
            <main class="col-8">
                <?php include("parts/vacancies.php")?>
            </main>
            <aside class="col-4">
                <?php include("parts/filters.php")?>
            </aside>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/filter.js?ewqqqqqqqqqqws"></script>
    <script src="js/modal.js?eeweweqwqqeewwwqqws"></script>
    <script src="js/active_page.js?e"></script>
    <script src="js/login_valid.js?eewqqqew"></script>
</body>
</html>