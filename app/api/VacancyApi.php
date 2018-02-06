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

        /**
         * 
         * @api {post} vacancy/add Создать вакансию
         * @apiName AddVacancy
         * @apiGroup Vacancy
         * @apiVersion  1.0.0
         * 
         * @apiPermission employer
         * 
         * @apiParam {String} email Email пользователя
         * @apiParam {String} company Название компании
         * @apiParam {String} phone Телефонный номер работодателя
         * @apiParam {String} vacancy Название вакансии
         * @apiParam {String} salary Зарплата
         * @apiParam {String} exp Необходимый опыт работы
         * @apiParam {String} location Место работы
         * @apiParam {String} demands Требования
         * @apiParam {String} duties Обязанности
         * @apiParam {String} conditions Условаия работы
         * @apiParam {String} desc Описание вакансии
         * @apiParam {String} schedule ID графика работы
         * @apiParam {String} industry ID отрасли
         * 
         * @apiParamExample  {json} Request-Example:
         *  {
         *     email : "example@test.com",
         *     company : "ООО Серебряный век",
         *     phone : "+79999999999",
         *     vacancy : "Сторож",
         *     salary : "22000-25000",
         *     exp : "1",
         *     location : "Волгоград",
         *     demands : "Стрессоустойчивость, активность, выдержка",
         *     duties : "Совершать обход охраняемого объекта не менее трех раз за смену, при возникновении        пожара на объекте поднимать тревогу",
         *     conditions : "Оклад на испытательный срок далее руб,Предоставление питания в рабочие смены",
         *     desc : "На постоянную работу в дом отдыха с проживанием нужен сторож",
         *     schedule : "1",
         *     industry : "5",
         *  }
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
         * @apiError PermissionDenied У вас недостаточно прав для выполнения данной операции
         * 
         * @apiError Invalid-Company Некорректное поле <code>company</code>
         * @apiError Invalid-Phone Некорректное поле <code>phone</code>
         * @apiError Invalid-Vacancy Некорректное поле <code>vacancy</code>
         * @apiError Invalid-Salary Некорректное поле <code>salary</code>
         * @apiError Invalid-Experience Некорректное поле <code>exp</code>
         * @apiError Invalid-Location Некорректное поле <code>location</code>
         * @apiError Invalid-Demands Некорректное поле <code>demands</code>
         * @apiError Invalid-Duties Некорректное поле <code>duties</code>
         * @apiError Invalid-Conditions Некорректное поле <code>conditions</code>
         * @apiError Invalid-Description Некорректное поле <code>desc</code>
         * @apiError Invalid-IndustryID Некорректное поле <code>industry</code>
         * @apiError Invalid-ScheduleID Некорректное поле <code>schedule</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *   HTTP/1.1 403 Bad Request
         *   {
         *     "error": "У вас недостаточно прав для выполнения данной операции"
         *   }
         * 
         */

        public static function add(){
            
            if($_SESSION['type'] != 1){

                Http::error('У вас недостаточно прав для выполнения данной операции', 403);

            }

            $sender_name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
            $salary = explode("-",htmlspecialchars(trim($_POST['salary'])));
            $salary_min = $salary[0];
            $salary_max = (isset($salary[1])) ? $salary[1] : '';

            $vacancy = new Vacancy(

                null,
                $sender_name,
                $_SESSION['id'],
                $_POST['email'],
                $_POST['company'],
                $_POST['phone'],
                $_POST['vacancy'],
                $salary_min,
                $salary_max,
                $_POST['exp'],
                $_POST['location'],
                $_POST['schedule'],
                $_POST['industry'],
                $_POST['demands'],
                $_POST['duties'],
                $_POST['conditions'],
                $_POST['desc']

            );

            try{
                
                $vacancy->save();

            } catch(Exception $e) {
                
                if ($e->getMessage() == 'company') {

                    Http::error("Некорректное поле [company]");

                } else if ($e->getMessage() == 'phone') {

                    Http::error("Некорректное поле [phone]");

                } else if ($e->getMessage() == 'vacancyName') {

                    Http::error("Некорректное поле [vacancy]");

                } else if ($e->getMessage() == 'salaryMin') {

                    Http::error("Некорректное поле [salary]");

                }  else if ($e->getMessage() == 'salaryMax') {

                    Http::error("Некорректное поле [salary]");

                }  else if ($e->getMessage() == 'experience') {

                    Http::error("Некорректное поле [exp]");

                }  else if ($e->getMessage() == 'location') {

                    Http::error("Некорректное поле [location]");

                }  else if ($e->getMessage() == 'scheduleId') {

                    Http::error("Некорректное поле [schedule]");

                }  else if ($e->getMessage() == 'industryId') {

                    Http::error("Некорректное поле [industry]");

                }  else if ($e->getMessage() == 'demands') {

                    Http::error("Некорректное поле [demands]");

                }  else if ($e->getMessage() == 'duties') {

                    Http::error("Некорректное поле [duties]");

                }  else if ($e->getMessage() == 'conditions') {

                    Http::error("Некорректное поле [conditions]");

                }  else if ($e->getMessage() == 'email') {

                    Http::error("Некорректное поле [email]");

                } 

            }

            $vacancy = Vacancy::getJoined($vacancy->getId());

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

        /**
         * 
         * @api {delete} vacancy/delete/:id Удалить вакансию
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
            
            if($_SESSION['type'] != 1){

                Http::error('У вас недостаточно прав для выполнения данной операции', 403);

            }

            $vacancy = Vacancy::get($router['id']);
            
            if (empty($vacancy->getId())) {

                Http::error('Вакансия не найдена');

            }

            if($vacancy->getSenderId() != $_SESSION['id']){

                Http::error('У вас недостаточно прав для удаления данной записи', 403);

            }

            $vacancy->delete();
           
            Http::success();

        }

        /**
         * 
         * @api {put} vacancy/update/:id Обновить вакансию
         * @apiName UpdateVacancy
         * @apiGroup Vacancy
         * @apiVersion  1.0.0
         * 
         * @apiPermission employer
         * 
         * @apiParam {String} [email] Email пользователя
         * @apiParam {String} [company] Название компании
         * @apiParam {String} [phone] Телефонный номер работодателя
         * @apiParam {String} [vacancy] Название вакансии
         * @apiParam {String} [salary] Зарплата
         * @apiParam {String} [exp] Необходимый опыт работы
         * @apiParam {String} [location] Место работы
         * @apiParam {String} [demands] Требования
         * @apiParam {String} [duties] Обязанности
         * @apiParam {String} [conditions] Условаия работы
         * @apiParam {String} [desc] Описание вакансии
         * @apiParam {String} [schedule] ID графика работы
         * @apiParam {String} [industry] ID отрасли
         * 
         * @apiParamExample  {json} Request-Example:
         *  {
         *     email : "example@test.com",
         *     company : "ООО Серебряный век",
         *     phone : "+79999999999",
         *     vacancy : "Сторож",
         *     salary : "22000-25000",
         *     exp : "1",
         *     location : "Волгоград"
         *  }
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
         * @apiError PermissionDenied У вас недостаточно прав для выполнения данной операции
         * 
         * @apiError Invalid-Company Некорректное поле <code>company</code>
         * @apiError Invalid-Phone Некорректное поле <code>phone</code>
         * @apiError Invalid-Vacancy Некорректное поле <code>vacancy</code>
         * @apiError Invalid-Salary Некорректное поле <code>salary</code>
         * @apiError Invalid-Experience Некорректное поле <code>exp</code>
         * @apiError Invalid-Location Некорректное поле <code>location</code>
         * @apiError Invalid-Demands Некорректное поле <code>demands</code>
         * @apiError Invalid-Duties Некорректное поле <code>duties</code>
         * @apiError Invalid-Conditions Некорректное поле <code>conditions</code>
         * @apiError Invalid-Description Некорректное поле <code>desc</code>
         * @apiError Invalid-IndustryID Некорректное поле <code>industry</code>
         * @apiError Invalid-ScheduleID Некорректное поле <code>schedule</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *   HTTP/1.1 403 Bad Request
         *   {
         *     "error": "У вас недостаточно прав для выполнения данной операции"
         *   }
         * 
         */

        public static function update($router){
                       
            if($_SESSION['type'] != 1){

                Http::error('У вас недостаточно прав для выполнения данной операции', 403);

            }

            $vacancy = Vacancy::get($router['id']);

            if(empty($vacancy->getId())){

                Http::error('Вакансия не найдена');

            }
            
            if($vacancy->getSenderId() != $_SESSION['id']){

                Http::error('У вас недостаточно прав для редактирования данной записи', 403);

            }

            if(isset($_POST['email'])){

                $vacancy->setEmail($_POST['email']);

            }

            if(isset($_POST['company'])){

                $vacancy->setCompany($_POST['company']);

            }

            if(isset($_POST['phone'])){

                $vacancy->setPhone($_POST['phone']);

            }

            if(isset($_POST['vacancy'])){

                $vacancy->setVacancyName($_POST['vacancy']);

            }

            if(isset($_POST['salary'])){


                $salary = explode("-",htmlspecialchars(trim($_POST['salary'])));
                $salary_min = $salary[0];
                $salary_max = (isset($salary[1])) ? $salary[1] : '';

                $vacancy->setSalaryMin($salary_min);
                $vacancy->setSalaryMax($salary_max);

            }

            if(isset($_POST['exp'])){

                $vacancy->setExperience($_POST['exp']);

            }

            if(isset($_POST['location'])){

                $vacancy->setLocation($_POST['location']);

            }

            if(isset($_POST['schedule'])){

                $vacancy->setScheduleId($_POST['schedule']);

            }

            if(isset($_POST['industry'])){

                $vacancy->setIndustryId($_POST['industry']);

            }

            if(isset($_POST['demands'])){

                $vacancy->setDemands($_POST['demands']);

            }

            if(isset($_POST['duties'])){

                $vacancy->setDuties($_POST['duties']);

            }

            if(isset($_POST['conditions'])){

                $vacancy->setConditions($_POST['conditions']);

            }

            if(isset($_POST['desc'])){

                $vacancy->setDescription($_POST['desc']);

            }

            try{
                
                $vacancy->save();

            } catch(Exception $e) {
                
                if ($e->getMessage() == 'company') {

                    Http::error("Некорректное поле [company]");

                } else if ($e->getMessage() == 'phone') {

                    Http::error("Некорректное поле [phone]");

                } else if ($e->getMessage() == 'vacancyName') {

                    Http::error("Некорректное поле [vacancy]");

                } else if ($e->getMessage() == 'salaryMin') {

                    Http::error("Некорректное поле [salary]");

                }  else if ($e->getMessage() == 'salaryMax') {

                    Http::error("Некорректное поле [salary]");

                }  else if ($e->getMessage() == 'experience') {

                    Http::error("Некорректное поле [exp]");

                }  else if ($e->getMessage() == 'location') {

                    Http::error("Некорректное поле [location]");

                }  else if ($e->getMessage() == 'scheduleId') {

                    Http::error("Некорректное поле [schedule]");

                }  else if ($e->getMessage() == 'industryId') {

                    Http::error("Некорректное поле [industry]");

                }  else if ($e->getMessage() == 'demands') {

                    Http::error("Некорректное поле [demands]");

                }  else if ($e->getMessage() == 'duties') {

                    Http::error("Некорректное поле [duties]");

                }  else if ($e->getMessage() == 'conditions') {

                    Http::error("Некорректное поле [conditions]");

                }  else if ($e->getMessage() == 'email') {

                    Http::error("Некорректное поле [email]");

                } 

            }

            $vacancy = Vacancy::getJoined($vacancy->getId());

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