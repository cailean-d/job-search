<?php

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

        }

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

        private static function login(){

            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));

            $user = User::getByEmail($email);

            if (!empty($user->getId())) {

                if(password_verify($password, $user->getPassword())){

                    self::setSessionData($user);

                } else {

                    http_response_code(400);
                    exit("Неверный пароль");

                }

            } else {

                    http_response_code(400);
                    exit("Логин не найден");

            }

        }

        private static function logout(){

            session_destroy();

        }

        private static function setSessionData(User $user){

            $_SESSION['authorized'] = true;
            $_SESSION['id'] = $user->getId();
            $_SESSION['firstname'] = $user->getFirstname();
            $_SESSION['lastname'] = $user->getLastname();
            $_SESSION['type'] = $user->getType();

        }

    }