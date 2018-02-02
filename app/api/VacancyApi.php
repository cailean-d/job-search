<?php 

    final class VacancyApi {

        public static function init(){

            return array(

                [
                    'method' => 'post',
                    'url' => 'vacancy/add',
                    'handler' => 'add'
                ],

                [
                    'method' => 'delete',
                    'url' => 'vacancy/delete/:id{number}',
                    'handler' => 'delete'
                ],

                [
                    'method' => 'put',
                    'url' => 'vacancy/update/:id{number}',
                    'handler' => 'update'
                ],

                [
                    'method' => 'get',
                    'url' => 'vacancy/:id{number}',
                    'handler' => 'get'
                ]

            );

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