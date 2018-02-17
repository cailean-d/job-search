<?php

    /**
     * @apiDefine auth Вы должны быть авторизированы под учетноый записью пользователя
     */

    final class ExperienceApi{

        public static function init(){

            return array(

                [
                    'method' => 'post',
                    'url' => 'experience',
                    'handler' => 'add'
                ],

                [
                    'method' => 'put',
                    'url' => 'experience',
                    'handler' => 'update'
                ],

                [
                    'method' => 'delete',
                    'url' => 'experience/:id{number}',
                    'handler' => 'delete'
                ],

                [
                    'method' => 'delete',
                    'url' => 'experience',
                    'handler' => 'deleteArray'
                ]

            );

        }

        /**
         * 
         * @api {post} experience Добавить
         * @apiName AddExperience
         * @apiGroup Resume_Experience
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiParam  {String} exp_post Должность
         * @apiParam  {String} exp_company Компания
         * @apiParam  {String} exp_city Город
         * @apiParam  {String} exp_industry ID отрасли
         * @apiParam  {String} work_period Период работы
         * @apiParam  {String} exp_func Обязанности и функции
         * @apiParam  {String} [data] Вы можете отправить массив языков в json формате
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      "exp_post" : "Сторож",
         *      "exp_company" : "Компания",
         *      "exp_city" : "Москва",
         *      "exp_industry" : "14",
         *      "work_period" : "Июнь 2016 - Август 2018",
         *      "exp_func" : "Функции..."
         * }
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} user_id ID пользователя
         * @apiSuccess (200) {String} post Должность
         * @apiSuccess (200) {String} company Компания
         * @apiSuccess (200) {String} city Город
         * @apiSuccess (200) {String} industry Отрасль
         * @apiSuccess (200) {String} period Период работы
         * @apiSuccess (200) {String} functions Обязанности и функции
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "2",
         *      "user_id" : "5",
         *      "post" : "Сторож",
         *      "company" : "Компания",
         *      "city" : "Москва",
         *      "industry" : "Охрана, безопасность",
         *      "period" : "Июнь 2016 - Август 2018",
         *      "functions" : "Функции..."
         *  }
         * 
         * @apiError Auth Вы не авторизированы
         * @apiError UserAuth Вы должны быть авторизированы под учетной записью пользователя
         * @apiError DataIsNotValid Некорректный объект <code>data</code>
         * @apiError DataFieldIsNotValid Объект должен содержать поле <code>exp_post</code>
         * @apiError DataFieldIsNotValid Объект должен содержать поле <code>exp_company</code>
         * @apiError DataFieldIsNotValid Объект должен содержать поле <code>exp_city</code>
         * @apiError DataFieldIsNotValid2 Объект должен содержать поле <code>exp_industry</code>
         * @apiError DataFieldIsNotValid3 Объект должен содержать поле <code>work_period</code>
         * @apiError DataFieldIsNotValid4 Объект должен содержать поле <code>exp_func</code>
         * 
         * @apiError Invalid-LevelId Некорректное поле <code>exp_post</code>
         * @apiError Invalid-Institute Некорректное поле <code>exp_company</code>
         * @apiError Invalid-City Некорректное поле <code>exp_city</code>
         * @apiError Invalid-Period Некорректное поле <code>exp_industry</code>
         * @apiError Invalid-Faculty Некорректное поле <code>work_period</code>
         * @apiError Invalid-Faculty Некорректное поле <code>exp_func</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Некорректное поле [exp_level]"
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

            if(isset($_POST['data'])){


                if(!Model::isJson($data)){

                    Http::error('Некорректный объект [data]');
    
                }

                $data = json_decode($_POST['data']);

                $res = array();
        
                foreach ($data as $obj) {
        
                    if(!isset($obj->exp_post)){

                        Http::error('Объект должен содержать поле [exp_post]');

                    }

                    if(!isset($obj->exp_company)){

                        Http::error('Объект должен содержать поле [exp_company]');

                    }
        
                    if(!isset($obj->exp_city)){

                        Http::error('Объект должен содержать поле [exp_city]');

                    }

                    if(!isset($obj->exp_industry)){

                        Http::error('Объект должен содержать поле [exp_industry]');

                    }

                    if(!isset($obj->work_period)){

                        Http::error('Объект должен содержать поле [work_period]');

                    }

                    if(!isset($obj->exp_func)){

                        Http::error('Объект должен содержать поле [exp_func]');

                    }

                    $help_exp = HelperIndustry::get($obj->exp_industry);

                    if(empty($help_exp->getId())){

                        Http::error('Некорректное поле [exp_industry]');

                    }
        
                    $experience = new Experience(
                        
                        null, 
                        $_SESSION['id'], 
                        $obj->exp_post,
                        $obj->exp_company,
                        $obj->exp_city,
                        $obj->exp_industry,
                        $obj->work_period,
                        $obj->exp_func 

                    );

                    self::saveExp($experience);

                    array_push($res, 
                    
                    [

                        'id' => $experience->getId(),
                        'user_id' => $experience->getUserId(),
                        'post' => $experience->getPost(),
                        'company' => $experience->getCompany(),
                        'city' => $experience->getCity(),
                        'industry' => $help_exp->getName(),
                        'period' => $experience->getWorkPeriod(),
                        'functions' => $experience->getFunctions()
        
                    ]);

                }

                Http::response($res, 200);

            } else {

                $help_exp = HelperIndustry::get($_POST['exp_industry']);

                if(empty($help_exp->getId())){

                    Http::error('Некорректное поле [exp_industry]');

                }
    
                $experience = new Experience(
                    
                    null, 
                    $_SESSION['id'], 
                    $_POST['exp_post'],
                    $_POST['exp_company'],
                    $_POST['exp_city'],
                    $_POST['exp_industry'],
                    $_POST['work_period'],
                    $_POST['exp_func']

                );

                self::saveExp($experience);
                

                $res = [

                    'id' => $experience->getId(),
                    'user_id' => $experience->getUserId(),
                    'post' => $experience->getPost(),
                    'company' => $experience->getCompany(),
                    'city' => $experience->getCity(),
                    'industry' => $help_exp->getName(),
                    'period' => $experience->getWorkPeriod(),
                    'functions' => $experience->getFunctions()
    
                ];
    
                Http::response($res, 200);

            }

        }

        /**
         * 
         * @api {put} experience Обновить
         * @apiName UpdateExperience
         * @apiGroup Resume_Experience
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiParam  {String} record_id ID записи
         * @apiParam  {String} [exp_level] ID Уровень образования
         * @apiParam  {String} [exp_inst] Название учебного заведения
         * @apiParam  {String} [exp_city] Город
         * @apiParam  {String} [exp_fac] Факультет
         * @apiParam  {String} [exp_period] Период учебы
         * @apiParam  {String} [data] Вы можете отправить массив языков в json формате
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      "record_id" : "5",
         *      "exp_level" : "3",
         *      "exp_fac" : "Физико-математический",
         *      "exp_period" : "2005-2010"
         * }
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} level Уровень образования
         * @apiSuccess (200) {String} institute Название учебного заведения
         * @apiSuccess (200) {String} city Город
         * @apiSuccess (200) {String} faculty Факультет
         * @apiSuccess (200) {String} period Период учебы
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1",
         *      "level" : "Высшее",
         *      "institute" : "МГУ",
         *      "city" : "Москва",
         *      "faculty" : "Физико-математический",
         *      "period" : "2005-2010"
         *  }
         * 
         * @apiError Auth Вы не авторизированы
         * @apiError UserAuth Вы должны быть авторизированы под учетноый записью пользователя
         * @apiError DataIsNotValid Некорректный объект <code>data</code>
         * @apiError PermissionDenied Вы не можете редактировать чужую запись
         * 
         * @apiError DataFieldIsNotValid Объект должен содержать поле <code>record_id</code>
         * @apiError Invalid-LevelId Некорректное поле <code>exp_level</code>
         * @apiError Invalid-Institute Некорректное поле <code>exp_inst</code>
         * @apiError Invalid-City Некорректное поле <code>exp_city</code>
         * @apiError Invalid-Period Некорректное поле <code>exp_period</code>
         * @apiError Invalid-Faculty Некорректное поле <code>exp_fac</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Некорректное поле [exp_level]"
         *     }
         * 
         */

        public static function update($router){
         
            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы');

            }
            
            if($_SESSION['type'] != '0') { 

                Http::error('Вы должны быть авторизированы под учетной записью пользователя', 403);

            } 

            if(isset($_POST['data'])){


                if(!Model::isJson($data)){

                    Http::error('Некорректный объект [data]');
    
                }

                $data = json_decode($_POST['data']);

                $res = array();
        
                foreach ($data as $obj) {

                    if(!isset($obj->record_id)){

                        Http::error('Объект должен содержать поле [record_id]');

                    }

                    $exp = Experience::get($obj->record_id);

                    if(empty($exp->getId())){

                        Http::error('Запись '.$obj->record_id.' не найдена');

                    }

                    if($exp->getUserId() != $_SESSION['id']){

                        Http::error('Вы не можете редактировать чужую запись', 403);
        
                    }

                    if(isset($obj->exp_level)){

                        $help_exp = HelperIndustry::get($obj->exp_level);

                        if(empty($help_exp->getId())){
        
                            Http::error('Некорректное поле [exp_level]');
        
                        }

                        $exp->setLevelId($obj->exp_level);

                    }

                    if(isset($obj->exp_inst)){

                        $exp->setInstitute($obj->exp_inst);

                    }

                    if(isset($obj->exp_city)){

                        $exp->setCity($obj->exp_city);

                    }

                    if(isset($obj->exp_fac)){

                        $exp->setFaculty($obj->exp_fac);

                    }

                    if(isset($obj->exp_period)){

                        $exp->setStudyPeriod($obj->exp_period);

                    }

                    self::saveExp($exp);

                    array_push($res, 
                    
                    [

                        'id' => $exp->getId(),
                        'user_id' => $exp->getUserId(),
                        'level_id' => $exp->getLevelId(),
                        'inst' => $exp->getInstitute(),
                        'city' => $exp->getCity(),
                        'faculty' => $exp->getFaculty(),
                        'period' => $exp->getStudyPeriod()
        
                    ]);

                }

                Http::response($res, 200);

            } else {

                if(!isset($GLOBALS['PUT']['record_id'])){

                    Http::error('Объект должен содержать поле [record_id]');

                }

                $exp = Experience::get($GLOBALS['PUT']['record_id']);

                if(empty($exp->getId())){

                    Http::error('Запись '.$GLOBALS['PUT']['record_id'].' не найдена');

                }

                if($exp->getUserId() != $_SESSION['id']){

                    Http::error('Вы не можете редактировать чужую запись', 403);
    
                }

                if(isset($GLOBALS['PUT']['exp_level'])){

                    $help_exp = HelperIndustry::get($GLOBALS['PUT']['exp_level']);

                    if(empty($help_exp->getId())){
    
                        Http::error('Некорректное поле [exp_level]');
    
                    }

                    $exp->setLevelId($GLOBALS['PUT']['exp_level']);

                }

                if(isset($GLOBALS['PUT']['exp_inst'])){

                    $exp->setInstitute($GLOBALS['PUT']['exp_inst']);

                }

                if(isset($GLOBALS['PUT']['exp_city'])){

                    $exp->setCity($GLOBALS['PUT']['exp_city']);

                }

                if(isset($GLOBALS['PUT']['exp_fac'])){

                    $exp->setFaculty($GLOBALS['PUT']['exp_fac']);

                }

                if(isset($GLOBALS['PUT']['exp_period'])){

                    $exp->setStudyPeriod($GLOBALS['PUT']['exp_period']);

                }

                self::saveExp($exp);

                $res = [

                    'id' => $exp->getId(),
                    'user_id' => $exp->getUserId(),
                    'level' => $help_exp->getName(),
                    'inst' => $exp->getInstitute(),
                    'city' => $exp->getCity(),
                    'faculty' => $exp->getFaculty(),
                    'period' => $exp->getStudyPeriod()
    
                ];
    
                Http::response($res, 200);

            }

        }

        /**
         * 
         * @api {delete} experience/:id Удалить
         * @apiName DeleteExperience
         * @apiGroup Resume_Experience
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiSuccess (200) {String} success Удаление прошло успешно
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      success : true
         *  }
         * 
         * @apiError Auth Вы не авторизированы
         * @apiError UserAuth Вы должны быть авторизированы под учетноый записью пользователя
         * @apiError RecordNotFound Запись не найдена
         * @apiError PermissionDenied Вы не можете удалить чужую запись
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 403 Bad Request
         *     {
         *       "error": "Вы не можете удалить чужую запись"
         *     }
         * 
         */

        public static function delete($router){
            
            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы');

            }
            
            if($_SESSION['type'] != '0') { 

                Http::error('Вы должны быть авторизированы под учетной записью пользователя', 403);

            }

            $exp = Experience::get($router['id']);

            if(empty($exp->getId())){

                Http::error('Запись ' . $router['id'] . ' не найдена');

            }

            if($exp->getUserId() != $_SESSION['id']){

                Http::error('Вы не можете удалить чужую запись', 403);

            }

            $exp->delete();

            Http::success();

        }

        /**
         * 
         * @api {delete} experience Удалить несколько
         * @apiName DeleteArrayExperience
         * @apiGroup Resume_Experience
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiParam  {String} data Массив ID, которые надо удалить
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      "data" : "1, 2, 3, 4, 5"
         * }
         * 
         * @apiSuccess (200) {String} success Удаление прошло успешно
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      success : true
         *  }
         * 
         * @apiError Auth Вы не авторизированы
         * @apiError UserAuth Вы должны быть авторизированы под учетноый записью пользователя
         * @apiError RecordNotFound Запись не найдена
         * @apiError PermissionDenied Вы не можете удалить чужую запись
         * @apiError Invalid-Data Некорректный массив <code>data</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 403 Forbidden
         *     {
         *       "error": "Вы должны быть авторизированы под учетноый записью пользователя"
         *     }
         * 
         */

        public static function deleteArray(){

            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы');

            }
            
            if($_SESSION['type'] != '0') { 

                Http::error('Вы должны быть авторизированы под учетной записью пользователя', 403);

            } 

            if(!isset($GLOBALS['PUT']['data'])){

                Http::error('Отсутствует массив [data]');

            }

            if(!preg_match('/^((\s)*\d+(\s)*)((\s)*\,(\s)*\d+)*$/u', $GLOBALS['PUT']['data'])){

                Http::error('Некорректный массив [data]');

            }

            $data = explode(",", $GLOBALS['PUT']['data']);

            foreach ($data as $id) {

                $_id = trim($id);
                
                $exp = Experience::get($_id);

                if(empty($exp->getId())){
    
                    Http::error('Запись ' . $_id . ' не найдена');
    
                }
    
                if($exp->getUserId() != $_SESSION['id']){
    
                    Http::error('Вы не можете удалить чужую запись', 403);
    
                }
    
                $exp->delete();

            }

            Http::success();

        }

        private function saveExp($experience){

            try{
                
                $experience->save();

            } catch(Exception $e){
                
                if($e->getMessage() == 'userid'){

                    Http::error("Некорректное поле [userid]");

                } else if ($e->getMessage() == 'post') {

                    Http::error("Некорректное поле [exp_post]");

                } else if ($e->getMessage() == 'company') {

                    Http::error("Некорректное поле [exp_company]");

                } else if ($e->getMessage() == 'city') {

                    Http::error("Некорректное поле [exp_city]");

                } else if ($e->getMessage() == 'industryId') {

                    Http::error("Некорректное поле [exp_industry]");

                } else if ($e->getMessage() == 'workPeriod') {

                    Http::error("Некорректное поле [work_period]");

                } else if ($e->getMessage() == 'functions') {

                    Http::error("Некорректное поле [exp_func]");

                }

            }

        }

    }