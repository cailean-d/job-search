<?php


    function getRoute ($route, &$route_variables = null){

        if($route !== ""){
                
            if(!preg_match('/^(([a-z]+)|(:[a-z]+(\[(word|number)\])?))(\/(([a-z]+)|(:[a-z]+(\[(word|number)\])?))?)*$/', $route)){
                throw new Exception('Неверный URL Pattern.');
            }
        
            $pattern = [
                '/\//', 
                '/:([a-z]+)\[number\]\/?/', 
                '/:([a-z]+)\[word\]\/?/'
            ];
        
            $replacement = [
                '\/', 
                '(?<$1>\d+)', 
                '(?<$1>[A-Za-z]+)'
            ];
        
            
            $route_pattern = preg_replace($pattern, $replacement, $route);
            $route_pattern = preg_replace('/:([a-z]*)\/?/u', '(?<$1>[\w]+)', $route_pattern);
        
        } else {
            $route_pattern = $route;
        } 
        
        $route_pattern = '/^' . $route_pattern . '\/?$/';
        
        $request = $_SERVER['REQUEST_URI'];
        $query = $_SERVER['QUERY_STRING'];
        
        if(!empty($_SERVER['QUERY_STRING'])){
            $request = substr($request, 1, strpos($request, $query) - 1);
        } else {
            $request = substr($request, 1);
        }
        
        if(preg_match($route_pattern, $request, $matches)){
            $route_variables = $matches;
            return true;
        }
    
    }
    
    function drawPage($pageTitle, $pageBodyURL){
    
        $pageTitle = $pageTitle;
        $pageBodyURL = $pageBodyURL;
        
        include("index.php");
    }