<?php

    /**
     * @apiDefine admin Авторизация под учетной записью администратора
     * 
     */

    final class HelperScheduleApi{

        public static function init(){

            return array(

                [
                    'method' => 'get',
                    'url' => 'help_schedule/:id{number}',
                    'handler' => 'get'
                ],

                [
                    'method' => 'get',
                    'url' => 'help_schedule',
                    'handler' => 'getAll'
                ],

                [
                    'method' => 'post',
                    'url' => 'help_schedule',
                    'handler' => 'add'
                ],

                [
                    'method' => 'put',
                    'url' => 'help_schedule/:id{number}',
                    'handler' => 'update'
                ],

                [
                    'method' => 'delete',
                    'url' => 'help_schedule/:id{number}',
                    'handler' => 'delete'
                ],

                [
                    'method' => 'delete',
                    'url' => 'help_schedule',
                    'handler' => 'deleteAll'
                ],

            );

        }

        /**
         * 
         * @api {get} help_schedule/:id Получить запись
         * @apiName GetSchedule
         * @apiGroup Help_Schedule
         * @apiVersion  1.0.0
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name График
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Полный день"
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

            $help_schedule = HelperSchedule::get($router['id']);

            if (empty($help_schedule->getId())) {

                Http::error('Запись не найдена');

            } else {

                $res = [

                    'id' => $help_schedule->getId(),
                    'name' => $help_schedule->getName(),

                ];

                Http::response($res, 200);

            }
            
        }

        /**
         * 
         * @api {get} help_schedule Получить все записи
         * @apiName GetAllSchedule
         * @apiGroup Help_Schedule
         * @apiVersion  1.0.0
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name График
         * 
         * @apiSuccessExample {json} Success-Response:
         *  [
         *      {
         *          "id" : "1"
         *          "name" : "Полный день"
         *      },
         * 
         *      {
         *          "id" : "2"
         *          "name" : "Неполный день"
         *      },
         * 
         *      {
         *          "id" : "3"
         *          "name" : "Сменный"
         *      }
         *  ]
         * 
         */

        public static function getAll(){

            $help_schedule = HelperSchedule::getAll();

            $res = array();

            foreach ($help_schedule as $edu) {

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
         * @api {post} help_schedule Добавить запись
         * @apiName AddSchedule
         * @apiGroup Help_Schedule
         * @apiVersion  1.0.0
         * 
         * @apiPermission admin
         * 
         * @apiParam  {String} name Название новой записи
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      name : Полный день
         * }
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name График
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Полный день"
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

            $help_schedule = new HelperSchedule(null, $_POST['name']);
                
            $help_schedule->save();

            $res = [

                'id' => $help_schedule->getId(),
                'name' => $help_schedule->getName(),

            ];

            Http::response($res, 200);

        }

        /**
         * 
         * @api {put} help_schedule/:id Обновить запись
         * @apiName UpdateSchedule
         * @apiGroup Help_Schedule
         * @apiVersion  1.0.0
         * 
         * @apiPermission admin
         * 
         * @apiParam  {String} name Название новой записи
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      name : Полный день
         * }
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name График
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Полный день"
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

            $help_schedule = HelperSchedule::get($router['id']);
            
            if(empty($help_schedule->getId())){

                Http::error('Запись не найдена');

            }

            if(!isset($GLOBALS['PUT']['name'])) { 

                Http::error("Необходимо поле [name]");

            } 

            $help_schedule->setName($GLOBALS['PUT']['name']);

            $help_schedule->save();

            $res = [

                'id' => $help_schedule->getId(),
                'name' => $help_schedule->getName(),

            ];

            Http::response($res, 200);

        }

        /**
         * 
         * @api {delete} help_schedule/:id Удалить запись
         * @apiName DeleteSchedule
         * @apiGroup Help_Schedule
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

            $help_schedule = HelperSchedule::get($router['id']);
            
            if (empty($help_schedule->getId())) {

                Http::error('Запись не найдена');

            }

            $help_schedule->delete();
           
            Http::success();

        }

        /**
         * 
         * @api {delete} help_schedule Удалить все записи
         * @apiName DeleteAllSchedule
         * @apiGroup Help_Schedule
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

            HelperSchedule::deleteAll();

            Http::success();

        }

    }