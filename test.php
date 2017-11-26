<?php
    try{
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->set("test", "123");
        $redis->rPush("qwe", "qeqw");
    } catch (Exception $e) {
        echo $e->getMessage(); 
    }