<?php

    require_once __DIR__.'/core/Router.php';
    require_once __DIR__.'/controllers/VacanciesController.php';
    require_once __DIR__.'/controllers/ResumeController.php';
    require_once __DIR__.'/controllers/ErrorPageController.php';


   
    // $_ResumeController = new ResumeController();
    // $_ErrorPageController = new ErrorPageController();


    Router::get("", function($router){

        $_VacanciesController = new VacanciesController($router);
        $_VacanciesController->render();
    
    });

    Router::get("resume", function($router){
        
        // $_ResumeController->init(get_defined_vars());
    
    });

    Router::get("resume/:id{number}", function($router){

        // $_ResumeController->init(get_defined_vars());
    
    });

    Router::get("resume/add", function($vars){

        $_GET['page'] = 'add';
        Router::renderView("Добавить резюме", "resume");
    
    });

    Router::get("resume/edit", function($vars){

        $_GET['page'] = 'edit';
        Router::renderView("Редактировать резюме", "resume");
    
    });

    Router::get("vacancy", function($vars){

        Router::renderView("Мои вакансии", "my_vacancies");

    });

    Router::get("vacancy/:id{number}", function($vars){

        $_GET['id'] = $vars['id'];
        Router::renderView("Вакансия", "vacancy");
    
    });

    Router::get("vacancy/add", function($vars){

        $_GET['page'] = 'add';
        Router::renderView("Добавить вакансию", "add_vacancy");
    
    });

    Router::get("vacancy/edit/:id{number}", function($vars){

        $_GET['page'] = 'edit';
        $_GET['id'] = $vars['id'];
        Router::renderView("Редактировать вакансию", "add_vacancy");
    
    });

    Router::get("admin", function($vars){

        echo "admin panel";
    
    });

    Router::get("test", function($vars){

        // require __DIR__.'/app/models/User.php';
        // require __DIR__.'/core/View.php';


        // $user = new User(null, "Вася", "Петрович", "test@test.com", "123456", "0");

        // $avatar = Experience::getAll();
        // $avatar = new Experience("eqeq", "13", "new post", "new company", "new city", "3", "Январь 2012 - Сентябрь 2014", "new functions");

        // $avatar = Resume::getAll();

        // $avatar = new View("QWERTYQQWE", "404");

        // $avatar->render();


        echo "<pre>";
        var_dump($avatar);
        echo "</pre>";


    });

    Router::PageNotFound(function(){

        $_ErrorPageController->init(get_defined_vars());

    });
