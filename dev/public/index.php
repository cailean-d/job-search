<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <base href="/">
        <link rel="shortcut icon" href="favicon.png">

        <link rel="stylesheet" href="public/stylesheet/<?=$view?>.bundle.css?<?=uniqid()?>">

        <!-- <link rel="stylesheet" href="public/stylesheet/lib/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="public/stylesheet/lib/bootstrap-grid.min.css">
        <link rel="stylesheet" href="public/stylesheet/lib/bootstrap.min.css">
        <link rel="stylesheet" href="public/stylesheet/lib/bootstrap-slider.min.css">
        <link rel="stylesheet" href="public/stylesheet/lib/datepicker.min.css">
        <link rel="stylesheet" href="public/stylesheet/style.css?qqweqwqweqqqeqqqgq">
        <link rel="stylesheet" href="public/stylesheet/vacancy.css?eqweeeqqwweqqeqq">
        <link rel="stylesheet" href="public/stylesheet/filter.css?qqqqqweqeqwwqq">
        <link rel="stylesheet" href="public/stylesheet/header.css?qqeqeqqqqqwq">
        <link rel="stylesheet" href="public/stylesheet/my_vacancies.css?qqqeqweqwwqq">
        <link rel="stylesheet" href="public/stylesheet/full_vacancy.css?qeeeqwewqqewgq">
        <link rel="stylesheet" href="public/stylesheet/404.css?eqqqqeeqqewqew"> -->

        
        <title><?=$title?></title>
    </head>
    <body>
 
        <div class="wrapper">
            
            <?php include("app/views/parts/header.php")?>

            <div class="app-body">

                <?php 
                
                    include(__DIR__.'/../'. $body);
                
                ?>
                

            </div>
        </div>


        <!-- <div class="modal-disable">
            <i class="fas fa-spinner fa-pulse fa-10x"></i>
        </div>
         -->
        <?php include("app/views/parts/modal_alert.php")?>

        <?php include("app/views/parts/modal_confirm.php")?>    

        
        <?php 


            if($user['authorized'] !== true){

                include('app/views/parts/modal_login.php');
                include('app/views/parts/modal_reg.php');

            } else {

                include('app/views/parts/modal_profile.php');

            }


        ?>
        

        <script src="public/javascript/<?=$view?>.bundle.js?<?=uniqid()?>"></script>

        <!-- <script src="public/javascript/lib/jquery.min.js"></script>
        <script src="public/javascript/lib/tether.min.js"></script>
        <script src="public/javascript/lib/bootstrap.min.js"></script>
        <script src="public/javascript/lib/bootstrap-slider.min.js"></script>
        <script src="public/javascript/lib/fontawesome-all.min.js"></script>
        <script src="public/javascript/lib/datepicker.min.js"></script>
        <script src="public/javascript/filter.js?ewqqqqqqws"></script>
        <script src="public/javascript/modal.js?eeeqewqqeqeqews"></script>
        <script src="public/javascript/modal_profile.js?eeeweewws"></script>
        <script src="public/javascript/active_page.js?eeqqeqqweqwewq"></script>
        <script src="public/javascript/login_valid.js?wqqeeqqwqewqqqew"></script>
        <script src="public/javascript/reg_valid.js?qqwwцeqeewqewqqeqe"></script>
        <script src="public/javascript/vacancy_valid.js?eqewqqewqeqqqqew"></script>
        <script src="public/javascript/del_vacancy.js?eqqewqeqwqq"></script>
        <script src="public/javascript/resume.js?kqwweqeewewqweqeqwq"></script>
        <script src="public/javascript/vacancy_send_resume.js?qqqqeweeqwew"></script> -->
        
    </body>
</html>