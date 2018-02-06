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

        /**
         * 
         * @api {get} vacancy/:id Получить вакансию
         * @apiName GetVacancy
         * @apiGroup Vacancy
         * @apiVersion  1.0.0
         * 
         * @apiSuccess (200) {String} id ID вакансии
         * @apiSuccess (200) {String} sender_name Имя работодателя
         * @apiSuccess (200) {String} sender_id ID пользователя
         * @apiSuccess (200) {String} email Email пользователя
         * @apiSuccess (200) {String} company Название компании
         * @apiSuccess (200) {String} phone Телефонный номер работодателя
         * @apiSuccess (200) {String} vacancy_name Название вакансии
         * @apiSuccess (200) {String} salary_min Минимальная зарплата
         * @apiSuccess (200) {String} salary_max Максимальная зарплата
         * @apiSuccess (200) {String} experience Необходимый опыт работы
         * @apiSuccess (200) {String} location Место работы
         * @apiSuccess (200) {String} demands Требования
         * @apiSuccess (200) {String} duties Обязанности
         * @apiSuccess (200) {String} conditions Условаия работы
         * @apiSuccess (200) {String} description Описание вакансии
         * @apiSuccess (200) {String} status Статус (опубликована или нет)
         * @apiSuccess (200) {String} date Дата публикации
         * @apiSuccess (200) {String} schedule_name График работы
         * @apiSuccess (200) {String} industry_name Отрасль
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *     id : "1",
         *     sender_name : "Василий Петренко",
         *     sender_id : "5",
         *     email : "example@test.com",
         *     company : "ООО Серебряный век",
         *     phone : "+79999999999",
         *     vacancy_name : "Сторож",
         *     salary_min : "22000",
         *     salary_max : "25000",
         *     experience : "1",
         *     location : "Волгоград",
         *     demands : "Стрессоустойчивость, активность, выдержка",
         *     duties : "Совершать обход охраняемого объекта не менее трех раз за смену, при возникновении        пожара на объекте поднимать тревогу",
         *     conditions : "Оклад на испытательный срок далее руб,Предоставление питания в рабочие смены",
         *     description : "На постоянную работу в дом отдыха с проживанием нужен сторож",
         *     status : "1",
         *     date : "2017-11-27 08:59:16",
         *     schedule_name : "Полный день",
         *     industry_name : "Охрана, безопасность",
         *  }
         * 
         * @apiError VacancyNotFound Вакансия <code>id</code> не найдена.
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *   HTTP/1.1 400 Bad Request
         *   {
         *     "error": "Вакансия не найдена"
         *   }
         * 
         */

        public static function get($router){

            $vacancy = Vacancy::getJoined($router['id']);

            if (empty($vacancy->getId())) {

                Http::error('Вакансия не найдена');

            } else {

                $res = [

                    'id' => $vacancy->getId(),
                    'sender_name' => $vacancy->getSenderName(),
                    'sender_id' => $vacancy->getSenderId(),
                    'email' => $vacancy->getEmail(),
                    'company' => $vacancy->getCompany(),
                    'phone' => $vacancy->getPhone(),
                    'vacancy_name' => $vacancy->getVacancyName(),
                    'salary_min' => $vacancy->getSalaryMin(),
                    'salary_max' => $vacancy->getSalaryMax(),
                    'experience' => $vacancy->getExperience(),
                    'location' => $vacancy->getLocation(),
                    'demands' => $vacancy->getDemands(),
                    'duties' => $vacancy->getDuties(),
                    'conditions' => $vacancy->getConditions(),
                    'description' => $vacancy->getDescription(),
                    'status' => $vacancy->getStatus(),
                    'date' => $vacancy->getDate(),
                    'schedule_name' => $vacancy->getScheduleName(),
                    'industry_name' => $vacancy->getIndustryName(),

                ];

                Http::response($res, 200);

            }

        }

    }