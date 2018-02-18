<?php

    /**
     * @apiDefine admin Авторизация под учетной записью администратора
     * 
     */

    final class HelperWorkPlaceApi{

        public static function init(){

            return array(

                [
                    'method' => 'get',
                    'url' => 'help_workplace/:id{number}',
                    'handler' => 'get'
                ],

                [
                    'method' => 'get',
                    'url' => 'help_workplace',
                    'handler' => 'getAll'
                ],

                [
                    'method' => 'post',
                    'url' => 'help_workplace',
                    'handler' => 'add'
                ],

                [
                    'method' => 'put',
                    'url' => 'help_workplace/:id{number}',
                    'handler' => 'update'
                ],

                [
                    'method' => 'delete',
                    'url' => 'help_workplace/:id{number}',
                    'handler' => 'delete'
                ],

                [
                    'method' => 'delete',
                    'url' => 'help_workplace',
                    'handler' => 'deleteAll'
                ],

            );

        }

        /**
         * 
         * @api {get} help_workplace/:id Получить запись
         * @apiName GetWorkPlace
         * @apiGroup Help_WorkPlace
         * @apiVersion  1.0.0
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Место работы
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Работы на дому"
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

            $help_workplace = HelperWorkPlace::get($router['id']);

            if (empty($help_workplace->getId())) {

                Http::error('Запись не найдена', 404);

            } else {

                $res = [

                    'id' => $help_workplace->getId(),
                    'name' => $help_workplace->getName(),

                ];

                Http::response($res, 200);

            }
            
        }

        /**
         * 
         * @api {get} help_workplace Получить все записи
         * @apiName GetAllWorkPlace
         * @apiGroup Help_WorkPlace
         * @apiVersion  1.0.0
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Место работы
         * 
         * @apiSuccessExample {json} Success-Response:
         *  [
         *      {
         *          "id" : "1"
         *          "name" : "Работы на дому"
         *      },
         * 
         *      {
         *          "id" : "2"
         *          "name" : "На территории работодателя"
         *      },
         * 
         *      {
         *          "id" : "3"
         *          "name" : "Разъездная работа"
         *      }
         *  ]
         * 
         */

        public static function getAll(){

            $help_workplace = HelperWorkPlace::getAll();

            $res = array();

            foreach ($help_workplace as $edu) {

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
         * @api {post} help_workplace Добавить запись
         * @apiName AddWorkPlace
         * @apiGroup Help_WorkPlace
         * @apiVersion  1.0.0
         * 
         * @apiPermission admin
         * 
         * @apiParam  {String} name Название новой записи
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      name : Работы на дому
         * }
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Место работы
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Работы на дому"
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

            $help_workplace = new HelperWorkPlace(null, $_POST['name']);
                
            $help_workplace->save();

            $res = [

                'id' => $help_workplace->getId(),
                'name' => $help_workplace->getName(),

            ];

            Http::response($res, 200);

        }

        /**
         * 
         * @api {put} help_workplace/:id Обновить запись
         * @apiName UpdateWorkPlace
         * @apiGroup Help_WorkPlace
         * @apiVersion  1.0.0
         * 
         * @apiPermission admin
         * 
         * @apiParam  {String} name Название новой записи
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      name : Работы на дому
         * }
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Место работы
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Работы на дому"
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

            $help_workplace = HelperWorkPlace::get($router['id']);
            
            if(empty($help_workplace->getId())){

                Http::error('Запись не найдена', 404);

            }

            if(!isset($GLOBALS['PUT']['name'])) { 

                Http::error("Необходимо поле [name]");

            } 

            $help_workplace->setName($GLOBALS['PUT']['name']);

            $help_workplace->save();

            $res = [

                'id' => $help_workplace->getId(),
                'name' => $help_workplace->getName(),

            ];

            Http::response($res, 200);

        }

        /**
         * 
         * @api {delete} help_workplace/:id Удалить запись
         * @apiName DeleteWorkPlace
         * @apiGroup Help_WorkPlace
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

            $help_workplace = HelperWorkPlace::get($router['id']);
            
            if (empty($help_workplace->getId())) {

                Http::error('Запись не найдена', 404);

            }

            $help_workplace->delete();
           
            Http::success();

        }

        /**
         * 
         * @api {delete} help_workplace Удалить все записи
         * @apiName DeleteAllWorkPlace
         * @apiGroup Help_WorkPlace
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

            HelperWorkPlace::deleteAll();

            Http::success();

        }

    }