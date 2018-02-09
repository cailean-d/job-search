<?php

    /**
     * @apiDefine admin Авторизация под учетной записью администратора
     * 
     */

    final class HelperEducationApi{

        public static function init(){

            return array(

                [
                    'method' => 'get',
                    'url' => 'help_education/:id{number}',
                    'handler' => 'get'
                ],

                [
                    'method' => 'get',
                    'url' => 'help_education',
                    'handler' => 'getAll'
                ],

                [
                    'method' => 'post',
                    'url' => 'help_education',
                    'handler' => 'add'
                ],

                [
                    'method' => 'put',
                    'url' => 'help_education/:id{number}',
                    'handler' => 'update'
                ],

                [
                    'method' => 'delete',
                    'url' => 'help_education/:id{number}',
                    'handler' => 'delete'
                ],

                [
                    'method' => 'delete',
                    'url' => 'help_education',
                    'handler' => 'deleteAll'
                ],

            );

        }

        /**
         * 
         * @api {get} help_education/:id Получить запись
         * @apiName GetEducation
         * @apiGroup Help_Education
         * @apiVersion  1.0.0
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Уровень образвания
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Среднее"
         *  }
         * 
         * @apiError RecordNotFound Запись не найдена
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Запись не найдена"
         *     }
         * 
         */

        public static function get($router){

            $help_education = HelperEducation::get($router['id']);

            if (empty($help_education->getId())) {

                Http::error('Запись не найдена');

            } else {

                $res = [

                    'id' => $help_education->getId(),
                    'name' => $help_education->getName(),

                ];

                Http::response($res, 200);

            }
            
        }

        /**
         * 
         * @api {get} help_education Получить все записи
         * @apiName GetAllEducation
         * @apiGroup Help_Education
         * @apiVersion  1.0.0
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Уровень образвания
         * 
         * @apiSuccessExample {json} Success-Response:
         *  [
         *      {
         *          "id" : "1"
         *          "name" : "Среднее"
         *      },
         * 
         *      {
         *          "id" : "2"
         *          "name" : "Среднее cпециальное"
         *      },
         * 
         *      {
         *          "id" : "3"
         *          "name" : "Неоконченное высшее"
         *      }
         *  ]
         * 
         */

        public static function getAll(){

            $help_education = HelperEducation::getAll();

            $res = array();

            foreach ($help_education as $edu) {

                array_push($res,

                [

                    'id' => $edu->getId(),
                    'name' => $edu->getName(),
    
                ]);

            }

            Http::response($res, 200);

        }

        /**
         * 
         * @api {post} help_education Добавить запись
         * @apiName AddEducation
         * @apiGroup Help_Education
         * @apiVersion  1.0.0
         * 
         * @apiPermission admin
         * 
         * @apiParam  {String} name Название новой записи
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      name : Высшее
         * }
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Уровень образвания
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Высшее"
         *  }
         * 
         * @apiError PermissionDenied У вас недостаточно прав для выполнения данной операции
         * @apiError Empty-Name Необходимо поле <code>name</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Forbidden
         *     {
         *       "error": "У вас недостаточно прав для выполнения данной операции"
         *     }
         * 
         */

        public static function add(){

            if(!isset($_SESSION['admin'])) { 

                Http::error("У вас недостаточно прав для выполнения данной операции", 403);

            } 

            if(!isset($_POST['name'])) { 

                Http::error("Необходимо поле [name]");

            } 

            $help_education = new HelperEducation(null, $_POST['name']);
                
            $help_education->save();

            $res = [

                'id' => $help_education->getId(),
                'name' => $help_education->getName(),

            ];

            Http::response($res, 200);

        }

        /**
         * 
         * @api {put} help_education/:id Обновить запись
         * @apiName UpdateEducation
         * @apiGroup Help_Education
         * @apiVersion  1.0.0
         * 
         * @apiPermission admin
         * 
         * @apiParam  {String} name Название новой записи
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      name : Высшее
         * }
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Уровень образвания
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Высшее"
         *  }
         * 
         * @apiError PermissionDenied У вас недостаточно прав для выполнения данной операции
         * @apiError Empty-Name Необходимо поле <code>name</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Forbidden
         *     {
         *       "error": "У вас недостаточно прав для выполнения данной операции"
         *     }
         * 
         */

        public static function update($router){

            if(!isset($_SESSION['admin'])) { 

                Http::error("У вас недостаточно прав для выполнения данной операции", 403);

            } 

            $help_education = HelperEducation::get($router['id']);
            
            if(empty($help_education->getId())){

                Http::error('Запись не найдена');

            }

            if(!isset($GLOBALS['PUT']['name'])) { 

                Http::error("Необходимо поле [name]");

            } 

            $help_education->setName($GLOBALS['PUT']['name']);

            $help_education->save();

            $res = [

                'id' => $help_education->getId(),
                'name' => $help_education->getName(),

            ];

            Http::response($res, 200);

        }

        /**
         * 
         * @api {delete} help_education/:id Удалить запись
         * @apiName DeleteEducation
         * @apiGroup Help_Education
         * @apiVersion  1.0.0
         * 
         * @apiPermission admin
         * 
         * @apiSuccess (200) {String} success Запись успешно удалена
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "success" : "true"
         *  }
         * 
         * @apiError VacancyNotFound Запись не найдена
         * @apiError PermissionDenied У вас недостаточно прав для выполнения данной операции
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 403 Bad Request
         *     {
         *       "error": "У вас недостаточно прав для выполнения данной операции"
         *     }
         * 
         */

        public static function delete($router){

            if(!isset($_SESSION['admin'])) { 

                Http::error("У вас недостаточно прав для выполнения данной операции", 403);

            } 

            $help_education = HelperEducation::get($router['id']);
            
            if (empty($help_education->getId())) {

                Http::error('Запись не найдена');

            }

            $help_education->delete();
           
            Http::success();

        }

        /**
         * 
         * @api {delete} help_education Удалить все записи
         * @apiName DeleteAllEducation
         * @apiGroup Help_Education
         * @apiVersion  1.0.0
         * 
         * @apiPermission admin
         * 
         * @apiSuccess (200) {String} success Все записи успешно удалены
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "success" : "true"
         *  }
         * 
         * @apiError PermissionDenied У вас недостаточно прав для выполнения данной операции
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 403 Forbidden
         *     {
         *       "error": "У вас недостаточно прав для выполнения данной операции"
         *     }
         * 
         */

        public static function deleteAll(){

            if(!isset($_SESSION['admin'])) { 

                Http::error("У вас недостаточно прав для выполнения данной операции", 403);

            } 

            HelperEducation::deleteAll();

            Http::success();

        }

    }