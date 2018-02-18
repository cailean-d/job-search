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
                    'method' => 'post',
                    'url' => 'resume/update',
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

        /**
         * 
         * @api {post} resume Создать
         * @apiName AddResume
         * @apiGroup Resume
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiParam  {String} firstname Имя
         * @apiParam  {String} lastname Фамилия
         * @apiParam  {String} patronymic Отчество
         * @apiParam  {String} gender Пол
         * @apiParam  {String} birthday Дата рождения
         * @apiParam  {String} city Город
         * @apiParam  {String} phone Телефон
         * @apiParam  {String} email Почта
         * @apiParam  {String} post Желаемая должность
         * @apiParam  {String} industry_id ID отрасли
         * @apiParam  {String} schedule_id Желаемый график работы
         * @apiParam  {String} salary Желаемая заплата
         * @apiParam  {String} work_place_id Желаемое место работы
         * @apiParam  {String} [comp_skill_id] Владение компьютером
         * @apiParam  {String} [car] Наличие авто
         * @apiParam  {String} [courses] Пройденные курсы, тренинги
         * @apiParam  {String} [skills] Навыки и умения
         * @apiParam  {Blob} [avatar] Файл
         * 
         * @apiParamExample  {json} Request-Example:
         *  {
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
         *      "avatar" : "C://avatar.jpg",
         *  }
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
         * @apiError RecordExists Запись уже существует
         * 
         * @apiError Invalid-Firstname Некорректное поле <code>firstname</code>
         * @apiError Invalid-Lastname Некорректное поле <code>lastname</code>
         * @apiError Invalid-Patronymic Некорректное поле <code>patronymic</code>
         * @apiError Invalid-Gender Некорректное поле <code>gender</code>
         * @apiError Invalid-Birthday Некорректное поле <code>birthday</code>
         * @apiError Invalid-City Некорректное поле <code>city</code>
         * @apiError Invalid-Phone Некорректное поле <code>phone</code>
         * @apiError Invalid-Email Некорректное поле <code>email</code>
         * @apiError Invalid-Post Некорректное поле <code>post</code>
         * @apiError Invalid-IndustryId Некорректное поле <code>industry_id</code>
         * @apiError Invalid-ScheduleId Некорректное поле <code>schedule_id</code>
         * @apiError Invalid-Salary Некорректное поле <code>salary</code>
         * @apiError Invalid-WorkplaceId Некорректное поле <code>work_place_id</code>
         * @apiError Invalid-CompskillId Некорректное поле <code>comp_skill_id</code>
         * @apiError Invalid-Car Некорректное поле <code>car</code>
         * @apiError Invalid-Courses Некорректное поле <code>courses</code>
         * @apiError Invalid-Skills Некорректное поле <code>skills</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Некорректное поле [edu_level]"
         *     }
         * 
         */

        public static function add(){
                                 
            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы');

            }
            
            if($_SESSION['type'] != '0') { 

                Http::error('Вы должны быть авторизированы под учетной записью пользователя', 403);

            } 

            $resume = Resume::getByUserId($_SESSION['id']);

            if (!empty($resume->getId())) {

                Http::error('Запись уже существует');

            }
            
            $help_edu = HelperIndustry::get($_POST['industry_id']);

            if(empty($help_edu->getId())){

                Http::error('Некорректное поле [industry_id]');

            }

            $help_schedule = HelperSchedule::get($_POST['schedule_id']);

            if(empty($help_schedule->getId())){

                Http::error('Некорректное поле [schedule_id]');

            }

            $help_work = HelperWorkPlace::get($_POST['work_place_id']);

            if(empty($help_work->getId())){

                Http::error('Некорректное поле [work_place_id]');

            }

            if(isset($_POST['comp_skill_id'])){


                $help_compskill = HelperCompSkill::get($_POST['comp_skill_id']);

                if(empty($help_compskill->getId())){
    
                    Http::error('Некорректное поле [comp_skill_id]');
    
                }
    

            }

            if($_FILES["avatar"]){

                $avatar = Avatar::get($_SESSION['id']);

                if(empty($avatar->getId())){
    
                    $avatar->setUserid($_SESSION['id']);
    
                }
    
                $avatar->setFile($_FILES["avatar"]);
    
                try{
                    
                    $avatar->save();
    
                } catch(Exception $e){
                    
                    if($e->getMessage() == 'FILE_DOES_NOT_EXIST'){
    
                        Http::error("Файл не был загружен");
    
                    } else if ($e->getMessage() == 'UPLOAD_MAX_FIZESIZE') {
    
                        Http::error("Файл не должен весить более 3МБ");
    
                    } else if ($e->getMessage() == 'UPLOAD_FILE_ERROR') {
    
                        Http::error("Ошибка загрузки файла");
    
                    } 
    
                }

            }

            $resume = new Resume(
                        
                null, 
                $_SESSION['id'], 
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['patronymic'],
                $_POST['gender'],
                $_POST['birthday'],
                $_POST['city'],
                $_POST['phone'],
                $_POST['email'],
                $_POST['post'],
                $_POST['industry_id'],
                $_POST['schedule_id'],
                $_POST['salary'],
                $_POST['work_place_id']

            );


            if(isset($_POST['comp_skill_id'])){

                $resume->setCompSkillId($_POST['comp_skill_id']);

            }

            if(isset($_POST['car'])){

                $resume->setCar($_POST['car']);

            }

            if(isset($_POST['courses'])){

                $resume->setCourses($_POST['courses']);

            }

            if(isset($_POST['skills'])){

                $resume->setSkills($_POST['skills']);

            }

            try{
                
                $resume->save();

            } catch(Exception $e){
                
                if($e->getMessage() == 'firstname'){

                    Http::error("Некорректное поле [firstname]");

                } else if ($e->getMessage() == 'lastname') {

                    Http::error("Некорректное поле [lastname]");

                } else if ($e->getMessage() == 'patronymic') {

                    Http::error("Некорректное поле [patronymic]");

                } else if ($e->getMessage() == 'gender') {

                    Http::error("Некорректное поле [gender]");

                } else if ($e->getMessage() == 'birthday') {

                    Http::error("Некорректное поле [birthday]");

                } else if ($e->getMessage() == 'city') {

                    Http::error("Некорректное поле [city]");

                } else if ($e->getMessage() == 'phone') {

                    Http::error("Некорректное поле [phone]");

                } else if ($e->getMessage() == 'email') {

                    Http::error("Некорректное поле [email]");

                } else if ($e->getMessage() == 'post') {

                    Http::error("Некорректное поле [post]");

                } else if ($e->getMessage() == 'industryId') {

                    Http::error("Некорректное поле [industry_id]");

                } else if ($e->getMessage() == 'scheduleId') {

                    Http::error("Некорректное поле [schedule_id]");

                } else if ($e->getMessage() == 'salary') {

                    Http::error("Некорректное поле [salary]");

                } else if ($e->getMessage() == 'workPlaceId') {

                    Http::error("Некорректное поле [work_place_id]");

                } else if ($e->getMessage() == 'compSkillId') {

                    Http::error("Некорректное поле [comp_skill_id]");

                } else if ($e->getMessage() == 'car') {

                    Http::error("Некорректное поле [car]");

                } else if ($e->getMessage() == 'courses') {

                    Http::error("Некорректное поле [courses]");

                } else if ($e->getMessage() == 'skills') {

                    Http::error("Некорректное поле [skills]");

                }

            }

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

        /**
         * 
         * @api {post} resume/update Обновить
         * @apiName UpdateResume
         * @apiGroup Resume
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiParam  {String} [firstname] Имя
         * @apiParam  {String} [lastname] Фамилия
         * @apiParam  {String} [patronymic] Отчество
         * @apiParam  {String} [gender] Пол
         * @apiParam  {String} [birthday] Дата рождения
         * @apiParam  {String} [city] Город
         * @apiParam  {String} [phone] Телефон
         * @apiParam  {String} [email] Почта
         * @apiParam  {String} [post] Желаемая должность
         * @apiParam  {String} [industry_id] ID отрасли
         * @apiParam  {String} [schedule_id] Желаемый график работы
         * @apiParam  {String} [salary] Желаемая заплата
         * @apiParam  {String} [work_place_id] Желаемое место работы
         * @apiParam  {String} [comp_skill_id] Владение компьютером
         * @apiParam  {String} [car] Наличие авто
         * @apiParam  {String} [courses] Пройденные курсы, тренинги
         * @apiParam  {String} [skills] Навыки и умения
         * @apiParam  {Blob} [avatar] Файл
         * 
         * @apiParamExample  {json} Request-Example:
         *  {
         *      "firstname" : "Петр",
         *      "lastname" : "Петров",
         *      "patronymic" : "Владимирович",
         *      "gender" : "Мужской",
         *      "birthday" : "01.01.1980",
         *      "city" : "Москва",
         *      "phone" : "+79999999999",
         *  }
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
         * @apiError RecordDoesNotExist Запись не найдена
         * 
         * @apiError Invalid-Firstname Некорректное поле <code>firstname</code>
         * @apiError Invalid-Lastname Некорректное поле <code>lastname</code>
         * @apiError Invalid-Patronymic Некорректное поле <code>patronymic</code>
         * @apiError Invalid-Gender Некорректное поле <code>gender</code>
         * @apiError Invalid-Birthday Некорректное поле <code>birthday</code>
         * @apiError Invalid-City Некорректное поле <code>city</code>
         * @apiError Invalid-Phone Некорректное поле <code>phone</code>
         * @apiError Invalid-Email Некорректное поле <code>email</code>
         * @apiError Invalid-Post Некорректное поле <code>post</code>
         * @apiError Invalid-IndustryId Некорректное поле <code>industry_id</code>
         * @apiError Invalid-ScheduleId Некорректное поле <code>schedule_id</code>
         * @apiError Invalid-Salary Некорректное поле <code>salary</code>
         * @apiError Invalid-WorkplaceId Некорректное поле <code>work_place_id</code>
         * @apiError Invalid-CompskillId Некорректное поле <code>comp_skill_id</code>
         * @apiError Invalid-Car Некорректное поле <code>car</code>
         * @apiError Invalid-Courses Некорректное поле <code>courses</code>
         * @apiError Invalid-Skills Некорректное поле <code>skills</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Некорректное поле [edu_level]"
         *     }
         * 
         */

        public static function update(){
                         
            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы');

            }
            
            if($_SESSION['type'] != '0') { 

                Http::error('Вы должны быть авторизированы под учетной записью пользователя', 403);

            } 

            $resume = Resume::getByUserId($_SESSION['id']);

            if (empty($resume->getId())) {

                Http::error('Запись не найдена');

            }
            
            if(isset($_POST['firstname'])){

                $resume->setFirstname($_POST['firstname']);

            }

            if(isset($_POST['lastname'])){

                $resume->setLastname($_POST['lastname']);

            }

            if(isset($_POST['patronymic'])){

                $resume->setPatronymic($_POST['patronymic']);

            }

            if(isset($_POST['gender'])){

                $resume->setGender($_POST['gender']);

            }

            if(isset($_POST['birthday'])){

                $resume->setBirthday($_POST['birthday']);

            }

            if(isset($_POST['city'])){

                $resume->setCity($_POST['city']);

            }

            if(isset($_POST['phone'])){

                $resume->setPhone($_POST['phone']);

            }

            if(isset($_POST['email'])){

                $resume->setEmail($_POST['email']);

            }

            if(isset($_POST['post'])){

                $resume->setPost($_POST['post']);

            }

            if(isset($_POST['salary'])){

                $resume->setSalary($_POST['salary']);

            }

            if(isset($_POST['industry_id'])){

                $help_edu = HelperIndustry::get($_POST['industry_id']);

                if(empty($help_edu->getId())){
    
                    Http::error('Некорректное поле [industry_id]');
    
                }

                $resume->setIndustryId($_POST['industry_id']);

            }
            
            if(isset($_POST['schedule_id'])){

                $help_schedule = HelperSchedule::get($_POST['schedule_id']);

                if(empty($help_schedule->getId())){
    
                    Http::error('Некорректное поле [schedule_id]');
    
                }

                $resume->setScheduleId($_POST['schedule_id']);

            }

            if(isset($_POST['work_place_id'])){

                $help_work = HelperWorkPlace::get($_POST['work_place_id']);

                if(empty($help_work->getId())){
    
                    Http::error('Некорректное поле [work_place_id]');
    
                }

                $resume->setWorkPlaceId($_POST['work_place_id']);
            }

            if(isset($_POST['comp_skill_id'])){

                $help_compskill = HelperCompSkill::get($_POST['comp_skill_id']);

                if(empty($help_compskill->getId())){
    
                    Http::error('Некорректное поле [comp_skill_id]');
    
                }

                $resume->setCompSkillId($_POST['comp_skill_id']);

            }

            if(isset($_POST['car'])){

                $resume->setCar($_POST['car']);

            }

            if(isset($_POST['courses'])){

                $resume->setCourses($_POST['courses']);

            }

            if(isset($_POST['skills'])){

                $resume->setSkills($_POST['skills']);

            }

            if($_FILES["avatar"]){

                $avatar = Avatar::get($_SESSION['id']);

                if(empty($avatar->getId())){
    
                    $avatar->setUserid($_SESSION['id']);
    
                }
    
                $avatar->setFile($_FILES["avatar"]);
    
                try{
                    
                    $avatar->save();
    
                } catch(Exception $e){
                    
                    if($e->getMessage() == 'FILE_DOES_NOT_EXIST'){
    
                        Http::error("Файл не был загружен");
    
                    } else if ($e->getMessage() == 'UPLOAD_MAX_FIZESIZE') {
    
                        Http::error("Файл не должен весить более 3МБ");
    
                    } else if ($e->getMessage() == 'UPLOAD_FILE_ERROR') {
    
                        Http::error("Ошибка загрузки файла");
    
                    } 
    
                }

            }

            try{
                
                $resume->save();

            } catch(Exception $e){
                
                if($e->getMessage() == 'firstname'){

                    Http::error("Некорректное поле [firstname]");

                } else if ($e->getMessage() == 'lastname') {

                    Http::error("Некорректное поле [lastname]");

                } else if ($e->getMessage() == 'patronymic') {

                    Http::error("Некорректное поле [patronymic]");

                } else if ($e->getMessage() == 'gender') {

                    Http::error("Некорректное поле [gender]");

                } else if ($e->getMessage() == 'birthday') {

                    Http::error("Некорректное поле [birthday]");

                } else if ($e->getMessage() == 'city') {

                    Http::error("Некорректное поле [city]");

                } else if ($e->getMessage() == 'phone') {

                    Http::error("Некорректное поле [phone]");

                } else if ($e->getMessage() == 'email') {

                    Http::error("Некорректное поле [email]");

                } else if ($e->getMessage() == 'post') {

                    Http::error("Некорректное поле [post]");

                } else if ($e->getMessage() == 'industryId') {

                    Http::error("Некорректное поле [industry_id]");

                } else if ($e->getMessage() == 'scheduleId') {

                    Http::error("Некорректное поле [schedule_id]");

                } else if ($e->getMessage() == 'salary') {

                    Http::error("Некорректное поле [salary]");

                } else if ($e->getMessage() == 'workPlaceId') {

                    Http::error("Некорректное поле [work_place_id]");

                } else if ($e->getMessage() == 'compSkillId') {

                    Http::error("Некорректное поле [comp_skill_id]");

                } else if ($e->getMessage() == 'car') {

                    Http::error("Некорректное поле [car]");

                } else if ($e->getMessage() == 'courses') {

                    Http::error("Некорректное поле [courses]");

                } else if ($e->getMessage() == 'skills') {

                    Http::error("Некорректное поле [skills]");

                }

            }

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

        /**
         * 
         * @api {delete} resume Удалить
         * @apiName DeleteResume
         * @apiGroup Resume
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiSuccess (200) {String} success Запись успешно удалена
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "success" : "true"
         *  }
         * 
         * @apiError VacancyNotFound Запись не найдена
         * @apiError Auth Вы не авторизированы
         * @apiError UserAuth Вы должны быть авторизированы под учетной записью пользователя
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 403 Bad Request
         *     {
         *       "error": "Вы должны быть авторизированы под учетной записью пользователя"
         *     }
         * 
         */

        public static function delete(){
                     
            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы');

            }
            
            if($_SESSION['type'] != '0') { 

                Http::error('Вы должны быть авторизированы под учетной записью пользователя', 403);

            } 

            $resume = Resume::getByUserId($_SESSION['id']);
            
            if (empty($resume->getId())) {

                Http::error('Запись не найдена');

            }

            $resume->delete();

            $education = Education::getByUserId($_SESSION['id']);

            foreach ($education as $edu) {

                $edu->delete();

            }
           
            $experience = Experience::getByUserId($_SESSION['id']);

            foreach ($experience as $exp) {

                $exp->delete();

            }
                       
            $language = Language::getByUserId($_SESSION['id']);

            foreach ($language as $lang) {

                $lang->delete();

            }

            Http::success();

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
         * @api {get} resume/:id/full Полная запись
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
         * @api {get} resume/full Полное резюме
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