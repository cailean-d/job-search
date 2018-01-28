<?php

    class Application {

        private static $root = __DIR__.'/../..';

        public static function getRoot(){
            return realpath(self::$root);
        }

        public static function start(){

            require_once __DIR__.'/../router.php';
            require_once __DIR__.'/../api.php';

        }

    }