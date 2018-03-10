<?php

    final class VacanciesController extends Controller{

        public function __construct($routerVars){

            parent::__construct($routerVars);

            $this->view->setTitle('Вакансии');
            $this->view->setView('VacanciesView');

            $this->data['schedule'] = HelperSchedule::getAll();
            $this->data['industry'] = HelperIndustry::getAll();
            $this->data['workPlace'] = HelperWorkPlace::getAll();
            $this->data['education'] = HelperEducation::getAll();
            $this->data['compSkills'] = HelperCompSkill::getAll();
            $this->data['languages'] = HelperLanguage::getAll();
            $this->data['cities'] = Vacancy::getCities();
            $this->data['minSalary'] = Vacancy::getMinSalary();
            $this->data['maxSalary'] = Vacancy::getMaxSalary();
            $this->data['vacancies'] = Vacancy::getLimited(10);
            $this->data['filter']['query'] = $_GET['query'];
            $this->data['filter']['industry'] = $_GET['industry'];
            $this->data['filter']['location'] = $_GET['location'];
            $this->data['filter']['time'] = $_GET['time'];
            $this->data['filter']['schedule'] = $_GET['schedule'];

            $this->setSalaryInterval();
 
        }

        protected function setSalaryInterval(){
    
            if((int)$this->data['minSalary'] % 5000 != 0){
                $a = (int)$this->data['minSalary'] / 5000;
                $this->data['minSalaryInterval'] = 5000 * (int)$a;
            } else {
                $this->data['minSalaryInterval'] = $this->data['minSalary'];
            }
            
            if((int)$this->data['maxSalary'] % 5000 != 0){
                $a = (int)$this->data['maxSalary'] / 5000;
                $this->data['maxSalaryInterval'] = 5000 * (int)++$a;
            } else {
                $this->data['maxSalaryInterval'] = $this->data['maxSalary'];
            }

        }

    }