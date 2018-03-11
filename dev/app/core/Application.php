<?php

    class Application {

        private static $root = __DIR__.'/../..';

        public static function getRoot(){
            return realpath(self::$root);
        }

        public static function debug($data){

            echo "<pre>";
            var_dump($data);
            echo "</pre>";

        }

        public static function log($file, $data, $append = true){

            if($append){

                file_put_contents(realpath(__DIR__.'/../logs').DIRECTORY_SEPARATOR.$file, 
                '[ '.date('d-m-Y H:i:m').' ] >> '.preg_replace('/\s+/S', " ", $data). "\r\n", FILE_APPEND);

            } else {

                file_put_contents(realpath(__DIR__.'/../logs').DIRECTORY_SEPARATOR.$file, 
                '[ '.date('d-m-Y H:i:m').' ] >> '.preg_replace('/\s+/S', " ", $data). "\r\n");

            }

        }

        public static function global(array $data){

            foreach($data as $var_name => $var_value) {

                global $$var_name;
                $$var_name = $var_value;

            }

        }

        public static function start(){

            Router::init();

        }

    }