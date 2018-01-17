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

            self::applyConfig();

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

        private static function applyConfig() {

            $conn = require __DIR__.'/../config/database_connection.php';

            self::$type = $conn['type'];
            self::$host = $conn['host'];
            self::$db_name = $conn['database_name'];
            self::$user = $conn['user'];
            self::$password = $conn['password'];
            self::$options = $conn['options'];

        }
    }