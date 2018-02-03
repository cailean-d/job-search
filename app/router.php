<?php

    Router::get("", VacanciesController::class);

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

    Router::get("api", function($router){

        return new ApiController(get_defined_vars());
    
    });

    Router::get("test", function($router){


    //    Application::debug(Router::$get_routes_test);

        echo "qqqqq";

    //    foreach (Router::$get_routes_test as $v) {

    //         echo $v['url'] . '<br>';
           
    //    }

    //    echo $_SERVER['REMOTE_HOST'] . '<br>';
    //    echo $_SERVER['HTTP_HOST'] . '<br>';
    
    });

    // Router::PageNotFound(function(){

    //     return new ErrorPageController(get_defined_vars());

    // });
