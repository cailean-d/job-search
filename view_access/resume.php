<?php 
    // не пускать на страницу, если пользователь не авторизирован
    if(!isset($_SESSION['authorized'])){
        header("Location: /index.php");
    }

    // получение данных о резюме
    include('./scripts/read/get_resume.php'); 

    // если это не обычный пользователь, не пускать на страницу резюме или есть нет id
    if( ($_GET['page'] === "add" && $_SESSION['type'] != "0") || 
        ($_GET['page'] === "edit" && $_SESSION['type'] != "0") || 
        (!isset($_GET['id']) && $_SESSION['type'] != "0") ){
        header("Location: /index.php");
    }
    
    // не пускать на страницу создания резюме, если оно уже создано
    if($_GET['page'] === "add" && isset($is_result)){
        header("Location: /resume.php");
    }

    // не пускать на страницу редактирования резюме, если его не существует
    if($_GET['page'] === "edit" && !isset($is_result)){
        header("Location: /resume.php");
    }