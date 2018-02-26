<?php

    final class ResumeEditController extends Controller{

        public function __construct($routerVars, string $mode){

            $this->data['resume'] = Resume::getJoinedByUserId($this->getId());

            parent::__construct($routerVars, ['mode' => $mode]);

            if($mode == 'add'){

                $this->view->setTitle('Добавить резюме');
                
            } else {

                $this->view->setTitle('Редактировать резюме');

            }

            $this->view->setView('ResumeEditView');

            $this->data['router']['id'] = $this->getId();

            $this->data['avatar'] = Avatar::get($this->getId());
            $this->data['own_education'] = Education::getJoinedByUserid($this->getId());
            $this->data['experience'] = Experience::getJoinedByUserid($this->getId());
            $this->data['language'] = Language::getJoinedByUserid($this->getId());

            $this->data['schedule'] = HelperSchedule::getAll();
            $this->data['industry'] = HelperIndustry::getAll();
            $this->data['workPlace'] = HelperWorkPlace::getAll();
            $this->data['education'] = HelperEducation::getAll();
            $this->data['compSkills'] = HelperCompSkill::getAll();
            $this->data['languages'] = HelperLanguage::getAll();

        }

        protected function setAccess(){

            if($this->data['user']['type'] != '0'){

                Router::redirectTo("/");

            }

            if($this->data['router']['mode'] === "add" && !empty($this->data['resume']->getId())){

                Router::redirectTo("/resume/edit");

            }
        
            if($this->data['router']['mode'] === "edit" && empty($this->data['resume']->getId())){

                Router::redirectTo("/resume/add");

            }
            
        }

    }