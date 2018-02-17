<?php

    /**
     * @apiDefine auth Вы должны быть авторизированы под учетноый записью пользователя
    */

     final class ResumeApi{

        public static function init(){

            return array(

                [
                    'method' => 'post',
                    'url' => 'resume',
                    'handler' => 'add'
                ],

                [
                    'method' => 'put',
                    'url' => 'resume',
                    'handler' => 'update'
                ],

                [
                    'method' => 'delete',
                    'url' => 'resume',
                    'handler' => 'delete'
                ],

                [
                    'method' => 'get',
                    'url' => 'resume/:id{number}',
                    'handler' => 'get'
                ]

            );

        }

        public static function add(){
            
        }

        public static function update(){

        }

        public static function delete(){

        }
        
        /**
         * 
         * @api {get} resume/:id Получить запись
         * @apiName GetResume
         * @apiGroup Resume
         * @apiVersion  1.0.0
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} user_id ID пользователя
         * @apiSuccess (200) {String} firstname Имя
         * @apiSuccess (200) {String} lastname Фамилия
         * @apiSuccess (200) {String} patronymic Отчество
         * @apiSuccess (200) {String} gender Пол
         * @apiSuccess (200) {String} birthday Дата рождения
         * @apiSuccess (200) {String} city Город
         * @apiSuccess (200) {String} phone Телефон
         * @apiSuccess (200) {String} email Почта
         * @apiSuccess (200) {String} post Желаемая должность
         * @apiSuccess (200) {String} industry_id ID отрасли
         * @apiSuccess (200) {String} schedule_id Желаемый график работы
         * @apiSuccess (200) {String} salary Желаемая заплата
         * @apiSuccess (200) {String} workplace_id Желаемое место работы
         * @apiSuccess (200) {String} compskill_id Владение компьютером
         * @apiSuccess (200) {String} car Наличие авто
         * @apiSuccess (200) {String} courses Пройденные курсы, тренинги
         * @apiSuccess (200) {String} skills Навыки и умения
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1",
         *      "user_id" : "5",
         *      "firstname" : "Петр",
         *      "lastname" : "Петров",
         *      "patronymic" : "Владимирович",
         *      "gender" : "Мужской",
         *      "birthday" : "01.01.1980",
         *      "city" : "Москва",
         *      "phone" : "+79999999999",
         *      "email" : "test@test.com",
         *      "post" : "Сторож",
         *      "industry_id" : "5",
         *      "schedule_id" : "3",
         *      "salary" : "99999",
         *      "workplace_id" : "2",
         *      "compskill_id" : "1",
         *      "car" : "Нет",
         *      "courses" : "Мои курсы...",
         *      "skills" : "Мои навыки...",\
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

            $resume = Resume::getByUserId($router['id']);

            if (empty($resume->getId())) {

                Http::error('Запись не найдена');

            } else {

                $res = [

                    'id' => $resume->getId(),
                    'user_id' => $resume->getUserid(),
                    'firstname' => $resume->getFirstname(),
                    'lastname' => $resume->getLastname(),
                    'patronymic' => $resume->getPatronymic(),
                    'gender' => $resume->getGender(),
                    'birthday' => $resume->getBirthday(),
                    'city' => $resume->getCity(),
                    'phone' => $resume->getPhone(),
                    'email' => $resume->getEmail(),
                    'post' => $resume->getPost(),
                    'industry_id' => $resume->getIndustryId(),
                    'schedule_id' => $resume->getScheduleId(),
                    'salary' => $resume->getSalary(),
                    'workplace_id' => $resume->getWorkPlaceId(),
                    'compskill_id' => $resume->getCompSkillId(),
                    'car' => $resume->getCar(),
                    'courses' => $resume->getCourses(),
                    'skills' => $resume->getSkills(),

                ];

                Http::response($res, 200);

            }
            
        }

     }