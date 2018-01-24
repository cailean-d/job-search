<?php

    final class OwnVacanciesController extends Controller{

        public function __construct($routerVars){

            parent::__construct($routerVars);

            $this->view->setTitle('Мои вакансии');
            $this->view->setView('OwnVacanciesView');

            $this->data['vacancy'] = Vacancy::getJoinedByUserId($this->data['user']['id']);

        }

        protected function setAccess(){

            if($this->data['user']['type'] != '1'){

                Router::redirectTo("/");

            }

        }

    }