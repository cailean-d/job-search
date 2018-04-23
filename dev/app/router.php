<?php

    Router::PageNotFound(ErrorPageController::class);

    Router::get("", VacanciesController::class);

    Router::get("resume", ResumeController::class);

    Router::get("resume/:id{number}", ResumeController::class);

    Router::get("resume/add", ResumeEditController::class, 'add');

    Router::get("resume/edit", ResumeEditController::class, 'edit');

    Router::get("vacancy", OwnVacanciesController::class);

    Router::get("vacancy/:id{number}", VacancyController::class);

    Router::get("vacancy/add", VacancyEditController::class, 'add');

    Router::get("vacancy/edit/:id{number}", VacancyEditController::class, 'edit');

    Router::get("api", ApiController::class);

    Router::get("admin", AdminController::class);
