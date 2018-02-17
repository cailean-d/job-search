<?php

    /**
     * @apiDefine auth Вы должны быть авторизированы под учетноый записью пользователя
    */

     final class ResumeApi{

        public static function init(){

            return array(

                [
                    'method' => 'post',
                    'url' => 'resume',
                    'handler' => 'add'
                ],

                [
                    'method' => 'put',
                    'url' => 'resume',
                    'handler' => 'update'
                ],

                [
                    'method' => 'delete',
                    'url' => 'resume',
                    'handler' => 'delete'
                ],

                [
                    'method' => 'get',
                    'url' => 'resume/:id{number}',
                    'handler' => 'get'
                ]

            );

        }

        public static function add(){
            
        }

        public static function update(){

        }

        public static function delete(){

        }

        public static function get($router){

        }

     }