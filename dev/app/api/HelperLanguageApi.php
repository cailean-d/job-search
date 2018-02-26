<?php

    /**
     * @apiDefine admin Авторизация под учетной записью администратора
     * 
     */

    final class HelperLanguageApi{

        public static function init(){

            return array(

                [
                    'method' => 'get',
                    'url' => 'help_language/:id{number}',
                    'handler' => 'get'
                ],

                [
                    'method' => 'get',
                    'url' => 'help_language',
                    'handler' => 'getAll'
                ],

                [
                    'method' => 'post',
                    'url' => 'help_language',
                    'handler' => 'add'
                ],

                [
                    'method' => 'put',
                    'url' => 'help_language/:id{number}',
                    'handler' => 'update'
                ],

                [
                    'method' => 'delete',
                    'url' => 'help_language/:id{number}',
                    'handler' => 'delete'
                ],

                [
                    'method' => 'delete',
                    'url' => 'help_language',
                    'handler' => 'deleteAll'
                ],

            );

        }

        /**
         * 
         * @api {get} help_language/:id Получить запись
         * @apiName GetLanguage
         * @apiGroup Help_Language
         * @apiVersion  1.0.0
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Язык
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Английский"
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

            $help_language = HelperLanguage::get($router['id']);

            if (empty($help_language->getId())) {

                Http::error('Запись не найдена', 404);

            } else {

                $res = [

                    'id' => $help_language->getId(),
                    'name' => $help_language->getName(),

                ];

                Http::response($res, 200);

            }
            
        }

        /**
         * 
         * @api {get} help_language Получить все записи
         * @apiName GetAllLanguage
         * @apiGroup Help_Language
         * @apiVersion  1.0.0
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Язык
         * 
         * @apiSuccessExample {json} Success-Response:
         *  [
         *      {
         *          "id" : "1"
         *          "name" : "Английский"
         *      },
         * 
         *      {
         *          "id" : "2"
         *          "name" : "Французский"
         *      },
         * 
         *      {
         *          "id" : "3"
         *          "name" : "Китайский"
         *      }
         *  ]
         * 
         */

        public static function getAll(){

            $help_language = HelperLanguage::getAll();

            $res = array();

            foreach ($help_language as $edu) {

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
         * @api {post} help_language Добавить запись
         * @apiName AddLanguage
         * @apiGroup Help_Language
         * @apiVersion  1.0.0
         * 
         * @apiPermission admin
         * 
         * @apiParam  {String} name Название новой записи
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      name : Английский
         * }
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Язык
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Английский"
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

            $help_language = new HelperLanguage(null, $_POST['name']);
                
            $help_language->save();

            $res = [

                'id' => $help_language->getId(),
                'name' => $help_language->getName(),

            ];

            Http::response($res, 200);

        }

        /**
         * 
         * @api {put} help_language/:id Обновить запись
         * @apiName UpdateLanguage
         * @apiGroup Help_Language
         * @apiVersion  1.0.0
         * 
         * @apiPermission admin
         * 
         * @apiParam  {String} name Название новой записи
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      name : Английский
         * }
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Язык
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Английский"
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

            $help_language = HelperLanguage::get($router['id']);
            
            if(empty($help_language->getId())){

                Http::error('Запись не найдена', 404);

            }

            if(!isset($GLOBALS['PUT']['name'])) { 

                Http::error("Необходимо поле [name]");

            } 

            $help_language->setName($GLOBALS['PUT']['name']);

            $help_language->save();

            $res = [

                'id' => $help_language->getId(),
                'name' => $help_language->getName(),

            ];

            Http::response($res, 200);

        }

        /**
         * 
         * @api {delete} help_language/:id Удалить запись
         * @apiName DeleteLanguage
         * @apiGroup Help_Language
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

            $help_language = HelperLanguage::get($router['id']);
            
            if (empty($help_language->getId())) {

                Http::error('Запись не найдена', 404);

            }

            $help_language->delete();
           
            Http::success();

        }

        /**
         * 
         * @api {delete} help_language Удалить все записи
         * @apiName DeleteAllLanguage
         * @apiGroup Help_Language
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

            HelperLanguage::deleteAll();

            Http::success();

        }

    }