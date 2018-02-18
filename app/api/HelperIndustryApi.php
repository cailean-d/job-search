<?php

    /**
     * @apiDefine admin Авторизация под учетной записью администратора
     * 
     */

    final class HelperIndustryApi{

        public static function init(){

            return array(

                [
                    'method' => 'get',
                    'url' => 'help_industry/:id{number}',
                    'handler' => 'get'
                ],

                [
                    'method' => 'get',
                    'url' => 'help_industry',
                    'handler' => 'getAll'
                ],

                [
                    'method' => 'post',
                    'url' => 'help_industry',
                    'handler' => 'add'
                ],

                [
                    'method' => 'put',
                    'url' => 'help_industry/:id{number}',
                    'handler' => 'update'
                ],

                [
                    'method' => 'delete',
                    'url' => 'help_industry/:id{number}',
                    'handler' => 'delete'
                ],

                [
                    'method' => 'delete',
                    'url' => 'help_industry',
                    'handler' => 'deleteAll'
                ],

            );

        }

        /**
         * 
         * @api {get} help_industry/:id Получить запись
         * @apiName GetIndustry
         * @apiGroup Help_Industry
         * @apiVersion  1.0.0
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Отрасль
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Производство"
         *  }
         * 
         * @apiError RecordNotFound Запись не найдена
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 404 Not Found
         *     {
         *       "error": "Запись не найдена"
         *     }
         * 
         */

        public static function get($router){

            $help_industry = HelperIndustry::get($router['id']);

            if (empty($help_industry->getId())) {

                Http::error('Запись не найдена', 404);

            } else {

                $res = [

                    'id' => $help_industry->getId(),
                    'name' => $help_industry->getName(),

                ];

                Http::response($res, 200);

            }
            
        }

        /**
         * 
         * @api {get} help_industry Получить все записи
         * @apiName GetAllIndustry
         * @apiGroup Help_Industry
         * @apiVersion  1.0.0
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Отрасль
         * 
         * @apiSuccessExample {json} Success-Response:
         *  [
         *      {
         *          "id" : "1"
         *          "name" : "Производство"
         *      },
         * 
         *      {
         *          "id" : "2"
         *          "name" : "Продажи"
         *      },
         * 
         *      {
         *          "id" : "3"
         *          "name" : "Юриспруденция"
         *      }
         *  ]
         * 
         */

        public static function getAll(){

            $help_industry = HelperIndustry::getAll();

            $res = array();

            foreach ($help_industry as $ind) {

                array_push($res,

                [

                    'id' => $ind->getId(),
                    'name' => $ind->getName(),
    
                ]);

            }

            Http::response($res, 200);

        }

        /**
         * 
         * @api {post} help_industry Добавить запись
         * @apiName AddIndustry
         * @apiGroup Help_Industry
         * @apiVersion  1.0.0
         * 
         * @apiPermission admin
         * 
         * @apiParam  {String} name Название новой записи
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      name : Производство
         * }
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Отрасль
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Производство"
         *  }
         * 
         * @apiError PermissionDenied У вас недостаточно прав для выполнения данной операции
         * @apiError Empty-Name Необходимо поле <code>name</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 403 Forbidden
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

            $help_industry = new HelperIndustry(null, $_POST['name']);
                
            $help_industry->save();

            $res = [

                'id' => $help_industry->getId(),
                'name' => $help_industry->getName(),

            ];

            Http::response($res, 200);

        }

        /**
         * 
         * @api {put} help_industry/:id Обновить запись
         * @apiName UpdateIndustry
         * @apiGroup Help_Industry
         * @apiVersion  1.0.0
         * 
         * @apiPermission admin
         * 
         * @apiParam  {String} name Название новой записи
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      name : Производство
         * }
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Уровень образвания
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Производство"
         *  }
         * 
         * @apiError PermissionDenied У вас недостаточно прав для выполнения данной операции
         * @apiError Empty-Name Необходимо поле <code>name</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 403 Forbidden
         *     {
         *       "error": "У вас недостаточно прав для выполнения данной операции"
         *     }
         * 
         */

        public static function update($router){

            if(!isset($_SESSION['admin'])) { 

                Http::error("У вас недостаточно прав для выполнения данной операции", 403);

            } 

            $help_industry = HelperIndustry::get($router['id']);
            
            if(empty($help_industry->getId())){

                Http::error('Запись не найдена', 404);

            }

            if(!isset($GLOBALS['PUT']['name'])) { 

                Http::error("Необходимо поле [name]");

            } 

            $help_industry->setName($GLOBALS['PUT']['name']);

            $help_industry->save();

            $res = [

                'id' => $help_industry->getId(),
                'name' => $help_industry->getName(),

            ];

            Http::response($res, 200);

        }

        /**
         * 
         * @api {delete} help_industry/:id Удалить запись
         * @apiName DeleteIndustry
         * @apiGroup Help_Industry
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
         *     HTTP/1.1 403 Forbidden
         *     {
         *       "error": "У вас недостаточно прав для выполнения данной операции"
         *     }
         * 
         */

        public static function delete($router){

            if(!isset($_SESSION['admin'])) { 

                Http::error("У вас недостаточно прав для выполнения данной операции", 403);

            } 

            $help_industry = HelperIndustry::get($router['id']);
            
            if (empty($help_industry->getId())) {

                Http::error('Запись не найдена', 404);

            }

            $help_industry->delete();
           
            Http::success();

        }

        /**
         * 
         * @api {delete} help_industry Удалить все записи
         * @apiName DeleteAllIndustry
         * @apiGroup Help_Industry
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

            HelperIndustry::deleteAll();

            Http::success();

        }

    }