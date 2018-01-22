<?php

    require_once __DIR__.'/../core/Controller.php';

    final class ErrorPageController extends Controller{

        public function __construct(array $routerVars){

            parent::__construct($routerVars);

            $this->view->setTitle('Страница не найдена');
            $this->view->setView('ErrorPageView');

        }

    }