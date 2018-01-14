<?php

    require __DIR__.'/Database.php';

    class User {

        private static $table;

        private $id;
        private $firstname;
        private $lastname;
        private $email;
        private $password;
        private $type;

        public function __construct(string $id = null,  string $firstname = null,  
                                    string $lastname = null, string $email = null, 
                                    string $password = null, string $type = null){

            self::applyConfig();

            $this->id = htmlspecialchars(trim($id));
            $this->firstname = htmlspecialchars(trim($firstname));
            $this->lastname = htmlspecialchars(trim($lastname));
            $this->email = htmlspecialchars(trim($email));
            $this->password = htmlspecialchars(trim($password));
            $this->type = htmlspecialchars(trim($type));
        }

        public function getId(){
            return $this->id;
        }

        public function getFirstname(){
            return $this->firstname;
        }

        public function getLastname(){
            return $this->lastname;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getPassword(){
            return $this->password;
        }

        public function getType(){
            return $this->type;
        }

        public function setFirstname($firstname){
            $this->firstname = $firstname;
        }

        public function setLastname($lastname){
            $this->lastname = $lastname;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function setType($type){
            $this->type = $type;
        }

        public function reset(){

            $this->id = null;
            $this->firstname = null;
            $this->lastname = null;
            $this->email = null;
            $this->password = null;
            $this->type = null;

        }

        public static function get($id){

            self::applyConfig();

            $user = Database::run('SELECT * FROM '. self::$table .' WHERE id = ? ', [$id]);

            return new User(
                $user[0]['id'],
                $user[0]['firstname'],
                $user[0]['lastname'],
                $user[0]['email'],
                $user[0]['password'],
                $user[0]['type']
            );

        }

        public static function getByEmail(string $email){

            self::applyConfig();

            $user = Database::run('SELECT * FROM '. self::$table .' WHERE email = ? ', [$email]);

            return new User(
                $user[0]['id'],
                $user[0]['firstname'],
                $user[0]['lastname'],
                $user[0]['email'],
                $user[0]['password'],
                $user[0]['type']
            );

        }

        public function create(){

            $this->validate();

            $query = Database::run('INSERT INTO '. self::$table .'(firstname, lastname, email, password, type) 
                           VALUES (?, ?, ?, ?, ?)', 
            [
                $this->firstname,
                $this->lastname,
                $this->email,
                $this->password,
                $this->type
            ]);

            $this->id = Database::lastInsertId();

            return $query;

        }

        public function update(){

            $this->validate();

            return Database::run(
                    'UPDATE '. self::$table .' SET 
                    firstname = ?,
                    lastname = ?,
                    email = ?,
                    password = ?,
                    type = ?
                    WHERE id = ?', 
                    [
                        $this->firstname,
                        $this->lastname,
                        $this->email,
                        $this->password,
                        $this->type,
                        $this->id
                    ]);

        }

        public function delete(){

            $query = Database::run('DELETE FROM '. self::$table .' WHERE id = ? ', [$this->id]);

            $this->reset();
            
            return $query;

        }

        public function save(){

            $user = User::get($this->id);

            if($user->getId() === '' || is_null($user->getId())){

                $this->create();

            } else {

                $this->update();

            }
        }

        public function encodePassword(){
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }

        public function isValidPassword(string $password){
            
            if(password_verify($password, $this->password)){

                return true;

            } else {

                return false;

            }

        }

        private function validate(){

            $regexp_email = '/(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/u';
            $regexp_name = '/^[A-ZА-ЯЁ]{1}[a-zа-яё\s?]{2,}$/u';
    
            if(is_null($this->firstname) || $this->firstname === ''){
                throw new Exception('firstname');
            }

            if(is_null($this->lastname) || $this->lastname === ''){
                throw new Exception('lastname');
            }

            if(is_null($this->email) || $this->email === ''){
                throw new Exception('email');
            }

            if(is_null($this->password) || $this->password === ''){
                throw new Exception('password');
            }

            if(is_null($this->type) || $this->type === ''){
                throw new Exception('type');
            }
    
            if(!preg_match($regexp_name, $this->firstname)){
                throw new Exception('firstname');
            }
    
            if(!preg_match($regexp_name, $this->lastname)){
                throw new Exception('lastname');
            }
    
            if(!preg_match($regexp_email, $this->email)){
                throw new Exception('email');
            }
    
            if($this->type != '0' && $this->type != '1'){
                throw new Exception('type');
            }

        }

        private function applyConfig(){
            
            $table = require __DIR__.'/../config/database_tables.php';

            self::$table = $table['user'];

        }

    }