<?php

    final class ResumesController extends Controller{

        public function __construct($routerVars){

            parent::__construct($routerVars);

            $this->view->setTitle('Список резюме');
            $this->view->setView('ResumesView');

            $this->data['resumes'] = Resume::getAll();
 
        }

        protected function setAccess(){

            if($this->data['user']['type'] != '1'){

                Router::redirectTo("/");

            }
            
        }

    }