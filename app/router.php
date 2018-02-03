<?php

    Router::get("", VacanciesController::class);

    Router::get("resume", ResumeController::class);

    Router::get("resume/:id{number}", ResumeController::class);

    Router::get("resume/add", ResumeEditController::class);

    Router::get("resume/edit", ResumeEditController::class);

    Router::get("vacancy", OwnVacanciesController::class);

    Router::get("vacancy/:id{number}", VacancyController::class);

    Router::get("vacancy/add", VacancyEditController::class);

    Router::get("vacancy/edit/:id{number}", VacancyEditController::class);

    Router::get("api", ApiController::class);

    Router::get("admin", function($router){

        echo "admin panel";
    
    });


    Router::get("test", function($router){


       Application::debug(Router::getGetRoutes());


    //    foreach (Router::$get_routes_test as $v) {

    //         echo $v['url'] . '<br>';
           
    //    }

    //    echo $_SERVER['REMOTE_HOST'] . '<br>';
    //    echo $_SERVER['HTTP_HOST'] . '<br>';
    
    });

    // Router::PageNotFound(function(){

    //     return new ErrorPageController(get_defined_vars());

    // });
