<?php

    require __DIR__.'/core/Router.php';

    Router::get("", function($vars){
        
        Router::renderView("Вакансии", "vacancies");
    
    });

    Router::get("resume", function($vars){
        
        Router::renderView("Мое резюме", "resume_show");
    
    });

    Router::get("resume/:id{number}", function($vars){

        $_GET['id'] = $vars['id'];
        Router::renderView("Резюме", "resume_show");
    
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

    Router::PageNotFound(function(){

        Router::renderView("Страница не найдена", "404");

    });
