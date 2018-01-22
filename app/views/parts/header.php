<header id="header">


    <nav>
        <a id="index_page" href="/">
        <span>Главная</span>
        </a>

        
        <?php if($user['type'] == '1') : ?>      <!-- Работодатель -->


            <a id="add_vacancy_page" href="vacancy/add">
                <span>Разместить вакансию</span> 
            </a>
            <a id="my_vacancies_page" href="vacancy">
                <span>Мои вакансии</span>
            </a>


        <?php elseif($user['type'] == '0') : ?>     <!-- Пользователь -->


            <a id="resume_page" href="resume">
                <span>Мое резюме</span>
            </a>


        <?php endif ?>        
    </nav>


    <?php if($user['authorized'] == true) : ?>     <!-- Для авторизованного пользователя -->
    

        <div class='name'>

            <a href='#' class="dropdown-toggle">
                <span class="dd">
                    <?=$user['firstname']." ".$user['lastname']?>
                </span>
            </a>
            <div class="avatar">
                <label for="avatar_upload" class="avatar mb-0 hand" title="Загрузить фото">
                    <img src="<?=$avatar->getSource()?>" alt="avatar" id="avatar_preload">
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

    <?php else : ?>     <!-- Для неавторизованного пользователя -->


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


    <?php endif ?>
    
</header>