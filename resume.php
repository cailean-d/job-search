<?php session_start();?>
<?php 
    // не пускать на страницу, если пользователь не авторизирован
    if($_SESSION['type'] != '0'){
        header("Location: /index.php");
    }

    // получение данных о резюме
    include('scripts/get_resume.php'); 
    
    // не пускать на страницу создания резюме, если оно уже создано
    if($_GET['page'] === "add" && isset($is_result)){
        header("Location: /resume.php");
    }

    // не пускать на страницу редактирования резюме, если его не существует
    if($_GET['page'] === "edit" && !isset($is_result)){
        header("Location: /resume.php");
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="css/style.css?qssqqqqqwwwwqqqqeqqqйwqqesqgq">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/datepicker.min.css">
    <title>Резюме</title>
</head>
<body>
    <div class="wrapper">
        <?php include("parts/header.php")?>
        <div class="app-body">
            <main>
                <?php include("parts/my_resume.php")?>
            </main>
        </div>
    </div>
<script src="js/modal.js?eqqws"></script>
<script src="js/active_page.js?e"></script>
<script src="js/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/datepicker.min.js"></script>
<script src="js/resume.js?wwqwqqwqwwwwq"></script>
</body>
</html>