<?php

    /**
     * @apiDefine admin Авторизация под учетной записью администратора
     * 
     */

    final class HelperCompSkillApi{

        public static function init(){

            return array(

                [
                    'method' => 'get',
                    'url' => 'help_compskill/:id{number}',
                    'handler' => 'get'
                ],

                [
                    'method' => 'get',
                    'url' => 'help_compskill',
                    'handler' => 'getAll'
                ],

                [
                    'method' => 'post',
                    'url' => 'help_compskill',
                    'handler' => 'add'
                ],

                [
                    'method' => 'put',
                    'url' => 'help_compskill/:id{number}',
                    'handler' => 'update'
                ],

                [
                    'method' => 'delete',
                    'url' => 'help_compskill/:id{number}',
                    'handler' => 'delete'
                ],

                [
                    'method' => 'delete',
                    'url' => 'help_compskill',
                    'handler' => 'deleteAll'
                ],

            );

        }

        /**
         * 
         * @api {get} help_compskill/:id Получить запись
         * @apiName GetCompSkill
         * @apiGroup Help_CompSkill
         * @apiVersion  1.0.0
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Уровень владения компьютером
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Начальный уровень"
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

            $help_compskill = HelperCompSkill::get($router['id']);

            if (empty($help_compskill->getId())) {

                Http::error('Запись не найдена');

            } else {

                $res = [

                    'id' => $help_compskill->getId(),
                    'name' => $help_compskill->getName(),

                ];

                Http::response($res, 200);

            }
            
        }

        /**
         * 
         * @api {get} help_compskill Получить все записи
         * @apiName GetAllCompSkill
         * @apiGroup Help_CompSkill
         * @apiVersion  1.0.0
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Уровень владения компьютером
         * 
         * @apiSuccessExample {json} Success-Response:
         *  [
         *      {
         *          "id" : "1"
         *          "name" : "Не владею"
         *      },
         * 
         *      {
         *          "id" : "2"
         *          "name" : "Начальный уровень"
         *      },
         * 
         *      {
         *          "id" : "3"
         *          "name" : "Уверенный пользователь"
         *      }
         *  ]
         * 
         */

        public static function getAll(){

            $help_compskill = HelperCompSkill::getAll();

            $res = array();

            foreach ($help_compskill as $edu) {

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
         * @api {post} help_compskill Добавить запись
         * @apiName AddCompSkill
         * @apiGroup Help_CompSkill
         * @apiVersion  1.0.0
         * 
         * @apiPermission admin
         * 
         * @apiParam  {String} name Название новой записи
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      name : Начальный уровень
         * }
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Уровень владения компьютером
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Начальный уровень"
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

            $help_compskill = new HelperCompSkill(null, $_POST['name']);
                
            $help_compskill->save();

            $res = [

                'id' => $help_compskill->getId(),
                'name' => $help_compskill->getName(),

            ];

            Http::response($res, 200);

        }

        /**
         * 
         * @api {put} help_compskill/:id Обновить запись
         * @apiName UpdateCompSkill
         * @apiGroup Help_CompSkill
         * @apiVersion  1.0.0
         * 
         * @apiPermission admin
         * 
         * @apiParam  {String} name Название новой записи
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      name : Начальный уровень
         * }
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} name Уровень владения компьютером
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "name" : "Начальный уровень"
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

            $help_compskill = HelperCompSkill::get($router['id']);
            
            if(empty($help_compskill->getId())){

                Http::error('Запись не найдена');

            }

            if(!isset($GLOBALS['PUT']['name'])) { 

                Http::error("Необходимо поле [name]");

            } 

            $help_compskill->setName($GLOBALS['PUT']['name']);

            $help_compskill->save();

            $res = [

                'id' => $help_compskill->getId(),
                'name' => $help_compskill->getName(),

            ];

            Http::response($res, 200);

        }

        /**
         * 
         * @api {delete} help_compskill/:id Удалить запись
         * @apiName DeleteCompSkill
         * @apiGroup Help_CompSkill
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

            $help_compskill = HelperCompSkill::get($router['id']);
            
            if (empty($help_compskill->getId())) {

                Http::error('Запись не найдена');

            }

            $help_compskill->delete();
           
            Http::success();

        }

        /**
         * 
         * @api {delete} help_compskill Удалить все записи
         * @apiName DeleteAllCompSkill
         * @apiGroup Help_CompSkill
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

            HelperCompSkill::deleteAll();

            Http::success();

        }

    }