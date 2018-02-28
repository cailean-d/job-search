<header id="header">


    <nav>
        <a class="__home link" href="/">
            <div class="icon">
                <i class="fas fa-home fa-lg"></i>
            </div>
            <div class="text">
                Главная
            </div>
        </a>
        <a class="header-menu-toggle link __toggle-hmenu">
            <i class="fas fa-bars fa-lg"></i>
        </a>
        
        <div class="header-menu">
            <?php if($user['type'] == '1') : ?>      <!-- Работодатель -->

                <a class="__vacancy-add link" href="vacancy/add">
                    <div class="text">
                        Разместить вакансию
                    </div>
                </a>
                <a class="__my-vacancies link" href="vacancy">
                    <div class="text">
                        Мои вакансии
                    </div>
                </a>

                <?php elseif($user['type'] == '0') : ?>     <!-- Пользователь -->


                <a href="resume" class="__resume link">
                    <div class="text">
                        Мое резюме
                    </div>
                </a>

            <?php endif ?>   
        </div>
         

    </nav>


    <?php if($user['authorized'] == true) : ?>     <!-- Для авторизованного пользователя -->
    

        <div class='name'>

            <a href='#' class="link dropdown-toggle __dropdown_btn">
                <i class="fas fa-user fa-lg"></i>
            </a>
            <div class="avatar">
                <label for="avatar_upload" class="avatar mb-0 hand" title="Загрузить фото">
                    <img 
                    
                    src="<?

                        if(!empty($own_avatar->getSource())){

                            echo $own_avatar->getSource();

                        } else {

                            echo '/../../../public/images/user.jpg';
                            
                        }
                    
                    
                    ?>" alt="avatar" id="avatar_preload">
                </label>
                <input type="file" id="avatar_upload" hidden>
            </div>
            <div class='drop_menu __drop_menu'>
                <div>
                    <button class="__modal_profile_btn triangle-up">
                        Профиль
                    </button>
                </div>
                <div>
                    <button class="logout">
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

    <div class="header-menu-m">

        <?php if($user['type'] == '1') : ?>      <!-- Работодатель -->

            <a class="__vacancy-add list-group-item list-group-item-action" href="vacancy/add">
                <div class="text">
                    Разместить вакансию
                </div>
            </a>
            <a class="__my-vacancies list-group-item list-group-item-action" href="vacancy">
                <div class="text">
                    Мои вакансии
                </div>
            </a>

            <?php elseif($user['type'] == '0') : ?>     <!-- Пользователь -->


            <a href="resume" class="__resume list-group-item list-group-item-action">
                <div class="text">
                    Мое резюме
                </div>
            </a>

        <?php endif ?>   

    </div>
    
</header>