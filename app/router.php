<?php

    Router::get("", function($router){

        return new VacanciesController(get_defined_vars());
    
    });

    Router::get("resume", function($router){
        
        return new ResumeController(get_defined_vars());
    
    });

    Router::get("resume/:id{number}", function($router){

        return new ResumeController(get_defined_vars());
    
    });

    Router::get("resume/add", function($router){

        return new ResumeEditController(get_defined_vars(), 'add');
    
    });

    Router::get("resume/edit", function($router){

        return new ResumeEditController(get_defined_vars(), 'edit');
    
    });

    Router::get("vacancy", function($router){

        return new OwnVacanciesController(get_defined_vars());

    });

    Router::get("vacancy/:id{number}", function($router){

        return new VacancyController(get_defined_vars());
    
    });

    Router::get("vacancy/add", function($router){

        return new VacancyEditController(get_defined_vars(), 'add');
    
    });

    Router::get("vacancy/edit/:id{number}", function($router){

        return new VacancyEditController(get_defined_vars(), 'edit');
    
    });

    Router::get("admin", function($router){

        echo "admin panel";
    
    });

    Router::PageNotFound(function(){

        return new ErrorPageController(get_defined_vars());

    });
