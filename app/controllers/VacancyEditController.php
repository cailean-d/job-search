<?php

    final class VacancyEditController extends Controller{

        public function __construct($routerVars, string $mode){

            parent::__construct($routerVars);

            $this->view->setView('VacancyEditView');

            if($mode == 'add'){

                $this->view->setTitle('Добавить вакансию');
                $this->data['vacancy'] = new Vacancy();
                $this->data['router']['mode'];
                
            } else {

                $this->view->setTitle('Редактировать вакансию');
                $this->data['vacancy'] = Vacancy::getJoined($this->data['router']['id']);
                $this->data['router']['mode'] = $mode;

                $this->redirectOnFailure();
                $this->addInfoToArray();

                $this->data['schedule'] = HelperSchedule::getAll();
                $this->data['industry'] = HelperIndustry::getAll();
                $this->data['workPlace'] = HelperWorkPlace::getAll();
                $this->data['education'] = HelperEducation::getAll();
                $this->data['compSkills'] = HelperCompSkill::getAll();
                $this->data['languages'] = HelperLanguage::getAll();

            }


        }

        protected function setAccess(){

            if($this->data['user']['type'] != '1'){

                Router::redirectTo("/");

            }
            
        }

        private function redirectOnFailure(){

            if(empty($this->data['vacancy']->getId())){

                Router::redirectTo("/");

            }

        }

        public function addInfoToArray(){


            $this->data['demands'] = explode(',', $this->data['vacancy']->getDemands());
            $this->data['duties'] = explode(',', $this->data['vacancy']->getDuties());
            $this->data['conditions'] = explode(',', $this->data['vacancy']->getConditions());

        }

    }