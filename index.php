<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png">

    <!--<Deject>-->
    <link rel="stylesheet" href="public/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="public/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/bootstrap-slider.min.css">
    <link rel="stylesheet" href="public/css/datepicker.min.css">
    <link rel="stylesheet" href="public/css/style.css?qqweqeeeqqeqqqgq">
    <link rel="stylesheet" href="public/css/vacancy.css?eqweeeqwqwweqqeqq">
    <link rel="stylesheet" href="public/css/filter.css?qqeeeqewqwwwqq">
    <link rel="stylesheet" href="public/css/header.css?qqxqweweqwqwqqwq">
    <link rel="stylesheet" href="public/css/my_vacancies.css?qqqeqweqwwqq">
    <link rel="stylesheet" href="public/css/full_vacancy.css?qeeeqwewqqewgq">
    <!--</Deject>-->

    
    <!-- inject:css -->
    <!-- endinject -->
    <title><?=$pageTitle?></title>
</head>
<body>

    <div class="wrapper">

        <!-- шапка сайта -->
        <?php include("views/parts/header.php")?>

        <div class="app-body">

            <!-- загрузка основного части страницы -->
            <?php include($pageBodyURL)?>

        </div>
    </div>


    <!-- модальное окно загрузки -->
    <div class="modal-disable">
        <i class="fas fa-spinner fa-pulse fa-10x"></i>
    </div>
    
    <!-- модальный Alert -->
    <?php include("views/parts/modal_alert.php")?>

    <!-- модальный Confirm -->
    <?php include("views/parts/modal_confirm.php")?>    
    

    <!--<Deject>-->
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/tether.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/bootstrap-slider.min.js"></script>
    <script src="public/js/fontawesome-all.min.js"></script>
    <script src="public/js/filter.js?ewqqqqqqws"></script>
    <script src="public/js/modal.js?ews"></script>
    <script src="public/js/active_page.js?eeeewqweqwewq"></script>
    <script src="public/js/login_valid.js?wqqeqwqewqqqew"></script>
    <script src="public/js/reg_valid.js?qqwwцewqewqqeqe"></script>
    <script src="public/js/vacancy_valid.js?eqewqqewqeqqqqew"></script>
    <script src="public/js/del_vacancy.js?eqqewqeqwqq"></script>
    <script src="public/js/resume.js?kqwwqeqweqeqwq"></script>
    <script src="public/js/vacancy_send_resume.js?qqqqewewew"></script>
    <!--</Deject>-->
    
    <!-- inject:js -->
    <!-- endinject -->
</body>
</html>