<?php

    Router::middleware(function(){

        parse_str(file_get_contents("php://input"), $GLOBALS['PUT']);

    });