<?php
    try{
        $page = $_SERVER['REQUEST_URI'];
        strpos($page, "index") || (strpos($page, "/") == "0" && strlen($page) == 1) ? $class1 = "active" : $class1 = "";
        strpos($page, "add_vacancy") ? $class2 = "active" : $class2 = "";
        strpos($page, "registration") ? $class3 = "active" : $class3 = "";
        strpos($page, "resume") ? $class4 = "active" : $class4 = "";
    } catch (Exception $e) {
        echo $e->getMessage(); 
    }