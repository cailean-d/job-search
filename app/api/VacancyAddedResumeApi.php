<?php

    /**
     * @apiDefine auth Вы должны быть авторизированы под учетноый записью пользователя
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

        /**
         * 
         * @api {post} vacancy_resume/:id Добавить свое резюме к вакансии
         * @apiName AddVacancyResume
         * @apiGroup VacancyResume
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiSuccess (200) {String} id ID пользователя
         * @apiSuccess (200) {String} vacancy_id ID вакансии
         * @apiSuccess (200) {String} user_id ID пользователя
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "vacancy_id" : "4"
         *      "user_id" : "7"
         *  }
         * 
         * @apiError RecordExists Вы уже отправили резюме
         * @apiError VacancyDoesNotExist Вакансия не существует
         * @apiError Auth Вы не авторизированы
         * @apiError UserAuth Вы должны быть авторизированы под учетноый записью пользователя
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Вы уже отправили резюме"
         *     }
         * 
         */

        public static function add($router){
            
            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы', 403);

            }

            if($_SESSION['type'] != '0') { 

                Http::error('Вы должны быть авторизированы под учетноый записью пользователя', 403);

            } 


            $vacancy = Vacancy::get($router['id']);

            if(empty($vacancy->getId())){

                Http::error('Вакансия не существует');

            }

            $addedResume = VacancyAddedResume::getByVacancyAndUserId($_SESSION['id'], $router['id']);

            if(!empty($addedResume->getId())){

                Http::error('Резюме уже отправлено');

            }

            $newAddedResume = new VacancyAddedResume(null, $router['id'], $_SESSION['id']);

            try{
                
                $newAddedResume->save();

            } catch(Exception $e){
                
                if($e->getMessage() == 'vacancyId'){

                    Http::error("Некорректное поле [vacancyId]");

                } else if ($e->getMessage() == 'userid') {

                    Http::error("Некорректное поле [userid]");

                } 

            }
            
            $res = [

                'id' => $newAddedResume->getId(),
                'vacancy_id' => $newAddedResume->getVacancyId(),
                'user_id' => $newAddedResume->getUserId()

            ];

            Http::response($res, 200);

        }

        /**
         * 
         * @api {delete} vacancy_resume/:id Удалить свое резюме из вакансии
         * @apiName DeleteVacancyResume
         * @apiGroup VacancyResume
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiSuccess (200) {String} success Удаление прошло успешно
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      success : true
         *  }
         * 
         * @apiError RecordDoesNotExist Запись не существует
         * @apiError VacancyDoesNotExist Вакансия не существует
         * @apiError Auth Вы не авторизированы
         * @apiError UserAuth Вы должны быть авторизированы под учетноый записью пользователя
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Запись не существует"
         *     }
         * 
         */


        public static function delete($router){

 
            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы', 403);

            }

            if($_SESSION['type'] != '0') { 

                Http::error('Вы должны быть авторизированы под учетноый записью пользователя', 403);

            } 

            $vacancy = Vacancy::get($router['id']);

            if(empty($vacancy->getId())){

                Http::error('Вакансия не существует');

            }

            $addedResume = VacancyAddedResume::getByVacancyAndUserId($_SESSION['id'], $router['id']);

            if(empty($addedResume->getId())){

                Http::error('Запись не существует');

            }
                
            $addedResume->delete();

            Http::success();

        }

    }