<?php 

    final class VacancyApi {

        public static function init(){

            Router::post('api/vacancy/add', function(){

                self::add();

            });

            Router::delete('api/vacancy/delete/:id{number}', function($router){

                self::delete($router);

            });

            Router::put('api/vacancy/update/:id{number}', function($router){

                self::update($router);

            });

            Router::get('api/vacancy/:id{number}', function($router){

                self::get($router);

            });

        }

        private static function add(){

            echo "add vacancy";

        }

        private static function delete($router){

            echo "delete vacancy " . $router['id'];

        }
        
        private static function update($router){

            echo "update vacancy " . $router['id'];

        }

        private static function get($router){

            echo "get vacancy " . $router['id'];

        }

    }