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
                '[ '.date('d-m-Y H:i:m').' ] >> '.$data . "\r\n", FILE_APPEND);

            } else {

                file_put_contents(realpath(__DIR__.'/../logs').DIRECTORY_SEPARATOR.$file, 
                '[ '.date('d-m-Y H:i:m').' ] >> '.$data . "\r\n");

            }

        }

        public static function response($data, $code, $json = true){

            http_response_code($code);

            if($json === true) {

                echo json_encode($data);

            } else {

                echo $data;

            }
            
            exit();

        }

        public static function error($data, $code = 400){

            http_response_code($code);

            echo json_encode(['error' => $data]);

            exit();

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