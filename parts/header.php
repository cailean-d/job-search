<?php include('scripts/active_page.php');?>
<header id="header">
    <nav>
        <a href="index.php" class=<?=$class1?>>Главная</a>
        <?php if($_SESSION['type'] == '1') : ?>
        <a href="add_vacancy.php" class=<?=$class2?>>Разместить вакансию</a>
        <?php elseif($_SESSION['type'] == '0') : ?>
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
<?php 
    if(!isset($_SESSION['authorized'])){
        include('parts/login_modal.php');
    }
?>