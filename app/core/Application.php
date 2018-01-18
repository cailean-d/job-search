<?php

    class Application {

        public static function start(){

            require __DIR__.'/../router.php';
            require __DIR__.'/../api.php';

        }

    }