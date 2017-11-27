<?php session_start();?>
<?php if(isset($_SESSION['authorized'])){header("Location: /index.php");}?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="css/style.css?qqseeewweуцwewsqgq">
    <link rel="stylesheet" href="css/reg.css?qqseeweewуцqwqewsqgq">
    <title>Регистрация</title>
</head>
<body>
    <div class="wrapper">
        <?php include("parts/header.php")?>
        <div class="app-body">
            <main>
                <?php include("parts/reg.php")?>
            </main>
        </div>
    </div>
<script src="js/modal.js?qуцeeq"></script>
<script src="js/reg_valid.js?qуewewewуйуйуйцeqeqweqqeeweqewqewцуц"></script>
<script src="js/active_page.js?e"></script>
</body>
</html>