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

    Router::get("resume/add", function($vars){

        return new ResumeEditController(get_defined_vars(), 'add');
    
    });

    Router::get("resume/edit", function($vars){

        return new ResumeEditController(get_defined_vars(), 'edit');
    
    });

    Router::get("vacancy", function($vars){

        return new OwnVacanciesController(get_defined_vars());

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

        $root = realpath(__DIR__.'/..');



        function getClass($class){
            

            $dir = new RecursiveDirectoryIterator(__DIR__);
            $iterator = new RecursiveIteratorIterator($dir);

            foreach($iterator as $file) {

                if(preg_match('/\\'.'\\'.$class.'\.php/', $file)){

                    echo  $file ."<br>";
                    break;

                }
            }

        }


        getClass('Database');

        // $user = new User(null, "Вася", "Петрович", "test@test.com", "123456", "0");

        // $avatar = Experience::getAll();
        // $avatar = new Experience("eqeq", "13", "new post", "new company", "new city", "3", "Январь 2012 - Сентябрь 2014", "new functions");

        // $avatar = Resume::getAll();

        // $avatar = new View("QWERTYQQWE", "404");

        // $avatar->render();


        // echo "<pre>";
        // var_dump($files);
        // echo "</pre>";


    });

    Router::PageNotFound(function(){

        return new ErrorPageController(get_defined_vars());

    });
