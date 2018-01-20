<?php

    require_once __DIR__.'/../core/Controller.php';
    require_once __DIR__.'/../core/View.php';
    require_once __DIR__.'/../models/Resume.php';
    require_once __DIR__.'/../models/Avatar.php';
    require_once __DIR__.'/../models/Education.php';
    require_once __DIR__.'/../models/Experience.php';
    require_once __DIR__.'/../models/Language.php';


    final class ResumeController extends Controller{

        private static $view;
        private static $data;

        public static function getData(array $routerVars = null){
            
            if($routerVars){

                foreach ($routerVars as $key => $value) {
                    
                    self::$data[$key] = $value;

                }

            }

            self::$data['user']['id'] = $_SESSION['id'];
            self::$data['router']['id'] = self::getId();

            self::$data['resume'] = Resume::getJoinedByUserId(self::getId());
            self::$data['avatar'] = Avatar::get(self::getId());
            self::$data['education'] = Education::getJoinedByUserid(self::getId());
            self::$data['experience'] = Experience::getJoinedByUserid(self::getId());
            self::$data['language'] = Language::getJoinedByUserid(self::getId());

        }

        public static function setAccess(){

            return true;

        }

        public static function init(array $routerVars = null){

            self::$view = new View('Мое резюме', 'ResumeView');

            self::getData($routerVars);

            self::langToString();

            self::setAccess();

            self::$view->render(self::$data);

        }

        private static function langToString(){

            foreach (self::$data['language'] as $value) {
                $langs .= mb_strtolower($value->getLangName()) . " (" . mb_strtolower($value->getLangLevel(), 'UTF-8') . "), ";
            }
    
            self::$data['language'] = substr($langs, 0, -2);

        }

        private static function getId(){

            if(isset(self::$data['router']['id'])){

                return self::$data['router']['id'];

            } else {

                return $_SESSION['id'];

            }

        }

    }