<?php

    /**
     * @apiDefine auth Вы должны быть авторизированы под учетноый записью пользователя
     */

    final class LanguageApi{

        public static function init(){

            return array(

                [
                    'method' => 'post',
                    'url' => 'language',
                    'handler' => 'add'
                ],

                [
                    'method' => 'put',
                    'url' => 'language',
                    'handler' => 'update'
                ],

                [
                    'method' => 'delete',
                    'url' => 'language/:id{number}',
                    'handler' => 'delete'
                ],

                [
                    'method' => 'delete',
                    'url' => 'language',
                    'handler' => 'deleteArray'
                ]

            );

        }

        /**
         * 
         * @api {post} language Добавить
         * @apiName AddLanguage
         * @apiGroup Resume_Language
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiParam  {String} lang_id ID языка
         * @apiParam  {String} lang_level Уровень владения языком
         * @apiParam  {String} [data] Вы можете отправить массив языков в json формате
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      "lang_id" : "3",
         *      "lang_level" : "Не владею"
         * }
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} lang_id ID языка
         * @apiSuccess (200) {String} lang_level Уровень владения языком
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "lang_id" : "3",
         *      "lang_level" : "Не владею"
         *  }
         * 
         * @apiError Auth Вы не авторизированы
         * @apiError UserAuth Вы должны быть авторизированы под учетноый записью пользователя
         * @apiError LanguageExists Язык <code>ID</code> уже добавлен
         * @apiError DataIsNotValid Некорректный объект <code>data</code>
         * @apiError DataFieldIsNotValid Объект должен содержать поле <code>lang_id</code>
         * @apiError DataFieldIsNotValid2 Объект должен содержать поле <code>lang_level</code>
         * 
         * @apiError Invalid-LangId Некорректное поле <code>lang_id</code>
         * @apiError Invalid-LangLevel Некорректное поле <code>lang_level</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Некорректное поле [lang_level]"
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
        
                    if(!isset($obj->lang_id)){

                        Http::error('Объект должен содержать поле [lang_id]');

                    }

                    if(!isset($obj->lang_level)){

                        Http::error('Объект должен содержать поле [lang_level]');

                    }

                    $help_lang = HelperLanguage::get($obj->lang_id);

                    if(empty($help_lang->getId())){

                        Http::error('Язык ' . $obj->lang_id . ' не существует');

                    }

                    $lang = Language::getByUserAndLangId($_SESSION['id'], $obj->lang_id);

                    if(!empty($lang->getId())){

                        Http::error('Язык [' . $help_lang->getName() . '] уже добавлен');

                    }
        
                    $language = new Language(null, $_SESSION['id'], $obj->lang_id, $obj->lang_level);

                    self::saveLang($language);

                    array_push($res, 
                    
                    [

                        'id' => $language->getId(),
                        'user_id' => $language->getUserid(),
                        'lang_id' => $language->getLangId(),
                        'lang_level' => $language->getLangLevel()
        
                    ]);

                }

                Http::response($res, 200);

            } else {

                $help_lang = HelperLanguage::get($_POST['lang_id']);

                if(empty($help_lang->getId())){

                    Http::error('Язык ' . $_POST['lang_id'] . ' не существует');

                }

                $lang = Language::getByUserAndLangId($_SESSION['id'], $_POST['lang_id']);

                if(!empty($lang->getId())){

                    Http::error('Язык [' . $help_lang->getName() . '] уже добавлен');

                }

                $language = new Language(null, $_SESSION['id'], $_POST['lang_id'], $_POST['lang_level']);

                self::saveLang($language);

                $res = [

                    'id' => $language->getId(),
                    'user_id' => $language->getUserid(),
                    'lang_id' => $language->getLangId(),
                    'lang_level' => $language->getLangLevel()
    
                ];
    
                Http::response($res, 200);

            }

        }

        /**
         * 
         * @api {put} language Обновить
         * @apiName UpdateLanguage
         * @apiGroup Resume_Language
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiParam  {String} record_id ID записи
         * @apiParam  {String} lang_level Уровень владения языком
         * @apiParam  {String} [data] Вы можете отправить массив языков в json формате
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      "record_id" : "3",
         *      "lang_level" : "Не владею"
         * }
         * 
         * @apiSuccess (200) {String} id ID записи
         * @apiSuccess (200) {String} lang_id ID языка
         * @apiSuccess (200) {String} lang_level Уровень владения языком
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      "id" : "1"
         *      "lang_id" : "3",
         *      "lang_level" : "Не владею"
         *  }
         * 
         * @apiError Auth Вы не авторизированы
         * @apiError UserAuth Вы должны быть авторизированы под учетноый записью пользователя
         * @apiError DataIsNotValid Некорректный объект <code>data</code>
         * @apiError DataFieldIsNotValid Объект должен содержать поле <code>record_id</code>
         * @apiError DataFieldIsNotValid2 Объект должен содержать поле <code>lang_level</code>
         * @apiError PermissionDenied Вы не можете редактировать чужую запись
         * 
         * @apiError Invalid-LangLevel Некорректное поле <code>lang_level</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Некорректное поле [lang_level]"
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

            if(isset($GLOBALS['PUT']['data'])){


                if(!Model::isJson($data)){

                    Http::error('Некорректный объект [data]');
    
                }

                $data = json_decode($GLOBALS['PUT']['data']);

                $res = array();
        
                foreach ($data as $obj) {
                    
                    if(!isset($obj->record_id)){

                        Http::error('Объект должен содержать поле [record_id]');

                    }

                    $lang = Language::get($obj->record_id);

                    if(empty($lang->getId())){

                        Http::error('Запись '.$obj->record_id.' не найдена');

                    }
                    
                    if($lang->getUserid() != $_SESSION['id']){

                        Http::error('Вы не можете редактировать чужую запись', 403);
        
                    }

                    if(!isset($obj->lang_level)){

                        Http::error('Объект должен содержать поле [lang_level]');

                    }

                    $lang->setLangLevel($obj->lang_level);

                    self::saveLang($lang);

                    array_push($res, 
                    
                    [

                        'id' => $lang->getId(),
                        'user_id' => $lang->getUserid(),
                        'lang_id' => $lang->getLangId(),
                        'lang_level' => $lang->getLangLevel()
        
                    ]);

                }

                Http::response($res, 200);

            } else {

                if(!isset($GLOBALS['PUT']['record_id'])){

                    Http::error('Объект должен содержать поле [record_id]');

                }

                $lang = Language::get($GLOBALS['PUT']['record_id']);

                if(empty($lang->getId())){

                    Http::error('Запись '.$GLOBALS['PUT']['record_id'].' не найдена');

                }
                
                if($lang->getUserid() != $_SESSION['id']){

                    Http::error('Вы не можете редактировать чужую запись', 403);
    
                }

                if(!isset($GLOBALS['PUT']['lang_level'])){

                    Http::error('Объект должен содержать поле [lang_level]');

                }

                $lang->setLangLevel($GLOBALS['PUT']['lang_level']);

                self::saveLang($lang);

                $res = [

                    'id' => $lang->getId(),
                    'user_id' => $lang->getUserid(),
                    'lang_id' => $lang->getLangId(),
                    'lang_level' => $lang->getLangLevel()
    
                ];
    
                Http::response($res, 200);

            }

        }

        /**
         * 
         * @api {delete} language/:id Удалить
         * @apiName DeleteLanguage
         * @apiGroup Resume_Language
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

            $lang = Language::get($router['id']);

            if(empty($lang->getId())){

                Http::error('Запись ' . $router['id'] . ' не найдена');

            }

            if($lang->getUserid() != $_SESSION['id']){

                Http::error('Вы не можете удалить чужую запись', 403);

            }

            $lang->delete();

            Http::success();

        }

        /**
         * 
         * @api {delete} language Удалить несколько
         * @apiName DeleteArrayLanguage
         * @apiGroup Resume_Language
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

                $lang = Language::get($_id);

                if(empty($lang->getId())){

                    Http::error('Запись ' . $_id . ' не найдена');

                }

                if($lang->getUserid() != $_SESSION['id']){

                    Http::error('Вы не можете удалить чужую запись', 403);

                }

                $lang->delete();

            }

            Http::success();

        }

        private function saveLang($language){

            try{
                
                $language->save();

            } catch(Exception $e){
                
                if($e->getMessage() == 'userid'){

                    Http::error("Некорректное поле [userid]");

                } else if ($e->getMessage() == 'langId') {

                    Http::error("Некорректное поле [lang_id]");

                } else if ($e->getMessage() == 'langLevel') {

                    Http::error("Некорректное поле [lang_level]");

                }

            }

        }

    }