<?php

    final class VacancyController extends Controller{

        public function __construct($routerVars){

            parent::__construct($routerVars);

            $this->view->setTitle('Вакансия');
            $this->view->setView('VacancyView');

            $this->data['vacancy'] = Vacancy::getJoined($this->data['router']['id']);
            $this->redirectOnFailure();
            $this->data['vacancy']->increaseViews()->save();

            $v_id = $this->data['vacancy']->getId();

            $this->data['resume_count'] = VacancyAddedResume::getCountByVacancyId($v_id);

            $this->addInfoToArray();

            $this->getUserAdditionalInfo();

            $this->getEmployerAdditionalInfo();

        }

        public function addInfoToArray(){


            $this->data['demands'] = explode(',', $this->data['vacancy']->getDemands());
            $this->data['duties'] = explode(',', $this->data['vacancy']->getDuties());
            $this->data['conditions'] = explode(',', $this->data['vacancy']->getConditions());

        }

        private function getUserAdditionalInfo(){

            if($this->data['user']['type'] == '0'){

                $resume = Resume::getJoinedByUserId($this->data['user']['id']);

                if (empty($resume->getId())){

                    $this->data['isResume'] = false; 

                } else {

                    $this->data['isResume'] = true; 

                    $this->data['isResumeSent'] = VacancyAddedResume::isResumeSent(

                        $this->data['user']['id'], 
                        $this->data['router']['id']

                    );

                }

            } 

        }

        private function getEmployerAdditionalInfo(){

            if($this->data['user']['type'] == '1') {

                $this->data['isResumeEmployed'] = Vacancy::isVacancyEmployed(

                    $this->data['router']['id'],
                    $this->data['user']['id'] 

                );

                if($this->data['isResumeEmployed']){

                    $this->data['users'] = VacancyAddedResume::getJoinedByVacancyId(
                        $this->data['router']['id']
                    );

                }

            }


        }

        private function redirectOnFailure(){

            if(empty($this->data['vacancy']->getId()) || $this->data['vacancy']->getStatus() == '0'){

                Router::redirectTo("/");

            }

        }

    }