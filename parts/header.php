<header id="header">
    <nav>
        <a id="index_page" href="index.php">Главная</a>
        <?php if($_SESSION['type'] == '1') : ?>
        <a id="add_vacancy_page" href="add_vacancy.php">Разместить вакансию</a>
        <a id="my_vacancies_page" href="my_vacancies.php">Мои вакансии</a>
        <?php elseif($_SESSION['type'] == '0') : ?>
        <a id="resume_page" href="resume.php">Мое резюме</a>
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
            <a id="registration_page" href="registration.php">Регистрация</a>
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