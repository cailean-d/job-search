<?php

    final class ApiController extends Controller{

        public function __construct(array $routerVars){

            parent::__construct($routerVars);

        }

        public function render(){

            include realpath(__DIR__ . '/../../public/doc/index.html');

        }

    }