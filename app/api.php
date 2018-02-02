<?php

    $_BASE_URL = 'api/';

    $dir = new RecursiveDirectoryIterator(__DIR__ . '/api');
    $iterator = new RecursiveIteratorIterator($dir);

    foreach($iterator as $file) {

        if(preg_match('/.*\.php/', $file)){

            require_once $file;

            $file = end(explode('\\', $file));
            $class = substr($file, 0, strlen($file) - 4);

            $api_methods = $class::init();

            foreach ($api_methods as $api_method) {

                $method = $api_method['method'];
                $url = $api_method['url'];
                $handler = $api_method['handler'];

                Router::$method($_BASE_URL . $url, function($router) use ($class, $handler) {

                    $class::$handler($router);
    
                });

            }

        }

    }