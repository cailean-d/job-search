<?php

    final class ApiController extends Controller{

        public function __construct(array $routerVars){

            parent::__construct($routerVars);

            $this->view->setTitle('API Документация');
            $this->view->setView('ApiView');

        }

    }