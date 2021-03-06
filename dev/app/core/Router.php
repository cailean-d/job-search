<?php

    class Router{

        private static $validRoute = '/^(([a-z0-9\.\_]+)|(:[a-z0-9\.\_]+(\{(.*)\})?))(\/(([a-z0-9\.\_]+)|(:[a-z]+(\{(.*)\})?))?)*$/';

        private static $get_routes = array();
        private static $post_routes = array();
        private static $put_routes = array();
        private static $patch_routes = array();
        private static $delete_routes = array();

        private static $middleware = array();
        private static $page404;

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

                return substr($request, 1, strpos($request, $query) - 2);

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

        private static function getBrowser(){

            $user_agent = $_SERVER['HTTP_USER_AGENT'];

            if(strpos($user_agent, 'OPR')){

                return 'Opera';
                
            } else if(strpos($user_agent, 'Firefox')){

                return 'Firefox';
                
            } else if(strpos($user_agent, 'Chrome')){

                return 'Chrome';
                
            } else if(strpos($user_agent, '.NET')){
                
                return 'Internet Explorer';
                
            }

        }

        private static function isBrowser(){

            if( self::getBrowser() == 'Opera' || 
                self::getBrowser() == 'Firefox' ||
                self::getBrowser() == 'Chrome' ||
                self::getBrowser() == 'Internet Explorer' ){

                return true;

            } else {

                return false;

            }

        }

        public static function get(string $url, $callback, $misc = null){

            array_push(self::$get_routes, [

                'url' => $url,
                'url_pattern' => self::createRegexpURL($url),
                'handler' => $callback,
                'misc' => $misc

            ]);

        }

        public static function post(string $url, $callback){

            array_push(self::$post_routes, [

                'url' => $url,
                'url_pattern' => self::createRegexpURL($url),
                'handler' => $callback

            ]);

        }

        public static function put(string $url, $callback){

            array_push(self::$put_routes, [

                'url' => $url,
                'url_pattern' => self::createRegexpURL($url),
                'handler' => $callback

            ]);

        }

        public static function patch(string $url, $callback){

            array_push(self::$patch_routes, [

                'url' => $url,
                'url_pattern' => self::createRegexpURL($url),
                'handler' => $callback

            ]);

        }

        public static function delete(string $url, $callback){

            array_push(self::$delete_routes, [

                'url' => $url,
                'url_pattern' => self::createRegexpURL($url),
                'handler' => $callback

            ]);

        }

        public static function middleware(callable $callback){

            array_push(self::$middleware, $callback);

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

        public static function redirectTo(string $url){

            header("Location: " . $url);

        }

        public static function PageNotFound($callback){

            self::$page404 = $callback;

        }

        public static function getGetRoutes(){

            $routes = array();

            foreach (Router::$get_routes as $route) {

                array_push($routes, $route['url']);

            }

            return $routes;

        }

        public static function getPostRoutes(){

            $routes = array();

            foreach (Router::$post_routes as $route) {

                array_push($routes, $route['url']);

            }

            return $routes;

        }

        public static function getPutRoutes(){

            $routes = array();

            foreach (Router::$put_routes as $route) {

                array_push($routes, $route['url']);

            }

            return $routes;

        }

        public static function getPatchRoutes(){

            $routes = array();

            foreach (Router::$patch_routes as $route) {

                array_push($routes, $route['url']);

            }

            return $routes;

        }

        public static function getDeleteRoutes(){

            $routes = array();

            foreach (Router::$delete_routes as $route) {

                array_push($routes, $route['url']);

            }

            return $routes;

        }

        public static function getRoutes(){

            $routes['GET'] = self::getGetRoutes();
            $routes['POST'] = self::getPostRoutes();
            $routes['PUT'] = self::getPutRoutes();
            $routes['PATCH'] = self::getPatchRoutes();
            $routes['DELETE'] = self::getDeleteRoutes();

            return $routes;

        }

        public static function doGet(){

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                foreach (Router::$get_routes as $route) {

                    if(preg_match($route['url_pattern'], self::getRequestURL(), $matches)){

                        $handler = $route['handler'];

                        if(is_string($handler)){

                            if(class_exists($handler)){

                                $router['router'] = $matches;

                                $_Controller = new $handler($router, $route['misc']);
    
                                if(is_subclass_of($_Controller, 'Controller')){
    
                                    $_Controller->render();
        
                                } else {
    
                                    throw new Exception('Class must be inherited from Controller');
    
                                }
    
                            } else {

                                throw new Exception('Class does not exist');

                            }

                        } else {
                            
                            $_Controller = $handler($matches);

                            if(method_exists($_Controller, 'render')){

                                $_Controller->render();                        

                            }

                        }

                    }

                }
                
            }

        }

        public static function doPost(){

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                foreach (Router::$post_routes as $route) {

                    if(preg_match($route['url_pattern'], self::getRequestURL(), $matches)){

                        $handler = $route['handler'];
                        
                        $handler($matches);

                    }
                
                }
                
            }

        }

        public static function doPut(){

            if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

                foreach (Router::$put_routes as $route) {

                    if(preg_match($route['url_pattern'], self::getRequestURL(), $matches)){

                        $handler = $route['handler'];
                        
                        $handler($matches);

                    }
                
                }
                
            }

        }

        public static function doPatch(){

            if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {

                foreach (Router::$patch_routes as $route) {

                    if(preg_match($route['url_pattern'], self::getRequestURL(), $matches)){

                        $handler = $route['handler'];
                        
                        $handler($matches);

                    }
                
                }
                
            }

        }

        public static function doDelete(){

            if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

                foreach (Router::$delete_routes as $route) {

                    if(preg_match($route['url_pattern'], self::getRequestURL(), $matches)){

                        $handler = $route['handler'];
                        
                        $handler($matches);

                    }
                
                }
                
            }

        }

        public static function doMiddleware(){

            foreach (Router::$middleware as $handler) {

                $handler();
            
            }

        }

        public static function doPage404(){

            if ($_SERVER['REQUEST_METHOD'] == 'GET' && self::isBrowser()) {

                $matched = false;
            
                foreach (self::$get_routes as $route) {
    
                    if(preg_match($route['url_pattern'], self::getRequestURL(), $matches)){
                        
                        $matched = true;
                        break;
                        
                    }
    
                }
    
                if($matched === false){

                    $callback = self::$page404;

                    if(is_string($callback)){

                        if(class_exists($callback)){

                            $router['router'] = $callback;

                            $_Controller = new $callback($router);

                            if(is_subclass_of($_Controller, 'Controller')){

                                $_Controller->render();
    
                            } else {

                                throw new Exception('Class must be inherited from Controller');

                            }

                        } else {

                            throw new Exception('Class does not exist');

                        }

                    } else {
                        
                        $_Controller = $callback($matches);

                        if(method_exists($_Controller, 'render')){

                            $_Controller->render();                        

                        }

                    }
    
                }

            }

        }

        public static function init(){

            self::doMiddleware();
            self::doGet();
            self::doPage404();
            self::doPost();
            self::doPut();
            self::doPatch();
            self::doDelete();

        }

    }