<?php 

    final class RootApi{

        public static function init(){

            Router::get('api', function(){

                echo "Job Search API";

            });

        }

    }