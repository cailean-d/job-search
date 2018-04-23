<?php

    final class AdminController extends Controller{

        public function __construct(array $routerVars){

            parent::__construct($routerVars);

        }

        public function render(){

            include realpath(__DIR__ . '/../views/AdminView.php');

        }

    }