<?php

    $dir = new RecursiveDirectoryIterator(__DIR__ . '/api');
    $iterator = new RecursiveIteratorIterator($dir);

    foreach($iterator as $file) {

        if(preg_match('/.*\.php/', $file)){

            require_once $file;

            $file = end(explode('\\', $file));
            $class = substr($file, 0, strlen($file) - 4);

            $class::init();
            
        }

    }