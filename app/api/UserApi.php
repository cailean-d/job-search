<?php

    /**
     * @apiDefine auth Необходима авторизация
     * 
     */

    final class UserApi{

        public static function init(){

            return array(

                [
                    'method' => 'post',
                    'url' => 'user/register',
                    'handler' => 'register'
                ],

                [
                    'method' => 'post',
                    'url' => 'user/login',
                    'handler' => 'login'
                ],

                [
                    'method' => 'post',
                    'url' => 'user/logout',
                    'handler' => 'logout'
                ],

                [
                    'method' => 'get',
                    'url' => 'user/:id{number}',
                    'handler' => 'getUser'
                ],

                [
                    'method' => 'delete',
                    'url' => 'user',
                    'handler' => 'deleteUser'
                ],

                [
                    'method' => 'put',
                    'url' => 'user',
                    'handler' => 'updateUser'
                ],

                [
                    'method' => 'post',
                    'url' => 'user/avatar',
                    'handler' => 'setAvatar'
                ],

                [
                    'method' => 'delete',
                    'url' => 'user/avatar',
                    'handler' => 'deleteAvatar'
                ]

            );

        }

        /**
         * 
         * @api {post} user/register Регистрация
         * @apiName UserRegister
         * @apiGroup User
         * @apiVersion  1.0.0
         * 
         * @apiParam  {String} firstname Имя
         * @apiParam  {String} lastname Фамилия
         * @apiParam  {String} gender Пол
         * @apiParam  {String} email Почта
         * @apiParam  {String} password Пароль
         * @apiParam  {String} type="0" Тип учетной записи
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      firstname : Вася,
         *      lastname : Петренко,
         *      gender : Мужской,
         *      email : example@test.com,
         *      password : 123456,
         *      type : 0
         * }
         * 
         * @apiSuccess (200) {String} id ID пользователя
         * @apiSuccess (200) {String} firstname Имя пользователя
         * @apiSuccess (200) {String} lastname Фамилия пользователя
         * @apiSuccess (200) {String} gender Пол
         * @apiSuccess (200) {String} email Email пользователя
         * @apiSuccess (200) {String} type Тип учетной записи
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      id : 1
         *      firstname : Вася
         *      lastname : Петренко
         *      gender : Мужской
         *      email : example@test.com
         *      type : 0
         *  }
         * 
         * @apiError EmailExists Email уже существует
         * 
         * @apiError Empty-Firstname Поле <code>firstname</code> не должно быть пустым
         * @apiError Empty-Lastname Поле <code>lastname</code> не должно быть пустым
         * @apiError Empty-Gender Поле <code>gender</code> не должно быть пустым
         * @apiError Empty-Email Поле <code>email</code> не должно быть пустым
         * @apiError Empty-Password Поле <code>password</code> не должно быть пустым
         * @apiError Empty-Type Поле <code>type</code> не должно быть пустым
         * 
         * @apiError Invalid-Firstname Некорректное поле <code>firstname</code>
         * @apiError Invalid-Lastname Некорректное поле <code>lastname</code>
         * @apiError Invalid-Gender Некорректное поле <code>gender</code>
         * @apiError Invalid-Email Некорректное поле <code>email</code>
         * @apiError Invalid-Type Некорректное поле <code>type</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Некорректное поле <firstname>"
         *     }
         * 
         */

        public static function register(){

            $email = htmlspecialchars(trim($_POST['email']));

            $user = User::getByEmail($email);

            if(!empty($email) && $email == $user->getEmail()) { 

                Http::error("Email уже существует!");

            } 

            $newUser = new User(

                null,
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['gender'],
                $_POST['email'],
                $_POST['password'],
                $_POST['type']

            );

            $newUser->encodePassword();

            try{
                
                $newUser->save();

            } catch(Exception $e){
                
                if($e->getMessage() == 'firstname'){

                    Http::error("Некорректное поле [firstname]");

                } else if ($e->getMessage() == 'lastname') {

                    Http::error("Некорректное поле [lastname]");

                } else if ($e->getMessage() == 'gender') {

                    Http::error("Некорректное поле [gender]");

                } else if ($e->getMessage() == 'email') {

                    Http::error("Некорректное поле [email]");

                } else if ($e->getMessage() == 'password') {

                    Http::error("Некорректное поле [password]");

                } else if ($e->getMessage() == 'type') {

                    Http::error("Некорректное поле [type]");

                }

            }

            self::setSessionData($newUser);


            $res = [

                'id' => $newUser->getId(),
                'firstname' => $newUser->getFirstname(),
                'lastname' => $newUser->getLastname(),
                'gender' => $newUser->getGender(),
                'email' => $newUser->getEmail(),
                'type' => $newUser->getType()

            ];

            Http::response($res, 200);

        }

        /**
         * 
         * @api {post} user/login Авторизация
         * @apiName UserLogin
         * @apiGroup User
         * @apiVersion  1.0.0
         * 
         * @apiParam  {String} email Почта
         * @apiParam  {String} password Пароль
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      email : example@test.com,
         *      password : 123456
         * }
         * 
         * @apiSuccess (200) {String} id ID пользователя
         * @apiSuccess (200) {String} firstname Имя пользователя
         * @apiSuccess (200) {String} lastname Фамилия пользователя
         * @apiSuccess (200) {String} gender Пол
         * @apiSuccess (200) {String} email Email пользователя
         * @apiSuccess (200) {String} type Тип учетной записи
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      id : 1
         *      firstname : Вася
         *      lastname : Петренко
         *      gender : Мужской
         *      email : example@test.com
         *      type : 0
         *  }
         * 
         * @apiError EmailExists Email не существует
         * @apiError Invalid-Password Неверный пароль
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *   HTTP/1.1 400 Bad Request
         *   {
         *     "error": "Неверный пароль"
         *   }
         * 
         */

        public static function login(){

            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));

            $user = User::getByEmail($email);

            if (!empty($user->getId())) {

                if(password_verify($password, $user->getPassword())){

                    self::setSessionData($user);

                    $res = [

                        'id' => $user->getId(),
                        'firstname' => $user->getFirstname(),
                        'lastname' => $user->getLastname(),
                        'gender' => $user->getGender(),
                        'email' => $user->getEmail(),
                        'type' => $user->getType()
    
                    ];

                    Http::response($res, 200);

                } else {

                    Http::error('Неверный пароль');

                }

            } else {

                Http::error('Логин не найден', 404);

            }

        }

        /**
         * 
         * @api {post} user/logout Выход
         * @apiName UserLogout
         * @apiGroup User
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiSuccess (200) {String} success Сессия успешно завершена
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      success : true
         *  }
         * 
         *   
         * @apiError Auth Вы не авторизированы
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *   HTTP/1.1 403 Forbidden
         *   {
         *     "error": "Вы не авторизированы"
         *   }
         *
         */

        public static function logout(){

            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы', 403);

            }

            session_destroy();

            Http::success();

        }

        /**
         * 
         * @api {get} user/:id Данные пользователя
         * @apiName GetUser
         * @apiGroup User
         * @apiVersion  1.0.0
         * 
         * @apiSuccess (200) {String} id ID пользователя
         * @apiSuccess (200) {String} firstname Имя пользователя
         * @apiSuccess (200) {String} lastname Фамилия пользователя
         * @apiSuccess (200) {String} gender Пол
         * @apiSuccess (200) {String} email Email пользователя
         * @apiSuccess (200) {String} type Тип учетной записи
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      id : 1
         *      firstname : Вася
         *      lastname : Петренко
         *      gender : Мужской
         *      email : example@test.com
         *      type : 0
         *  }
         * 
         * @apiError UserNotFound Пользовтель <code>id</code> не найден.
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 404 Not Found
         *     {
         *       "error": "Пользователь не найден"
         *     }
         * 
         */

        public static function getUser($router){

            $id = $router['id'];

            $user = User::get($id);

            if (empty($user->getId())) {

                Http::error('Пользователь не найден', 404);

            } else {

                $res = [

                    'id' => $user->getId(),
                    'firstname' => $user->getFirstname(),
                    'lastname' => $user->getLastname(),
                    'gender' => $user->getGender(),
                    'email' => $user->getEmail(),
                    'type' => $user->getType()

                ];

                Http::response($res, 200);

            }

        }

        /**
         * 
         * @api {delete} user Удаление учетной записи
         * @apiName UserDelete
         * @apiGroup User
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
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 403 Forbidden
         *     {
         *       "error": "Вы не авторизированы"
         *     }
         * 
         */

        public static function deleteUser(){

            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы', 403);

            }

            $user = new User($_SESSION['id']);
            $user->delete();
            session_destroy();

            Http::success();

        }

        /**
         * 
         * @api {put} user Изменить данные
         * @apiName UserUpdate
         * @apiGroup User
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * 
         * @apiParam  {String} [firstname] Имя
         * @apiParam  {String} [lastname] Фамилия
         * @apiParam  {String} [gender] Пол
         * @apiParam  {String} [email] Почта
         * @apiParam  {String} [old_password] Старый пароль. Необходим для смены пароля
         * @apiParam  {String} [password] Новый пароль
         * 
         * @apiSuccess (200) {String} id ID пользователя
         * @apiSuccess (200) {String} firstname Имя пользователя
         * @apiSuccess (200) {String} lastname Фамилия пользователя
         * @apiSuccess (200) {String} gender Пол
         * @apiSuccess (200) {String} email Email пользователя
         * @apiSuccess (200) {String} old_password Старый пароль
         * @apiSuccess (200) {String} password Новый пароль
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      firstname : Вася
         *      lastname : Петренко
         *      gender : Мужской
         *      email : example@test.com
         *      old_password : 123456
         *      password : 1234567
         *  }
         * 
         * @apiError Auth Вы не авторизированы
         * 
         * @apiError Empty-Firstname Поле <code>firstname</code> не должно быть пустым
         * @apiError Empty-Lastname Поле <code>lastname</code> не должно быть пустым
         * @apiError Empty-Gender Поле <code>gender</code> не должно быть пустым
         * @apiError Empty-Email Поле <code>email</code> не должно быть пустым
         * @apiError Empty-Password Поле <code>password</code> не должно быть пустым
         * 
         * @apiError Invalid-Firstname Некорректное поле <code>firstname</code>
         * @apiError Invalid-Lastname Некорректное поле <code>lastname</code>
         * @apiError Invalid-Gender Некорректное поле <code>gender</code>
         * @apiError Invalid-Email Некорректное поле <code>email</code>
         * @apiError Invalid-OldPassword Некорректное поле <code>old_password</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *   HTTP/1.1 403 Forbidden
         *   {
         *     "error": "Вы не авторизированы"
         *   }
         * 
         */

        public static function updateUser(){

            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы', 403);

            }

            $user = User::get($_SESSION['id']);

            if(isset($GLOBALS['PUT']['firstname'])){

                $user->setFirstname($GLOBALS['PUT']['firstname']);

            }

            if(isset($GLOBALS['PUT']['lastname'])){

                $user->setLastname($GLOBALS['PUT']['lastname']);

            }

            if(isset($GLOBALS['PUT']['gender'])){

                $user->setGender($GLOBALS['PUT']['gender']);

            }

            if(isset($GLOBALS['PUT']['email'])){

                $user->setEmail($GLOBALS['PUT']['email']);

            }

            if(isset($GLOBALS['PUT']['password'])){

                if(!isset($GLOBALS['PUT']['old_password'])){

                    Http::error('Некорректное поле [old_password]');
    
                }

                if(password_verify($GLOBALS['PUT']['old_password'], $user->getPassword())){

                    $user->setPassword($GLOBALS['PUT']['password']);
                    $user->encodePassword();
    
                } else {

                    Http::error('Неверный пароль [old_password]');

                }
               
            }

            try{
                
                $user->save();

            } catch(Exception $e){
                
                if($e->getMessage() == 'firstname'){

                    Http::error('Некорректное поле [firstname]');

                } else if ($e->getMessage() == 'lastname') {

                    Http::error('Некорректное поле [lastname]');

                } else if ($e->getMessage() == 'gender') {

                    Http::error('Некорректное поле [gender]');

                } else if ($e->getMessage() == 'email') {

                    Http::error('Некорректное поле [email]');

                } else if ($e->getMessage() == 'password') {

                    Http::error('Некорректное поле [password]');

                }

            }

            self::setSessionData($user);

            $res = [

                'id' => $user->getId(),
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
                'gender' => $user->getGender(),
                'email' => $user->getEmail(),
                'type' => $user->getType()

            ];

            Http::response($res, 200);

        }

        /**
         * 
         * @api {post} user/avatar Изменить аватар
         * @apiName UserAvatar
         * @apiGroup User
         * @apiVersion  1.0.0
         * 
         * @apiPermission auth
         * @apiSampleRequest off
         * 
         * @apiParam  {Blob} avatar Файл, новый аватар пользователя
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      avatar : example.jpeg
         * }
         * 

         * @apiSuccess (200) {String} source Путь к файлу
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      source : public/images/avatar/5a2fc338ba3e6.jpg
         *  }
         * 
         * @apiError Auth Вы не авторизированы
         * 
         * @apiError FileDoesNotExist Файл не был загружен
         * @apiError FileMaxSize Файл не должен весить более 3МБ
         * @apiError FileUploadError Ошибка загрузки файла
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Файл не должен весить более 3МБ"
         *     }
         * 
         */

        public static function setAvatar(){

            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы', 403);

            }

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


            $res = [

                'source' => $avatar->getSource(),

            ];

            Http::response($res, 200);

        }

        /**
         * 
         * @api {delete} user/avatar Удалить аватар
         * @apiName DeleteAvatar
         * @apiGroup User
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
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 403 Forbidden
         *     {
         *       "error": "Вы не авторизированы"
         *     }
         * 
         */

        public static function deleteAvatar(){

            if(!isset($_SESSION['id'])){

                Http::error('Вы не авторизированы', 403);

            }

            $avatar = new Avatar(null, $_SESSION['id']);
            $avatar->delete();

            Http::success();

        }

        private static function setSessionData(User $user){

            $_SESSION['authorized'] = true;
            $_SESSION['id'] = $user->getId();

        }

    }