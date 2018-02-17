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
                ],

                [
                    'method' => 'get',
                    'url' => 'resume',
                    'handler' => 'myResume'
                ],

                [
                    'method' => 'get',
                    'url' => 'resume/:id{number}/full',
                    'handler' => 'getFull'
                ],

                [
                    'method' => 'get',
                    'url' => 'resume/full',
                    'handler' => 'myFullResume'
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
         *      "skills" : "Мои навыки...",
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

        /**
         * 
         * @api {get} resume Мое резюме
         * @apiName GetMyResume
         * @apiGroup Resume
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
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
         *      "skills" : "Мои навыки...",
         *  }
         * 
         * @apiError Auth Вы не авторизированы
         * @apiError UserAuth Вы должны быть авторизированы под учетной записью пользователя
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Вы должны быть авторизированы под учетной записью пользователя"
         *     }
         * 
         */

        public static function myResume(){
                     
            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы');

            }
            
            if($_SESSION['type'] != '0') { 

                Http::error('Вы должны быть авторизированы под учетной записью пользователя', 403);

            } 

            $resume = Resume::getByUserId($_SESSION['id']);

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

        /**
         * 
         * @api {get} resume/full Полное резюме
         * @apiName MyFullResume
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
         * @apiSuccess (200) {String} industry Отрасль
         * @apiSuccess (200) {String} schedule Желаемый график работы
         * @apiSuccess (200) {String} salary Желаемая заплата
         * @apiSuccess (200) {String} workplace Желаемое место работы
         * @apiSuccess (200) {String} compskill Владение компьютером
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
         *      "industry" : "Охрана, безопасность",
         *      "schedule" : "Вахтовый",
         *      "salary" : "99999",
         *      "workplace" : "На территории работодателя",
         *      "compskill" : "Уверенный пользователь",
         *      "car" : "Нет",
         *      "courses" : "Мои курсы...",
         *      "skills" : "Мои навыки...",
         *      "education": [
         *           {
         *               "level": "Среднее",
         *               "inst": "ТГУ",
         *               "city": "Москва",
         *               "faculty": "",
         *               "period": "2011 - 2012"
         *           },
         *           {
         *               "level": "Неоконченное высшее",
         *               "inst": "МГУ",
         *               "city": "Москва",
         *               "faculty": "Физико-математический",
         *               "period": "2005 - 2010"
         *           }
         *       ],
         *       "experience": [
         *           {
         *               "post": "Охранник",
         *               "company": "Моя компания",
         *               "city": "Город",
         *               "industry": "Охрана, безопасность",
         *               "period": "Июнь 2015 - Август 2015",
         *               "functions": "Мои функции"
         *           },
         *           {
         *               "post": "Сторож2",
         *               "company": "Компания",
         *               "city": "Город",
         *               "industry": "Финансы, бухгалтерия",
         *               "period": "Сентябрь 2010 - Октябрь 2015",
         *               "functions": "Мои функции"
         *           },
         *           {
         *               "post": "Сторож2",
         *               "company": "Компания",
         *               "city": "Город",
         *               "industry": "Финансы, бухгалтерия",
         *               "period": "Сентябрь 2010 - Октябрь 2015",
         *               "functions": "Мои функции"
         *           }
         *       ],
         *       "language": [
         *           {
         *               "language": "Украинский",
         *               "lang_level": "Разговорный"
         *           }
         *       ]
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

        public static function getFull($router){

            $resume = Resume::getJoinedByUserId($router['id']);

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
                    'industry' => $resume->getIndustryName(),
                    'schedule' => $resume->getScheduleName(),
                    'salary' => $resume->getSalary(),
                    'workplace' => $resume->getWorkPlaceName(),
                    'compskill' => $resume->getCompSkillName(),
                    'car' => $resume->getCar(),
                    'courses' => $resume->getCourses(),
                    'skills' => $resume->getSkills(),
                    'education' => self::getEducation(),
                    'experience' => self::getExperience(),
                    'language' => self::getLanguage()

                ];

                Http::response($res, 200);

            }
            
        }

        /**
         * 
         * @api {get} resume/:id/full Полная запись
         * @apiName GetFullResume
         * @apiGroup Resume
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
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
         * @apiSuccess (200) {String} industry Отрасль
         * @apiSuccess (200) {String} schedule Желаемый график работы
         * @apiSuccess (200) {String} salary Желаемая заплата
         * @apiSuccess (200) {String} workplace Желаемое место работы
         * @apiSuccess (200) {String} compskill Владение компьютером
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
         *      "industry" : "Охрана, безопасность",
         *      "schedule" : "Вахтовый",
         *      "salary" : "99999",
         *      "workplace" : "На территории работодателя",
         *      "compskill" : "Уверенный пользователь",
         *      "car" : "Нет",
         *      "courses" : "Мои курсы...",
         *      "skills" : "Мои навыки...",
         *      "education": [
         *           {
         *               "level": "Среднее",
         *               "inst": "ТГУ",
         *               "city": "Москва",
         *               "faculty": "",
         *               "period": "2011 - 2012"
         *           },
         *           {
         *               "level": "Неоконченное высшее",
         *               "inst": "МГУ",
         *               "city": "Москва",
         *               "faculty": "Физико-математический",
         *               "period": "2005 - 2010"
         *           }
         *       ],
         *       "experience": [
         *           {
         *               "post": "Охранник",
         *               "company": "Моя компания",
         *               "city": "Город",
         *               "industry": "Охрана, безопасность",
         *               "period": "Июнь 2015 - Август 2015",
         *               "functions": "Мои функции"
         *           },
         *           {
         *               "post": "Сторож2",
         *               "company": "Компания",
         *               "city": "Город",
         *               "industry": "Финансы, бухгалтерия",
         *               "period": "Сентябрь 2010 - Октябрь 2015",
         *               "functions": "Мои функции"
         *           },
         *           {
         *               "post": "Сторож2",
         *               "company": "Компания",
         *               "city": "Город",
         *               "industry": "Финансы, бухгалтерия",
         *               "period": "Сентябрь 2010 - Октябрь 2015",
         *               "functions": "Мои функции"
         *           }
         *       ],
         *       "language": [
         *           {
         *               "language": "Украинский",
         *               "lang_level": "Разговорный"
         *           }
         *       ]
         *  }
         * 
         * @apiError Auth Вы не авторизированы
         * @apiError UserAuth Вы должны быть авторизированы под учетной записью пользователя
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Запись не найдена"
         *     }
         * 
         */

        public static function myFullResume(){
                                 
            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы');

            }
            
            if($_SESSION['type'] != '0') { 

                Http::error('Вы должны быть авторизированы под учетной записью пользователя', 403);

            } 

            
            $resume = Resume::getJoinedByUserId($_SESSION['id']);

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
                    'industry' => $resume->getIndustryName(),
                    'schedule' => $resume->getScheduleName(),
                    'salary' => $resume->getSalary(),
                    'workplace' => $resume->getWorkPlaceName(),
                    'compskill' => $resume->getCompSkillName(),
                    'car' => $resume->getCar(),
                    'courses' => $resume->getCourses(),
                    'skills' => $resume->getSkills(),
                    'education' => self::getEducation(),
                    'experience' => self::getExperience(),
                    'language' => self::getLanguage()

                ];

                Http::response($res, 200);

            }

        }

        private function getEducation(){

            $education = Education::getByUserId($_SESSION['id']);

            $edu_arr = array();

            foreach ($education as $edu) {

                $help_edu = HelperEducation::get($edu->getLevelId());

                array_push($edu_arr,

                [

                    'level' => $help_edu->getName(),
                    'inst' => $edu->getInstitute(),
                    'city' => $edu->getCity(),
                    'faculty' => $edu->getFaculty(),
                    'period' => $edu->getStudyPeriod()
    
                ]);

            }

            return $edu_arr;

        }

        private function getLanguage(){
            
            $language = Language::getByUserId($_SESSION['id']);

            $res = array();

            foreach ($language as $lang) {

                $help_lang = HelperLanguage::get($lang->getLangId());

                array_push($res,

                [

                    'language' => $help_lang->getName(),
                    'lang_level' => $lang->getLangLevel()
    
                ]);

            }

            return $res;

        }

        private function getExperience(){

            $experience = Experience::getByUserId($_SESSION['id']);

            $res = array();

            foreach ($experience as $exp) {

                $help_exp = HelperIndustry::get($exp->getIndustryId());

                array_push($res,

                [

                    'post' => $exp->getPost(),
                    'company' => $exp->getCompany(),
                    'city' => $exp->getCity(),
                    'industry' => $help_exp->getName(),
                    'period' => $exp->getWorkPeriod(),
                    'functions' => $exp->getFunctions()
    
                ]);

            }

            return $res;

        }

     }