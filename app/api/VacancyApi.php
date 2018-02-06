<?php 

    final class VacancyApi {

        /**
         * @apiDefine employer Учетная запись должна быть типа "работодатель"
         * 
         */

        public static function init(){

            return array(

                [
                    'method' => 'post',
                    'url' => 'vacancy/add',
                    'handler' => 'add'
                ],

                [
                    'method' => 'delete',
                    'url' => 'vacancy/delete/:id{number}',
                    'handler' => 'delete'
                ],

                [
                    'method' => 'put',
                    'url' => 'vacancy/update/:id{number}',
                    'handler' => 'update'
                ],

                [
                    'method' => 'get',
                    'url' => 'vacancy/:id{number}',
                    'handler' => 'get'
                ]

            );

        }

        public static function add(){

            echo "add vacancy";

        }

        /**
         * 
         * @api {delete} vacancy/delete/:id Удаление вакансии
         * @apiName VacancyDelete
         * @apiGroup Vacancy
         * @apiVersion  1.0.0
         * 
         * @apiPermission employer
         * 
         * @apiSuccess (200) {String} success Сессия успешно завершена
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      success : true
         *  }
         * 
         * @apiError VacancyNotFound Вакансия не найдена
         * @apiError PermissionDenied У вас недостаточно прав для выполнения данной операции
         * @apiError PermissionDenied2 У вас недостаточно прав для удаления данной записи
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 403 Bad Request
         *     {
         *       "error": "У вас недостаточно прав для удаления данной записи"
         *     }
         * 
         */

        public static function delete($router){

            $vacancy = Vacancy::get($router['id']);
            
            if (empty($vacancy->getId())) {

                Http::error('Вакансия не найдена');

            }

            if($_SESSION['type'] != 1){

                Http::error('У вас недостаточно прав для выполнения данной операции', 403);

            }


            if($vacancy->getSenderId() != $_SESSION['id']){

                Http::error('У вас недостаточно прав для удаления данной записи', 403);

            }

            $vacancy->delete();
           
            Http::success();

        }
        
        public static function update($router){

            echo "update vacancy " . $router['id'];

        }

        public static function get($router){

            echo "get vacancy " . $router['id'];

        }

    }