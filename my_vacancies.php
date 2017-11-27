<?php session_start();?>
<?php if($_SESSION['type'] != '1'){header("Location: /index.php");}?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="css/style.css?qssqqqqqqewqqesqgq">
    <link rel="stylesheet" href="css/vacancy.css?qssqqqqqqewqqesqgq">
    <title>Вакансии</title>
</head>
<body>
    <div class="wrapper">
        <?php include("parts/header.php")?>
        <div class="app-body">
            <main>
                <?php include('parts/my_vacancies.php');?>
            </main>
        </div>
    </div>
<script src="js/modal.js?eqqws"></script>
<script src="js/active_page.js?e"></script>
</body>
</html>