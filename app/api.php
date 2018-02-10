<?php

    $_BASE_URL = 'api/1.0.0/';

    $dir = new RecursiveDirectoryIterator(__DIR__ . '/api');
    $iterator = new RecursiveIteratorIterator($dir);

    foreach($iterator as $file) {

        if(preg_match('/.*\.php/', $file)){

            require_once $file;

            $tmp = explode(DIRECTORY_SEPARATOR, $file);
            $file = end($tmp);
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