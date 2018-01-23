<?php 

    spl_autoload_register(function ($class) {

        $dir = new RecursiveDirectoryIterator(__DIR__);
        $iterator = new RecursiveIteratorIterator($dir);

        foreach($iterator as $file) {

            if(preg_match('/\\'.'\\'.$class.'\.php/', $file)){

                require_once $file;
                break;
                
            }
        }

        return true;

    });