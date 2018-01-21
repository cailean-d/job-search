<?php 

        class Controller {

        public static function getData(){}

        public static function setRouterVariables(array $routerVars, array &$data){
            
            if($routerVars){

                foreach ($routerVars as $key => $value) {
                    
                    $data[$key] = $value;

                }

            }

            $data['user']['id'] = $_SESSION['id'];
            $data['user']['authorized'] = $_SESSION['authorized'];
            $data['user']['firstname'] = $_SESSION['firstname'];
            $data['user']['lastname'] = $_SESSION['lastname'];
            $data['user']['type'] = $_SESSION['type'];

        }

        public static function setAccess(){}

        public static function init(array $routerVars = null){}

    }