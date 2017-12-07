<?php session_start();?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="css/style.css?qssqqqqqeeewewewwwewqewqqesqgq">
    <link rel="stylesheet" href="css/vacancy.css?qewqeeewweweqqeqq">
    <link rel="stylesheet" href="css/filter.css?qewqewqewqqewewweqqeqq">
    <link rel="stylesheet" href="css/login_modal.css?qqwq">
    <title>Вакансии</title>
</head>
<body>
    <div class="wrapper">
        <?php include("parts/header.php")?>
        <div class="app-body">
            <main class="w70">
                <?php include("parts/vacancies.php")?>
            </main>
            <aside>
                <?php include("parts/filters.php")?>
            </aside>
        </div>
    </div>
<script src="js/filter.js?eqйqws"></script>
<script src="js/modal.js?eewewewewewweewewewewewewqqws"></script>
<script src="js/active_page.js?e"></script>
<script src="js/login_valid.js?eew"></script>
</body>
</html>