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
         * @apiParam  {String} email Почта
         * @apiParam  {String} password Пароль
         * @apiParam  {String} type="0" Тип учетной записи
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      firstname : Вася,
         *      lastname : Петренко,
         *      email : example@test.com,
         *      password : 123456,
         *      type : 0
         * }
         * 
         * @apiSuccess (200) {String} id ID пользователя
         * @apiSuccess (200) {String} firstname Имя пользователя
         * @apiSuccess (200) {String} lastname Фамилия пользователя
         * @apiSuccess (200) {String} email Email пользователя
         * @apiSuccess (200) {String} type Тип учетной записи
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      id : 1
         *      firstname : Вася
         *      lastname : Петренко
         *      email : example@test.com
         *      type : 0
         *  }
         * 
         * @apiError EmailExists Email уже существует
         * 
         * @apiError Empty-Firstname Поле <code>firstname</code> не должно быть пустым
         * @apiError Empty-Lastname Поле <code>lastname</code> не должно быть пустым
         * @apiError Empty-Email Поле <code>email</code> не должно быть пустым
         * @apiError Empty-Password Поле <code>password</code> не должно быть пустым
         * @apiError Empty-Type Поле <code>type</code> не должно быть пустым
         * 
         * @apiError Invalid-Firstname Некорректное поле <code>firstname</code>
         * @apiError Invalid-Lastname Некорректное поле <code>lastname</code>
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

                Application::error("Email уже существует!");

            } 

            $newUser = new User(

                '',
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['password'],
                $_POST['type']

            );

            $newUser->encodePassword();

            try{
                
                $newUser->save();

            } catch(Exception $e){
                
                if($e->getMessage() == 'firstname'){

                    Application::error("Некорректное поле [firstname]");

                } else if ($e->getMessage() == 'lastname') {

                    Application::error("Некорректное поле [lastname]");

                } else if ($e->getMessage() == 'email') {

                    Application::error("Некорректное поле [email]");

                } else if ($e->getMessage() == 'password') {

                    Application::error("Некорректное поле [password]");

                } else if ($e->getMessage() == 'type') {

                    Application::error("Некорректное поле [type]");

                }

            }

            self::setSessionData($newUser);


            $res = [

                'id' => $newUser->getId(),
                'firstname' => $newUser->getFirstname(),
                'lastname' => $newUser->getLastname(),
                'email' => $newUser->getEmail(),
                'type' => $newUser->getType()

            ];

            Application::response($res, 200);

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
         * @apiSuccess (200) {String} email Email пользователя
         * @apiSuccess (200) {String} type Тип учетной записи
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      id : 1
         *      firstname : Вася
         *      lastname : Петренко
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
                        'email' => $user->getEmail(),
                        'type' => $user->getType()
    
                    ];

                    Application::response($res, 200);

                } else {

                    Application::error('Неверный пароль');

                }

            } else {

                    Application::error('Логин не найден');

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
         *   HTTP/1.1 400 Bad Request
         *   {
         *     "error": "Вы не авторизированы"
         *   }
         *
         */

        public static function logout(){

            if(!isset($_SESSION['id'])){

                Application::error('Вы не авторизированы');

            }

            session_destroy();

            Application::response(['success' => true], 200);

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
         * @apiSuccess (200) {String} email Email пользователя
         * @apiSuccess (200) {String} type Тип учетной записи
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      id : 1
         *      firstname : Вася
         *      lastname : Петренко
         *      email : example@test.com
         *      type : 0
         *  }
         * 
         * @apiError UserNotFound Пользовтель <code>id</code> не найден.
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Пользователь не найден"
         *     }
         * 
         */

        public static function getUser($router){

            $id = $router['id'];

            $user = User::get($id);

            if (empty($user->getId())) {

                Application::error('Пользователь не найден');

            } else {

                $res = [

                    'id' => $user->getId(),
                    'firstname' => $user->getFirstname(),
                    'lastname' => $user->getLastname(),
                    'email' => $user->getEmail(),
                    'type' => $user->getType()

                ];

                Application::response($res, 200);

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
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Вы не авторизированы"
         *     }
         * 
         */

        public static function deleteUser(){

            if(!isset($_SESSION['id'])){

                Application::error('Вы не авторизированы');

            }

            $user = new User($_SESSION['id']);
            $user->delete();
            session_destroy();

            Application::response(['success' => true], 200);

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
         * @apiParam  {String} [email] Почта
         * @apiParam  {String} [password] Пароль
         * @apiParam  {String} [type="0"] Тип учетной записи
         * 
         * @apiSuccess (200) {String} id ID пользователя
         * @apiSuccess (200) {String} firstname Имя пользователя
         * @apiSuccess (200) {String} lastname Фамилия пользователя
         * @apiSuccess (200) {String} email Email пользователя
         * @apiSuccess (200) {String} type Тип учетной записи
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      firstname : Вася
         *      lastname : Петренко
         *      email : example@test.com
         *      password : 123456
         *      type : 0
         *  }
         * 
         * @apiError Auth Вы не авторизированы
         * 
         * @apiError Empty-Firstname Поле <code>firstname</code> не должно быть пустым
         * @apiError Empty-Lastname Поле <code>lastname</code> не должно быть пустым
         * @apiError Empty-Email Поле <code>email</code> не должно быть пустым
         * @apiError Empty-Password Поле <code>password</code> не должно быть пустым
         * @apiError Empty-Type Поле <code>type</code> не должно быть пустым
         * 
         * @apiError Invalid-Firstname Некорректное поле <code>firstname</code>
         * @apiError Invalid-Lastname Некорректное поле <code>lastname</code>
         * @apiError Invalid-Email Некорректное поле <code>email</code>
         * @apiError Invalid-Type Некорректное поле <code>type</code>
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *   HTTP/1.1 400 Bad Request
         *   {
         *     "error": "Вы не авторизированы"
         *   }
         * 
         */

        public static function updateUser(){

            parse_str(file_get_contents("php://input"), $GLOBALS['PUT']);

            if(!isset($_SESSION['id'])){

                Application::error('Вы не авторизированы');

            }

            $user = User::get($_SESSION['id']);

            if(isset($GLOBALS['PUT']['firstname'])){

                $user->setFirstname($GLOBALS['PUT']['firstname']);

            }

            if(isset($GLOBALS['PUT']['lastname'])){

                $user->setLastname($GLOBALS['PUT']['lastname']);

            }

            if(isset($GLOBALS['PUT']['email'])){

                $user->setEmail($GLOBALS['PUT']['email']);

            }

            if(isset($GLOBALS['PUT']['password'])){

                $user->setPassword($GLOBALS['PUT']['password']);
                $user->encodePassword();

            }

            if(isset($GLOBALS['PUT']['type'])){

                $user->setType($GLOBALS['PUT']['type']);

            }

            try{
                
                $user->save();

            } catch(Exception $e){
                
                if($e->getMessage() == 'firstname'){

                    Application::error('Некорректное поле [firstname]');

                } else if ($e->getMessage() == 'lastname') {

                    Application::error('Некорректное поле [lastname]');

                } else if ($e->getMessage() == 'email') {

                    Application::error('Некорректное поле [email]');

                } else if ($e->getMessage() == 'password') {

                    Application::error('Некорректное поле [password]');

                } else if ($e->getMessage() == 'type') {

                    Application::error('Некорректное поле [type]');

                }

            }

            self::setSessionData($user);

            $res = [

                'id' => $user->getId(),
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
                'email' => $user->getEmail(),
                'type' => $user->getType()

            ];

            Application::response($res, 200);

        }

        private static function setSessionData(User $user){

            $_SESSION['authorized'] = true;
            $_SESSION['id'] = $user->getId();
            $_SESSION['firstname'] = $user->getFirstname();
            $_SESSION['lastname'] = $user->getLastname();
            $_SESSION['type'] = $user->getType();

        }

    }