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
         * @api {post} language Добавить языки к резюме
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
                    
                    $lang = Language::getByUserAndLangId($_SESSION['id'], $obj->lang_level);

                    if(!empty($lang->getId())){

                        Http::error('Язык ' . $obj->lang_level . ' уже добавлен');

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

                $lang = Language::getByUserAndLangId($_SESSION['id'], $_POST['lang_id']);

                if(!empty($lang->getId())){

                    Http::error('Язык ' . $_POST['lang_id'] . ' уже добавлен');

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

        public static function update(){

        }

        /**
         * 
         * @api {delete} language/:id Удаление языка из резюме
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
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 403 Bad Request
         *     {
         *       "error": "Вы должны быть авторизированы под учетноый записью пользователя"
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

            $lang = Language::getByUserAndLangId($_SESSION['id'], $router['id']);

            if(empty($lang->getId())){

                Http::error('Запись не найдена');

            }

            $lang->delete();

            Http::success();

        }

        public static function deleteArray(){

        }

        private function saveLang($language){

            try{
                
                $language->save();

            } catch(Exception $e){
                
                if($e->getMessage() == 'userid'){

                    Http::error("Некорректное поле [userid]");

                } else if ($e->getMessage() == 'langId') {

                    Http::error("Некорректное поле [langId]");

                } else if ($e->getMessage() == 'langLevel') {

                    Http::error("Некорректное поле [langLevel]");

                }

            }

        }

    }