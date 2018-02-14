<?php

    /**
     * @apiDefine auth Вы должны быть авторизированы под учетноый записью пользователя
     */

    /**
     * @apiDefine employer Вы должны быть авторизированы под учетноый записью работодателя
     */

    final class VacancyAddedResumeApi{

        public static function init(){

            return array(

                [
                    'method' => 'post',
                    'url' => 'vacancy_resume/:id{number}',
                    'handler' => 'add'
                ],

                [
                    'method' => 'delete',
                    'url' => 'vacancy_resume/:id{number}',
                    'handler' => 'delete'
                ],

                [
                    'method' => 'get',
                    'url' => 'vacancy_resume/user',
                    'handler' => 'getUserVacancies'
                ],

                [
                    'method' => 'get',
                    'url' => 'vacancy_resume/employer/:id{number}',
                    'handler' => 'getEmployerResumes'
                ],

                [
                    'method' => 'get',
                    'url' => 'vacancy_resume/employer',
                    'handler' => 'getAllEmployerResumes'
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

                Http::error('Вы должны быть авторизированы под учетной записью пользователя', 403);

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

                Http::error('Вы должны быть авторизированы под учетной записью пользователя', 403);

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

        /**
         * 
         * @api {get} vacancy_resume/user Отправленные резюме для пользователя
         * @apiName GetUserVacancyResume
         * @apiGroup VacancyResume
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiSuccess (200) {String} vacancy_id ID вакансии
         * 
         * @apiSuccessExample {json} Success-Response:
         *  [
         *      {
         *          "vacancy_id" : "4"
         *      },
         *      {
         *          "vacancy_id" : "15"
         *      },
         *      {
         *          "vacancy_id" : "7"
         *      },
         *      {
         *          "vacancy_id" : "8"
         *      }
         *  ]
         * 
         * @apiError Auth Вы не авторизированы
         * @apiError UserAuth Вы должны быть авторизированы под учетноый записью пользователя
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Вы должны быть авторизированы под учетноый записью пользователя"
         *     }
         * 
         */

        public static function getUserVacancies(){

            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы', 403);

            }

            if($_SESSION['type'] != '0') { 

                Http::error('Вы должны быть авторизированы под учетной записью пользователя', 403);

            } 

            $vacancies = VacancyAddedResume::getByUserId($_SESSION['id']);

            $res = array();

            foreach ($vacancies as $v) {

                array_push($res,

                [

                    'vacancy_id' => $v->getVacancyId(),
    
                ]);

            }

            Http::response($res, 200);

        }

        /**
         * 
         * @api {get} vacancy_resume/employer/:id Отправленные резюме для вакансии
         * @apiName GetEmployerVacancyResume
         * @apiGroup VacancyResume
         * @apiVersion  1.0.0
         * 
         * @apiPermission employer
         * 
         * @apiSuccess (200) {String} user_id ID вакансии
         * 
         * @apiSuccessExample {json} Success-Response:
         *  [
         *      {
         *          "user_id" : "4"
         *      },
         *      {
         *          "user_id" : "15"
         *      },
         *      {
         *          "user_id" : "7"
         *      },
         *      {
         *          "user_id" : "8"
         *      }
         *  ]
         * 
         * @apiError Auth Вы не авторизированы
         * @apiError VacancyDoesNotExist Вакансия не существует
         * @apiError UserAuth Вы должны быть авторизированы под учетноый записью работодателя
         * @apiError PermissionDenied Вы не можете получить данные чужой записи
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 403 Forbidden
         *     {
         *       "error": "Вы не можете получить данные чужой записи"
         *     }
         * 
         */

        public static function getEmployerResumes($router){

            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы', 403);

            }

            if($_SESSION['type'] != '1') { 

                Http::error('Вы должны быть авторизированы под учетной записью работодателя', 403);

            } 

            $vacancy = Vacancy::get($router['id']);
            
            if (empty($vacancy->getId())) {

                Http::error('Вакансия не найдена');

            }
            
            if ($vacancy->getSenderId() != $_SESSION['id']) {

                Http::error('Вы не можете получить данные чужой записи', 403);

            }

            $vacancies = VacancyAddedResume::getByVacancyId($router['id']);

            $res = array();

            foreach ($vacancies as $v) {

                array_push($res,

                [

                    'user_id' => $v->getUserId(),
    
                ]);

            }

            Http::response($res, 200);

        }

        /**
         * 
         * @api {get} vacancy_resume/employer Отправленные резюме для всех вакансий
         * @apiName GetAllEmployerVacancyResume
         * @apiGroup VacancyResume
         * @apiVersion  1.0.0
         * 
         * @apiPermission employer
         * 
         * @apiSuccess (200) {String} user_id ID вакансии
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *    "6": [
         *           {
         *               "user_id": "3"
         *           }
         *    ],
         *    "7": [
         *           {
         *               "user_id": "3"
         *           },
         *           {
         *               "user_id": "4"
         *           }
         *    ]
         *   }
         * 
         * @apiError Auth Вы не авторизированы
         * @apiError UserAuth Вы должны быть авторизированы под учетноый записью работодателя
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 403 Forbidden
         *     {
         *       "error": "Вы должны быть авторизированы под учетноый записью работодателя"
         *     }
         * 
         */

        public static function getAllEmployerResumes(){

            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы', 403);

            }

            if($_SESSION['type'] != '1') { 

                Http::error('Вы должны быть авторизированы под учетной записью работодателя', 403);

            } 

            $vacancies = Vacancy::getByUserId($_SESSION['id']);

            $res = array();

            foreach ($vacancies as $vac) {

                $vacancy_resumes = VacancyAddedResume::getByVacancyId($vac->getId());

                if(count($vacancy_resumes) > 0){

                    $res[$vac->getId()] = array();
    
                    foreach ($vacancy_resumes as $v) {
        
                        array_push($res[$vac->getId()],
        
                        [
        
                            'user_id' => $v->getUserId(),
            
                        ]);
        
                    }

                }

            }
            
            Http::response($res, 200);

        }

    }