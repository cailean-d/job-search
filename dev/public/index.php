<?php $_view = $view;?>
<?php $dev='dev';$prod='production';$x='';$mode=$dev;if($mode=='dev'){$x='?'.uniqid();}?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <base href="/">
        <link rel="shortcut icon" href="favicon.png">
        <link rel="stylesheet" href="public/style/<?=$_view?>.bundle.css<?=$x?>">
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


        <div class="modal-disable">
            <i class="fas fa-spinner fa-pulse fa-10x"></i>
        </div>
        
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
        
        <script src="public/script/<?=$_view?>.bundle.js<?=$x?>"></script>

    </body>
</html>