<?php

    final class ResumeController extends Controller{

        public function __construct($routerVars){

            parent::__construct($routerVars);

            $this->view->setTitle('Мое резюме');
            $this->view->setView('ResumeView');

            $this->data['router']['id'] = $this->getId();

            $this->data['resume'] = Resume::getJoinedByUserId($this->getId());
            $this->data['resume_user'] = User::get($this->getId());

            $this->redirectOnFailure();

            $this->data['avatar'] = Avatar::get($this->getId());
            $this->data['education'] = Education::getJoinedByUserid($this->getId());
            $this->data['experience'] = Experience::getJoinedByUserid($this->getId());
            $this->data['language'] = Language::getJoinedByUserid($this->getId());

            $this->langToString();

        }

        protected function setAccess(){

            if($this->data['user']['authorized'] !== true){

                Router::redirectTo("/");

            }
        }

        protected function langToString(){

            foreach ($this->data['language'] as $value) {
                $langs .= mb_strtolower($value->getLangName()) . " (" . mb_strtolower($value->getLangLevel(), 'UTF-8') . "), ";
            }
    
            $this->data['language'] = substr($langs, 0, -2);

        }

        private function redirectOnFailure(){

            if(empty($this->data['resume']->getId()) && 
            ($this->data['user']['id'] != $this->data['router']['id'])){

                Router::redirectTo("/");

            }

        }

    }