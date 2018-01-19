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

        private static $schedule;
        private static $industry;
        private static $workPlace;
        private static $education;
        private static $compSkills;
        private static $languages;
        private static $cities;
        private static $minSalary;
        private static $maxSalary;
        private static $vacancies;

        private static $minSalaryInterval;
        private static $maxSalaryInterval;

        public static function setData(){

            self::$schedule = HelperSchedule::getAll();
            self::$industry = HelperIndustry::getAll();
            self::$workPlace = HelperWorkPlace::getAll();
            self::$education = HelperEducation::getAll();
            self::$compSkills = HelperCompSkill::getAll();
            self::$languages = HelperLanguage::getAll();
            self::$cities = Vacancy::getCities();
            self::$minSalary = Vacancy::getMinSalary();
            self::$maxSalary = Vacancy::getMaxSalary();
            self::$vacancies = Vacancy::getFiltered();

        }

        private static function setSalaryInterval(){
    
            if((int)self::$minSalary % 5000 != 0){
                $a = (int)self::$minSalary / 5000;
                self::$minSalaryInterval = 5000 * (int)$a;
            } else {
                self::$minSalaryInterval = self::$minSalary;
            }
            
            if((int)self::$maxSalary % 5000 != 0){
                $a = (int)self::$maxSalary / 5000;
                self::$maxSalaryInterval = 5000 * (int)++$a;
            } else {
                self::$maxSalaryInterval = self::$maxSalary;
            }

        }

        private static function extractData(){

            return array(

                "schedule" => self::$schedule,
                "industry" => self::$industry,
                "workPlace" => self::$workPlace,
                "education" => self::$education,
                "compSkills" => self::$compSkills,
                "languages" => self::$languages,
                "cities" => self::$cities,
                "minSalaryInterval" => self::$minSalaryInterval,
                "maxSalaryInterval" => self::$maxSalaryInterval,
                "vacancies" => self::$vacancies

            );

        }

        public static function init(){

            self::setData();

            self::setSalaryInterval();

            $view = new View('Вакансии', 'vacancies');

            $view->render(self::extractData());

        }

    }