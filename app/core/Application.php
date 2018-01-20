<?php

    class Application {

        public static function start(){

            require_once __DIR__.'/../router.php';
            require_once __DIR__.'/../api.php';

        }

    }