<?php

    class Router{

        private static $validRoute = '/^(([a-z]+)|(:[a-z]+(\{(.*)\})?))(\/(([a-z]+)|(:[a-z]+(\{(.*)\})?))?)*$/';

        public static $routes = array();

        private static function isRouteValid(string $route){
            
            if($route == ""){

                return true;

            } else if (preg_match(self::$validRoute, $route)){
                
                return true;

            } else {

                return false;

            }
        }

        private static function getRequestURL(){

            $request = $_SERVER['REQUEST_URI'];
            $query = $_SERVER['QUERY_STRING'];
            
            if(!empty($_SERVER['QUERY_STRING'])){

                return substr($request, 1, strpos($request, $query) - 1);

            } else {

                return substr($request, 1);

            }

        }

        private static function createRegexpURL(string $route){

            if(self::isRouteValid($route) === true){

                if($route !== ""){
                    
                    $route = preg_replace('/\//', '\/', $route);
                    $route = preg_replace('/:([a-z]+)\{number\}\/?/', '(?<$1>\d+)', $route);
                    $route = preg_replace('/:([a-z]+)\{word\}\/?/', '(?<$1>[A-Za-z]+)', $route);
                    $route = preg_replace('/:([a-z]+)\{(.*)\}\/?/', '(?<$1>$2)', $route);
                    $route = preg_replace('/:([a-z]*)\/?/u', '(?<$1>[\w]+)', $route);
                    
                }

                return '/^' . $route . '\/?$/';

            } else {

                throw new Exception('Incorrect URL Pattern.');

            }

        }

        public static function get(string $url, callable $callback){

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                array_push(self::$routes, self::createRegexpURL($url));

                if(preg_match(self::createRegexpURL($url), self::getRequestURL(), $matches)){
                    
                    $callback($matches);

                }
                
            }

        }

        public static function post(string $url, callable $callback){

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if(preg_match(self::createRegexpURL($url), self::getRequestURL(), $matches)){
                    
                    $callback($matches);

                }
                
            }

        }

        public static function put(string $url, callable $callback){

            if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
                
                if(preg_match(self::createRegexpURL($url), self::getRequestURL(), $matches)){
                    
                    $callback($matches);

                }
                
            }

        }

        public static function patch(string $url, callable $callback){

            if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {

                if(preg_match(self::createRegexpURL($url), self::getRequestURL(), $matches)){
                    
                    $callback($matches);

                }
                
            }

        }

        public static function delete(string $url, callable $callback){

            if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

                if(preg_match(self::createRegexpURL($url), self::getRequestURL(), $matches)){
                    
                    $callback($matches);
                    
                }
                
            }

        }

        public static function redirect(string $url, string $redirectURL){

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                if(preg_match(self::createRegexpURL($url), self::getRequestURL(), $matches)){

                    if(strpos($redirectURL, "http") === false){

                        if(empty($_SERVER['HTTPS'])){

                            $protocol = "http";

                        } else {

                            $protocol = "https";

                        }

                        $server = $_SERVER['HTTP_HOST'];

                        header("Location: $protocol://$server/$redirectURL");

                    } else {

                        header("Location: " . $redirectURL);

                    }

                    
                }
                
            }

        }

        public static function renderView(string $title, string $view){

            $pageTitle = $title;
            $pageBodyURL = 'views/'.$view.'.php';
            
            include __DIR__.'/../public/index.php';

        }

        public static function PageNotFound(callable $callback){

            $matched = false;
            
            foreach (self::$routes as $route) {
               
                if(preg_match($route, self::getRequestURL(), $matches)){
                    
                    $matched = true;
                    break;
                    
                }

            }

            if($matched === false){

                $callback();

            }

        }

    }