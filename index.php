<?php session_start();?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png">

    <!--<Deject>-->
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-slider.min.css">
    <link rel="stylesheet" href="css/style.css?qqwgq">
    <link rel="stylesheet" href="css/vacancy.css?eqwewweqqeqq">
    <link rel="stylesheet" href="css/filter.css?qqeewwqq">
    <link rel="stylesheet" href="css/header.css?qqxqwwqqwq">
    <!--</Deject>-->
    
    <!-- inject:css -->
    <!-- endinject -->
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

    <!--<Deject>-->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/filter.js?ewqqqqqeqqqqqws"></script>
    <script src="js/modal.js?eeweeqwewqqws"></script>
    <script src="js/active_page.js?eewq"></script>
    <script src="js/login_valid.js?eewqwуewqqqqqew"></script>
    <script src="js/reg_valid.js?qqqqqqewцqeqe"></script>
    <!--</Deject>-->
    
    <!-- inject:js -->
    <!-- endinject -->
</body>
</html>