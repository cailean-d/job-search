<?php
 session_start();
 $page = $_SERVER['REQUEST_URI'];
 strpos($page, "index") || (strpos($page, "/") == "0" && strlen($page) == 1) ? $class1 = "active" : $class1 = "";
 strpos($page, "add_vacancy") ? $class2 = "active" : $class2 = "";
 strpos($page, "registration") ? $class3 = "active" : $class3 = "";
 strpos($page, "resume") ? $class4 = "active" : $class4 = "";
?>
<header id="header">
    <nav>
        <a href="index.php" class=<?=$class1?>>Главная</a>
        <?php if($_SESSION['type'] == '0') : ?>
        <a href="add_vacancy.php" class=<?=$class2?>>Разместить вакансию</a>
        <?php else : ?>
        <a href="resume.php" class=<?=$class4?>>Мое резюме</a>
        <?php endif ?>        
    </nav>
    <div class="search">
        <form action="../index.php">
            <input name="query" type="text" placeholder="найти..."
            value="<?=($_GET['query']) ? $_GET['query'] : ''?>"
            >
            <button type="submit">Поиск</button>
        </form>
    </div>
    <?php if(!isset($_SESSION['authorized'])) : ?>
        <div class="profile">
            <a href="registration.php" class=<?=$class3?>>Регистрация</a>
            <a id="show_modal_login">Войти</a>
        </div>
    <?php else : ?>
        <div class='name'>
            <a href='' style='margin-right:15px'>
                <?=$_SESSION['firstname']." ".$_SESSION['lastname']?>
            </a>
            <div class='logout'>
                Выйти
            </div>
        </div>
    <?php endif ?>
</header>
<div class="modal_login">
    <div class="popup_login">
        <form action="scripts/login.php" method="post">
            <div class="option">
                <h3>Почта</h3>
                <input name="email" type="text" placeholder="Email">
            </div>
            <div class="option">
                <h3>Пароль</h3>
                <input name="password" type="password" placeholder="Пароль">
            </div>
            <input type="submit" value="Войти">
        </form>
    </div>
</div>