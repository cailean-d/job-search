<?php session_start();?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/style.css?qssqqqqqqewqqesqgq">
    <link rel="stylesheet" href="css/vacancy.css?qewqeeweweqqeqq">
    <link rel="stylesheet" href="css/filter.css?qewqeeqewewqqwqqqqqqqqwweqqeqq">
    <title>Вакансии</title>
</head>
<body>
    <div class="wrapper">
        <?php include("parts/header.php")?>
        <div class="app-body">
            <main>
                <?php include("parts/vacancies.php")?>
            </main>
            <aside>
                <?php include("parts/filters.php")?>
            </aside>
        </div>
    </div>
<script src="js/script.js?eqйqws"></script>
<script src="js/modal.js?eewewewewewewqqws"></script>
</body>
</html>