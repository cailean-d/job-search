<?php 

    class Database {
        
        protected static $instance = null;

        private static $type;
        private static $host;
        private static $db_name;
        private static $user;
        private static $password;
        private static $options;

        public function __construct() {}
        public function __clone() {}
        public function __wakeup() {}

        public static function instance() {

            self::setProps();

            if (self::$instance === null) {

                self::$instance = new PDO(
                    self::$type.':host='.
                    self::$host.';dbname='.
                    self::$db_name.';charset=utf8', 
                    self::$user,
                    self::$password, 
                    self::$options
                );

            }
            
            return self::$instance;
        
        }
        
        public static function __callStatic($method, $args) {

            return call_user_func_array(array(self::instance(), $method), $args);

        }

        public static function run($sql, $args = []) {

            $stmt = self::instance()->prepare($sql);
            $stmt->execute($args);

            if(strpos($sql, "SELECT") !== false){
                $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            return $stmt;

        }

        private static function setProps() {

            $cfg = require __DIR__.'/../config/database.php';

            self::$type = $cfg['type'];
            self::$host = $cfg['host'];
            self::$db_name = $cfg['database_name'];
            self::$user = $cfg['user'];
            self::$password = $cfg['password'];
            self::$options = $cfg['options'];

        }
    }