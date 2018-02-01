<?php

    /**
     * @apiDefine auth Необходима авторизация
     * 
     */

    final class UserApi{

        public static function init(){

            Router::post('api/user/register', function(){

                self::register();

            });

            Router::post('api/user/login', function(){

                self::login();

            });

            Router::post('api/user/logout', function(){

                self::logout();

            });

            Router::get('api/user/:id{number}', function($router){

                self::getUser($router['id']);

            });

            Router::delete('api/user', function(){

                self::deleteUser();

            });

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
         * @apiSuccess (200) {String} id ID нового пользователя
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
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      id : 1
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

        private static function register(){

            $email = htmlspecialchars(trim($_POST['email']));

            $user = User::getByEmail($email);

            if(!empty($email) && $email == $user->getEmail()) { 
                
                http_response_code(400);
                exit("Email уже существует!");

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

                    http_response_code(400);
                    echo "Некорректное поле <firstname>";

                } else if ($e->getMessage() == 'lastname') {

                    http_response_code(400);
                    echo "Некорректное поле <lastname>";

                } else if ($e->getMessage() == 'email') {

                    http_response_code(400);
                    echo "Некорректное поле <email>";

                } else if ($e->getMessage() == 'password') {

                    http_response_code(400);
                    echo "Некорректное поле <password>";

                } else if ($e->getMessage() == 'type') {

                    http_response_code(400);
                    echo "Некорректное поле <type>";

                }

            }

            self::setSessionData($newUser);

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
         * @apiSuccess (200) {String} success Авторизация прошла успешно
         * 
         * @apiParamExample  {json} Request-Example:
         * {
         *      email : example@test.com,
         *      password : 123456
         * }
         * 
         * @apiSuccessExample {json} Success-Response:
         *  {
         *      success : true
         *  }
         * 
         * @apiError EmailExists Email не существует
         * @apiError Invalid-Password Неверный пароль
         *
         * @apiErrorExample {json} Error-Response:
         * 
         *     HTTP/1.1 400 Bad Request
         *     {
         *       "error": "Неверный пароль"
         *     }
         * 
         */

        private static function login(){

            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));

            $user = User::getByEmail($email);

            if (!empty($user->getId())) {

                if(password_verify($password, $user->getPassword())){

                    self::setSessionData($user);
                    echo json_encode(['success' => true]);
                    exit();

                } else {

                    http_response_code(400);
                    echo json_encode(['error' => "Неверный пароль"]);
                    exit();

                }

            } else {

                    http_response_code(400);
                    echo json_encode(['error' => "Логин не найден"]);
                    exit();

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

        private static function logout(){

            if(!isset($_SESSION['id'])){

                http_response_code(400);
                echo json_encode(['error' => "Вы не авторизированы"]);
                exit();

            }

            session_destroy();
            echo json_encode(['success' => true]);
            exit();

        }

        /**
         * 
         * @api {get} user/:id Данные пользователя
         * @apiName GetUser
         * @apiGroup User
         * @apiVersion  1.0.0
         * 
         * @apiParam  {String} id ID пользователя
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

        private static function getUser($id){

            $user = User::get($id);

            if (empty($user->getId())) {

                http_response_code(400);
                echo json_encode(['error' => "Пользователь не найден"]);
                exit();

            } else {

                echo json_encode([

                    'id' => $user->getId(),
                    'firstname' => $user->getFirstname(),
                    'lastname' => $user->getLastname(),
                    'email' => $user->getEmail(),
                    'type' => $user->getType()

                    ]);

                exit();

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

        private static function deleteUser(){

            if(!isset($_SESSION['id'])){

                http_response_code(400);
                echo json_encode(['error' => "Вы не авторизированы"]);
                exit();

            }

            $user = new User($_SESSION['id']);
            $user->delete();
            session_destroy();

            echo json_encode(['success' => true]);
            exit();

        }

        private static function setSessionData(User $user){

            $_SESSION['authorized'] = true;
            $_SESSION['id'] = $user->getId();
            $_SESSION['firstname'] = $user->getFirstname();
            $_SESSION['lastname'] = $user->getLastname();
            $_SESSION['type'] = $user->getType();

        }

    }