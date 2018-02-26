<?php

    final class User extends Model {

        private $firstname;
        private $lastname;
        private $gender;
        private $email;
        private $password;
        private $type;

        public function __construct(string $id = null,  string $firstname = null,  
                                    string $lastname = null, string $gender = null, 
                                    string $email = null, string $password = null, 
                                    string $type = null){

            self::applyConfig();

            $this->id = htmlspecialchars(trim($id));
            $this->firstname = htmlspecialchars(trim($firstname));
            $this->lastname = htmlspecialchars(trim($lastname));
            $this->gender = htmlspecialchars(trim($gender));
            $this->email = htmlspecialchars(trim($email));
            $this->password = htmlspecialchars(trim($password));
            $this->type = htmlspecialchars(trim($type));
        }

        public function getFirstname(){
            return $this->firstname;
        }

        public function getLastname(){
            return $this->lastname;
        }

        public function getGender(){
            return $this->gender;
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

            $this->firstname = htmlspecialchars(trim($firstname));
            return $this;

        }

        public function setLastname($lastname){

            $this->lastname = htmlspecialchars(trim($lastname));
            return $this;

        }

        public function setGender($gender){

            $this->gender = htmlspecialchars(trim($gender));
            return $this;

        }

        public function setEmail($email){

            $this->email = htmlspecialchars(trim($email));
            return $this;

        }

        public function setPassword($password){

            $this->password = htmlspecialchars(trim($password));
            return $this;

        }

        public function setType($type){

            $this->type = htmlspecialchars(trim($type));
            return $this;

        }

        public function reset(){

            parent::reset();

            $this->firstname = null;
            $this->lastname = null;
            $this->gender = null;
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
                $user[0]['gender'],
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
                $user[0]['gender'],
                $user[0]['email'],
                $user[0]['password'],
                $user[0]['type']
            );

        }
        
        public static function getAll(){

            self::applyConfig();

            $dataAll = array();

            $data = Database::run('SELECT * FROM '. self::$table);

            foreach($data as $d){

                array_push($dataAll,

                new User(
                    $d['id'],
                    $d['firstname'],
                    $d['lastname'],
                    $d['gender'],
                    $d['email'],
                    $d['password'],
                    $d['type']
                ));

            }

            return $dataAll;

        }

        public function create(){

            $this->validate();

            $query = Database::run('INSERT INTO '. self::$table .'(firstname, lastname, gender, email, password, type) 
                           VALUES (?, ?, ?, ?, ?, ?)', 
            [
                $this->firstname,
                $this->lastname,
                $this->gender,
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
                    gender = ?,
                    email = ?,
                    password = ?,
                    type = ?
                    WHERE id = ?', 
                    [
                        $this->firstname,
                        $this->lastname,
                        $this->gender,
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

        public function encodePassword(){

            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
            return $this;
            
        }

        public function isValidPassword(string $password){
            
            if(password_verify($password, $this->password)){

                return true;

            } else {

                return false;

            }

        }

        protected function validate(){

            $regexp_email = '/(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/u';
            $regexp_name = '/^[A-ZА-ЯЁ]{1}[a-zа-яё\s?]{2,}$/u';
    
            if(is_null($this->firstname) || $this->firstname === ''){
                throw new Exception('firstname');
            }

            if(is_null($this->lastname) || $this->lastname === ''){
                throw new Exception('lastname');
            }

            if(is_null($this->gender) || $this->gender === ''){
                throw new Exception('gender');
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

            if($this->gender != "Мужской" && $this->gender != "Женский"){
                throw new Exception('gender');
            }
    
            if(!preg_match($regexp_email, $this->email)){
                throw new Exception('email');
            }
    
            if($this->type != '0' && $this->type != '1'){
                throw new Exception('type');
            }

        }

    }