<?php

    session_start();

    require("scripts/route_utils.php");

    if(getRoute("")){

        drawPage("Вакансии", "views/vacancies.php");

    } else if(getRoute("resume")){

        drawPage("Мое резюме", "views/resume.php");

    } else if(getRoute("resume/:id[number]", $routeVars)){

        $_GET['id'] = $routeVars['id'];
        drawPage("Резюме", "views/resume.php");

    } else if(getRoute("resume/add")){

        $_GET['page'] = 'add';
        drawPage("Добавить резюме", "views/resume.php");

    } else if(getRoute("resume/edit")){

        $_GET['page'] = 'edit';
        drawPage("Вакансия", "views/vacancy.php");

    } else if(getRoute("vacancy")){

        drawPage("Мои вакансии", "views/my_vacancies.php");

    } else if(getRoute("vacancy/:id[number]", $routeVars)){

        $_GET['id'] = $routeVars['id'];
        drawPage("Вакансия", "views/vacancy.php");

    } else if(getRoute("vacancy/add")){

        drawPage("Добавить вакансию", "views/add_vacancy.php");

    } else if(getRoute("vacancy/edit/:id[number]", $routeVars)){

        $_GET['page'] = "edit";
        $_GET['id'] = $routeVars['id'];
        drawPage("Редактировать вакансию", "views/add_vacancy.php");

    } else if(getRoute("admin")){

        echo "admin panel";

    } else {

        include("views/404.php");

    }