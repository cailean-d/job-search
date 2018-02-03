<?php

    Router::PageNotFound(ErrorPageController::class);

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

