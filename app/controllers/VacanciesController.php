<?php

    require_once __DIR__.'/../core/Controller.php';
    require_once __DIR__.'/../core/View.php';
    require_once __DIR__.'/../models/Vacancy.php';
    require_once __DIR__.'/../helpers/HelperSchedule.php';
    require_once __DIR__.'/../helpers/HelperIndustry.php';
    require_once __DIR__.'/../helpers/HelperWorkPlace.php';
    require_once __DIR__.'/../helpers/HelperEducation.php';
    require_once __DIR__.'/../helpers/HelperCompSkill.php';
    require_once __DIR__.'/../helpers/HelperLanguage.php';

    final class VacanciesController extends Controller{

        private static $view;
        private static $data;

        public static function getData(){

            self::$data['schedule'] = HelperSchedule::getAll();
            self::$data['industry'] = HelperIndustry::getAll();
            self::$data['workPlace'] = HelperWorkPlace::getAll();
            self::$data['education'] = HelperEducation::getAll();
            self::$data['compSkills'] = HelperCompSkill::getAll();
            self::$data['languages'] = HelperLanguage::getAll();
            self::$data['cities'] = Vacancy::getCities();
            self::$data['minSalary'] = Vacancy::getMinSalary();
            self::$data['maxSalary'] = Vacancy::getMaxSalary();
            self::$data['vacancies'] = Vacancy::getFiltered();
            self::$data['filter']['query'] = $_GET['query'];
            self::$data['filter']['industry'] = $_GET['industry'];
            self::$data['filter']['location'] = $_GET['location'];
            self::$data['filter']['time'] = $_GET['time'];
            self::$data['filter']['schedule'] = $_GET['schedule'];
 
        }

        public static function setAccess(){

            return true;

        }

        public static function init(array $routerVars = null){

            self::$view = new View('Вакансии', 'VacanciesView');

            parent::setRouterVariables($routerVars, self::$data);

            self::getData();

            self::setSalaryInterval();

            self::setAccess();

            self::$view->render(self::$data);

        }

        private static function setSalaryInterval(){
    
            if((int)self::$data['minSalary'] % 5000 != 0){
                $a = (int)self::$data['minSalary'] / 5000;
                self::$data['minSalaryInterval'] = 5000 * (int)$a;
            } else {
                self::$data['minSalaryInterval'] = self::$data['minSalary'];
            }
            
            if((int)self::$data['maxSalary'] % 5000 != 0){
                $a = (int)self::$data['maxSalary'] / 5000;
                self::$data['maxSalaryInterval'] = 5000 * (int)++$a;
            } else {
                self::$data['maxSalaryInterval'] = self::$data['maxSalary'];
            }

        }

    }