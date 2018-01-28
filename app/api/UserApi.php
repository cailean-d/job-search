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

            echo "user register";

        }

        private static function login(){

            echo "user login";

        }

        private static function logout(){

            echo "user logout";

        }

    }