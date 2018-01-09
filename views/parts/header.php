<header id="header">
    <nav>
        <a id="index_page" href="/">
        <span>Главная</span>
        </a>
        <?php if($_SESSION['type'] == '1') : ?>
            <a id="add_vacancy_page" href="vacancy/add">
                <span>Разместить вакансию</span> 
            </a>
            <a id="my_vacancies_page" href="vacancy">
                <span>Мои вакансии</span>
            </a>
        <?php elseif($_SESSION['type'] == '0') : ?>
            <a id="resume_page" href="resume">
                <span>Мое резюме</span>
            </a>
        <?php endif ?>        
    </nav>
    <?php if(!isset($_SESSION['authorized'])) : ?>
        <div class="side-menu">
            <a id="reg_link" data-toggle="modal" data-target="#modal_reg">
                <span>
                    Регистрация
                </span> 
            </a>
            <a id="login_link" data-toggle="modal" data-target="#modal_login">
                <span>
                    Войти
                </span> 
            </a>
        </div>
    <?php else : ?>
    <?php include('scripts/read/get_avatar.php'); ?>
        <div class='name'>
            <a href='#' class="dropdown-toggle">
                <span class="dd">
                    <?=$_SESSION['firstname']." ".$_SESSION['lastname']?>
                </span>
            </a>
            <div class="avatar">
                <label for="avatar_upload" class="avatar mb-0 hand" title="Загрузить фото">
                    <img src="<?=$avatar?>" alt="avatar" id="avatar_preload">
                </label>
                <input type="file" id="avatar_upload" hidden>
            </div>
            <div class='logout triangle-up'>
                <div>
                    <button>
                        Выйти
                    </button>
                </div>
            </div>
        </div>
    <?php endif ?>
</header>
<?php 
    if(!isset($_SESSION['authorized'])){
        include('views/parts/modal_login.php');
        include('views/parts/modal_reg.php');
    }
?>