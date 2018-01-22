<?php

    require_once __DIR__.'/../core/Controller.php';
    require_once __DIR__.'/../models/Resume.php';
    require_once __DIR__.'/../models/Avatar.php';
    require_once __DIR__.'/../models/Education.php';
    require_once __DIR__.'/../models/Experience.php';
    require_once __DIR__.'/../models/Language.php';


    final class ResumeController extends Controller{

        public function __construct($routerVars){

            parent::__construct($routerVars);

            $this->view->setTitle('Мое резюме');
            $this->view->setView('ResumeView');

            $this->data['router']['id'] = $this->getId();

            $this->data['resume'] = Resume::getJoinedByUserId($this->getId());
            $this->data['avatar'] = Avatar::get($this->getId());
            $this->data['education'] = Education::getJoinedByUserid($this->getId());
            $this->data['experience'] = Experience::getJoinedByUserid($this->getId());
            $this->data['language'] = Language::getJoinedByUserid($this->getId());

            $this->langToString();

        }

        protected function setAccess(){

            return true;

        }

        protected function langToString(){

            foreach ($this->data['language'] as $value) {
                $langs .= mb_strtolower($value->getLangName()) . " (" . mb_strtolower($value->getLangLevel(), 'UTF-8') . "), ";
            }
    
            $this->data['language'] = substr($langs, 0, -2);

        }

    }