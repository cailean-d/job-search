<?php

    class Http {

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

        public static function success(){

            http_response_code(200);

            echo json_encode(['success' => true]);

            exit();

        }

    }