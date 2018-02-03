<?php

    session_start();

    require __DIR__.'/app/autoload.php';
    require __DIR__.'/app/middleware.php';
    require __DIR__.'/app/api.php';
    require __DIR__.'/app/router.php';

    Application::start();
