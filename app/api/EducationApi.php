<?php

    /**
     * @apiDefine auth Вы должны быть авторизированы под учетноый записью пользователя
     */

    final class EducationApi{

        public static function init(){

            return array(

                [
                    'method' => 'post',
                    'url' => 'education',
                    'handler' => 'add'
                ],

                [
                    'method' => 'put',
                    'url' => 'education',
                    'handler' => 'update'
                ],

                [
                    'method' => 'delete',
                    'url' => 'education/:id{number}',
                    'handler' => 'delete'
                ],

                [
                    'method' => 'delete',
                    'url' => 'education',
                    'handler' => 'deleteArray'
                ]

            );

        }

        /**
         * 
         * @api {post} education Добавить
         * @apiName AddEducation
         * @apiGroup Resume_Education
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiParam  {String} edu_level ID Уровень образования
         * @apiParam  {String} edu_inst Название учебного заведения
         * @apiParam  {String} edu_city Город
         * @apiParam  {String} edu_fac Факультет
         * @apiParam  {String} edu_period Период учебы
         * @apiParam  {String} [data] Вы можете отправить массив языков в json формате
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      "edu_level" : "3",
         *      "edu_inst" : "МГУ",
         *      "edu_city" : "Москва",
         *      "edu_fac" : "Физико-математический",
         *      "edu_period" : "2005-2010"
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
         * @apiError UserAuth Вы должны быть авторизированы под учетной записью пользователя
         * @apiError DataIsNotValid Некорректный объект <code>data</code>
         * @apiError DataFieldIsNotValid Объект должен содержать поле <code>edu_level</code>
         * @apiError DataFieldIsNotValid2 Объект должен содержать поле <code>edu_inst</code>
         * @apiError DataFieldIsNotValid3 Объект должен содержать поле <code>edu_city</code>
         * @apiError DataFieldIsNotValid4 Объект должен содержать поле <code>edu_period</code>
         * 
         * @apiError Invalid-LevelId Некорректное поле <code>edu_level</code>
         * @apiError Invalid-Institute Некорректное поле <code>edu_inst</code>
         * @apiError Invalid-City Некорректное поле <code>edu_city</code>
         * @apiError Invalid-Period Некорректное поле <code>edu_period</code>
         * @apiError Invalid-Faculty Некорректное поле <code>edu_fac</code>
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

            if(isset($_POST['data'])){


                if(!Model::isJson($data)){

                    Http::error('Некорректный объект [data]');
    
                }

                $data = json_decode($_POST['data']);

                $res = array();
        
                foreach ($data as $obj) {
        
                    if(!isset($obj->edu_level)){

                        Http::error('Объект должен содержать поле [edu_level]');

                    }

                    if(!isset($obj->edu_inst)){

                        Http::error('Объект должен содержать поле [edu_inst]');

                    }
        
                    if(!isset($obj->edu_city)){

                        Http::error('Объект должен содержать поле [edu_city]');

                    }

                    if(!isset($obj->edu_period)){

                        Http::error('Объект должен содержать поле [edu_period]');

                    }

                    $help_edu = HelperEducation::get($obj->edu_id);

                    if(empty($help_edu->getId())){

                        Http::error('Некорректное поле [edu_level]');

                    }
        
                    $education = new Education(
                        
                        null, 
                        $_SESSION['id'], 
                        $obj->edu_level,
                        $obj->edu_inst,
                        $obj->edu_city,
                        $obj->edu_fac,
                        $obj->edu_period 

                    );

                    self::saveEdu($education);

                    array_push($res, 
                    
                    [

                        'id' => $education->getId(),
                        'user_id' => $education->getUserId(),
                        'level_id' => $education->getLevelId(),
                        'inst' => $education->getInstitute(),
                        'city' => $education->getCity(),
                        'faculty' => $education->getFaculty(),
                        'period' => $education->getStudyPeriod()
        
                    ]);

                }

                Http::response($res, 200);

            } else {

                $help_edu = HelperEducation::get($_POST['edu_level']);

                if(empty($help_edu->getId())){

                    Http::error('Некорректное поле [edu_level]');

                }
                        
                $education = new Education(
                        
                    null, 
                    $_SESSION['id'], 
                    $_POST['edu_level'],
                    $_POST['edu_inst'],
                    $_POST['edu_city'],
                    $_POST['edu_fac'],
                    $_POST['edu_period']

                );

                self::saveEdu($education);
                

                $res = [

                    'id' => $education->getId(),
                    'user_id' => $education->getUserId(),
                    'level' => $help_edu->getName(),
                    'inst' => $education->getInstitute(),
                    'city' => $education->getCity(),
                    'faculty' => $education->getFaculty(),
                    'period' => $education->getStudyPeriod()
    
                ];
    
                Http::response($res, 200);

            }

        }

        /**
         * 
         * @api {put} education Обновить
         * @apiName UpdateEducation
         * @apiGroup Resume_Education
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiParam  {String} record_id ID записи
         * @apiParam  {String} [edu_level] ID Уровень образования
         * @apiParam  {String} [edu_inst] Название учебного заведения
         * @apiParam  {String} [edu_city] Город
         * @apiParam  {String} [edu_fac] Факультет
         * @apiParam  {String} [edu_period] Период учебы
         * @apiParam  {String} [data] Вы можете отправить массив языков в json формате
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      "record_id" : "5",
         *      "edu_level" : "3",
         *      "edu_fac" : "Физико-математический",
         *      "edu_period" : "2005-2010"
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
         * @apiError EducationExists Язык <code>ID</code> уже добавлен
         * @apiError DataIsNotValid Некорректный объект <code>data</code>
         * @apiError PermissionDenied Вы не можете редактировать чужую запись
         * 
         * @apiError Invalid-LevelId Некорректное поле <code>edu_level</code>
         * @apiError Invalid-Institute Некорректное поле <code>edu_inst</code>
         * @apiError Invalid-City Некорректное поле <code>edu_city</code>
         * @apiError Invalid-Period Некорректное поле <code>edu_period</code>
         * @apiError Invalid-Faculty Некорректное поле <code>edu_fac</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Некорректное поле [edu_level]"
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

                    $edu = Education::get($obj->record_id);

                    if(empty($edu->getId())){

                        Http::error('Запись '.$obj->record_id.' не найдена');

                    }

                    if($edu->getUserId() != $_SESSION['id']){

                        Http::error('Вы не можете редактировать чужую запись', 403);
        
                    }

                    if(isset($obj->edu_level)){

                        $help_edu = HelperEducation::get($obj->edu_level);

                        if(empty($help_edu->getId())){
        
                            Http::error('Некорректное поле [edu_level]');
        
                        }

                        $edu->setLevelId($obj->edu_level);

                    }

                    if(isset($obj->edu_inst)){

                        $edu->setInstitute($obj->edu_inst);

                    }

                    if(isset($obj->edu_city)){

                        $edu->setCity($obj->edu_city);

                    }

                    if(isset($obj->edu_fac)){

                        $edu->setFaculty($obj->edu_fac);

                    }

                    if(isset($obj->edu_period)){

                        $edu->setStudyPeriod($obj->edu_period);

                    }

                    self::saveEdu($edu);

                    array_push($res, 
                    
                    [

                        'id' => $edu->getId(),
                        'user_id' => $edu->getUserId(),
                        'level_id' => $edu->getLevelId(),
                        'inst' => $edu->getInstitute(),
                        'city' => $edu->getCity(),
                        'faculty' => $edu->getFaculty(),
                        'period' => $edu->getStudyPeriod()
        
                    ]);

                }

                Http::response($res, 200);

            } else {

                if(!isset($GLOBALS['PUT']['record_id'])){

                    Http::error('Объект должен содержать поле [record_id]');

                }

                $edu = Education::get($GLOBALS['PUT']['record_id']);

                if(empty($edu->getId())){

                    Http::error('Запись '.$GLOBALS['PUT']['record_id'].' не найдена');

                }

                if($edu->getUserId() != $_SESSION['id']){

                    Http::error('Вы не можете редактировать чужую запись', 403);
    
                }

                if(isset($GLOBALS['PUT']['edu_level'])){

                    $help_edu = HelperEducation::get($GLOBALS['PUT']['edu_level']);

                    if(empty($help_edu->getId())){
    
                        Http::error('Некорректное поле [edu_level]');
    
                    }

                    $edu->setLevelId($GLOBALS['PUT']['edu_level']);

                }

                if(isset($GLOBALS['PUT']['edu_inst'])){

                    $edu->setInstitute($GLOBALS['PUT']['edu_inst']);

                }

                if(isset($GLOBALS['PUT']['edu_city'])){

                    $edu->setCity($GLOBALS['PUT']['edu_city']);

                }

                if(isset($GLOBALS['PUT']['edu_fac'])){

                    $edu->setFaculty($GLOBALS['PUT']['edu_fac']);

                }

                if(isset($GLOBALS['PUT']['edu_period'])){

                    $edu->setStudyPeriod($GLOBALS['PUT']['edu_period']);

                }

                self::saveEdu($edu);

                $res = [

                    'id' => $edu->getId(),
                    'user_id' => $edu->getUserId(),
                    'level' => $help_edu->getName(),
                    'inst' => $edu->getInstitute(),
                    'city' => $edu->getCity(),
                    'faculty' => $edu->getFaculty(),
                    'period' => $edu->getStudyPeriod()
    
                ];
    
                Http::response($res, 200);

            }

        }

        /**
         * 
         * @api {delete} education/:id Удалить
         * @apiName DeleteEducation
         * @apiGroup Resume_Education
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

            $edu = Education::get($router['id']);

            if(empty($edu->getId())){

                Http::error('Запись ' . $router['id'] . ' не найдена');

            }

            if($edu->getUserId() != $_SESSION['id']){

                Http::error('Вы не можете удалить чужую запись', 403);

            }

            $edu->delete();

            Http::success();

        }

        /**
         * 
         * @api {delete} education Удалить несколько
         * @apiName DeleteArrayEducation
         * @apiGroup Resume_Education
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiParam  {String} data Массив ID языков, которые надо удалить
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

            $data = explode(",", $GLOBALS['PUT']['data']);

            foreach ($data as $id) {

                $_id = trim($id);
                
                $edu = Education::get($_id);

                if(empty($edu->getId())){
    
                    Http::error('Запись ' . $_id . ' не найдена');
    
                }
    
                if($edu->getUserId() != $_SESSION['id']){
    
                    Http::error('Вы не можете удалить чужую запись', 403);
    
                }
    
                $edu->delete();

            }

            Http::success();

        }

        private function saveEdu($education){

            try{
                
                $education->save();

            } catch(Exception $e){
                
                if($e->getMessage() == 'userid'){

                    Http::error("Некорректное поле [userid]");

                } else if ($e->getMessage() == 'levelId') {

                    Http::error("Некорректное поле [edu_level]");

                } else if ($e->getMessage() == 'institute') {

                    Http::error("Некорректное поле [edu_inst]");

                } else if ($e->getMessage() == 'city') {

                    Http::error("Некорректное поле [edu_city]");

                } else if ($e->getMessage() == 'studyPeriod') {

                    Http::error("Некорректное поле [edu_period]");

                } else if ($e->getMessage() == 'faculty') {

                    Http::error("Некорректное поле [edu_fac]");

                }

            }

        }

    }