<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/">
    <link rel="shortcut icon" href="favicon.png">

    <!--<Deject>-->
    <link rel="stylesheet" href="public/stylesheet/lib/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="public/stylesheet/lib/bootstrap-grid.min.css">
    <link rel="stylesheet" href="public/stylesheet/lib/bootstrap.min.css">
    <link rel="stylesheet" href="public/stylesheet/lib/bootstrap-slider.min.css">
    <link rel="stylesheet" href="public/stylesheet/lib/datepicker.min.css">
    <link rel="stylesheet" href="public/stylesheet/style.css?qqweqeeeqqeqqqgq">
    <link rel="stylesheet" href="public/stylesheet/vacancy.css?eqweeeqwqwweqqeqq">
    <link rel="stylesheet" href="public/stylesheet/filter.css?qqeeeqewqwwwqq">
    <link rel="stylesheet" href="public/stylesheet/header.css?qqxqweweqwqwqqwq">
    <link rel="stylesheet" href="public/stylesheet/my_vacancies.css?qqqeqweqwwqq">
    <link rel="stylesheet" href="public/stylesheet/full_vacancy.css?qeeeqwewqqewgq">
    <link rel="stylesheet" href="public/stylesheet/404.css?eqqqqeeqqewqew">
    <!--</Deject>-->

    
    <!-- inject:css -->
    <!-- endinject -->
    <title><?=$title?></title>
</head>
<body>

    <div class="wrapper">

        <!-- шапка сайта -->
        <?php include("app/views/parts/header.php")?>

        <div class="app-body">

            <!-- загрузка основного части страницы -->
            <?php 
            
                include(__DIR__.'/../'. $body);
            
            ?>
            

        </div>
    </div>


    <!-- модальное окно загрузки -->
    <div class="modal-disable">
        <i class="fas fa-spinner fa-pulse fa-10x"></i>
    </div>
    
    <!-- модальный Alert -->
    <?php include("app/views/parts/modal_alert.php")?>

    <!-- модальный Confirm -->
    <?php include("app/views/parts/modal_confirm.php")?>    
    

    <!--<Deject>-->
    <script src="public/javascript/lib/jquery.min.js"></script>
    <script src="public/javascript/lib/tether.min.js"></script>
    <script src="public/javascript/lib/bootstrap.min.js"></script>
    <script src="public/javascript/lib/bootstrap-slider.min.js"></script>
    <script src="public/javascript/lib/fontawesome-all.min.js"></script>
    <script src="public/javascript/lib/datepicker.min.js"></script>
    <script src="public/javascript/filter.js?ewqqqqqqws"></script>
    <script src="public/javascript/modal.js?ews"></script>
    <script src="public/javascript/active_page.js?eeeewqweqwewq"></script>
    <script src="public/javascript/login_valid.js?wqqeqwqewqqqew"></script>
    <script src="public/javascript/reg_valid.js?qqwwцewqewqqeqe"></script>
    <script src="public/javascript/vacancy_valid.js?eqewqqewqeqqqqew"></script>
    <script src="public/javascript/del_vacancy.js?eqqewqeqwqq"></script>
    <script src="public/javascript/resume.js?kqwwqeqweqeqwq"></script>
    <script src="public/javascript/vacancy_send_resume.js?qqqqewewew"></script>
    <!--</Deject>-->
    
    <!-- inject:js -->
    <!-- endinject -->
</body>
</html>