<?php 

        abstract class Controller {

        abstract public static function getData();

        abstract public static function setAccess();

        abstract public static function init(array $routerVars = null);

    }