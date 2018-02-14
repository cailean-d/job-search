<?php

    /**
     * @apiDefine auth Необходима авторизация
     * 
     */

    final class VacancyAddedResumeApi{

        public static function init(){

            return array(

                [
                    'method' => 'post',
                    'url' => 'vacancy_resume/:id',
                    'handler' => 'add'
                ],

                [
                    'method' => 'delete',
                    'url' => 'vacancy_resume/:id',
                    'handler' => 'delete'
                ]
            );

        }


        public static function add($router){
            
            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы');

            }

            if($_SESSION['type'] != '0') { 

                Http::error('Вы должны быть авторизированы под учетноый записью пользователя');

            } 

            $addedResume = VacancyAddedResume::getByVacancyAndUserId($_SESSION['id'], $router['id']);

            if(!empty($addedResume->geId())){

                Http::error('Резюме уже отправлено');

            }

            $newAddedResume = new VacancyAddedResume(null, $router['id'], $_SESSION['id']);




        }

        public static function delete(){}

        

    }