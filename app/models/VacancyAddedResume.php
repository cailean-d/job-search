<?php

    final class VacancyAddedResume extends Model {

        private $vacancyId;
        private $userid;

        private $userFirstname;
        private $userLastname;
        private $userEmail;

        public function __construct($id = null, $vacancyId = null, $userid = null, 
                                    $userFirstname = null, $userLastname = null, $userEmail = null){

            self::applyConfig();

            $this->id = htmlspecialchars(trim($id));
            $this->vacancyId = htmlspecialchars(trim($vacancyId));
            $this->userid = htmlspecialchars(trim($userid));
            $this->userFirstname = htmlspecialchars(trim($userFirstname));
            $this->userLastname = htmlspecialchars(trim($userLastname));
            $this->userEmail = htmlspecialchars(trim($userEmail));

        }

        public function getUserId(){
            return $this->userid;
        }

        public function getVacancyId(){
            return $this->vacancyId;
        }

        public function getUserFirstname(){
            return $this->userFirstname;
        }

        public function getUserLastname(){
            return $this->userLastname;
        }

        public function getUserEmail(){
            return $this->userEmail;
        }

        public function setUserId($userid){

            $this->userid = htmlspecialchars(trim($userid));
            return $this;

        }

        public function setVacancyId($levelId){

            $this->vacancyId = htmlspecialchars(trim($vacancyId));
            return $this;

        }

        public function reset(){

            parent::reset();

            $this->userid = null;
            $this->vacancyId = null;

        }

        public static function get($id){

            self::applyConfig();

            $data = Database::run('SELECT * FROM '. self::$table .' WHERE id = ? ', [$id]);

            return new VacancyAddedResume(
                $data[0]['id'],
                $data[0]['vacancy_id'],
                $data[0]['user_id']
            );

        }

        public static function getByUserId($id){

            self::applyConfig();

            $dataAll = array();

            $data = Database::run('SELECT * FROM '. self::$table .' WHERE user_id = ? ', [$id]);

            foreach($data as $d){

                array_push($dataAll,

                new VacancyAddedResume(
                    $d[0]['id'],
                    $d[0]['vacancy_id'],
                    $d[0]['user_id']
                ));

            }

            return $dataAll;

        }

        public static function getByVacancyId($id){

            self::applyConfig();

            $dataAll = array();

            $data = Database::run('SELECT * FROM '. self::$table .' WHERE vacancy_id = ? ', [$id]);

            foreach($data as $d){

                array_push($dataAll,

                new VacancyAddedResume(
                    $d[0]['id'],
                    $d[0]['vacancy_id'],
                    $d[0]['user_id']
                ));

            }

            return $dataAll;

        }

        public static function getJoinedByVacancyId($id){

            self::applyConfig();

            $dataAll = array();

            $data = Database::run('SELECT 
                            '. self::$table .'.*,
                            '. self::getClassTable('User') .'.firstname,
                            '. self::getClassTable('User') .'.lastname,
                            '. self::getClassTable('User') .'.email
                            FROM '. self::$table .' 
                            LEFT JOIN '. self::getClassTable('User') .' ON '. self::$table .'.user_id = '. self::getClassTable('User') .'.id
                            WHERE '. self::$table .'.vacancy_id= ?', [$id]);

            foreach($data as $d){

                array_push($dataAll,

                new VacancyAddedResume(
                    $d['id'],
                    $d['vacancy_id'],
                    $d['user_id'],
                    $d['firstname'],
                    $d['lastname'],
                    $d['email']
                ));

            }

            return $dataAll;
            
        }

        public static function isResumeSent($userid, $vacancyId){

            self::applyConfig();

            $dataAll = array();

            $data = Database::run('SELECT * FROM '. self::$table .' WHERE user_id = ? AND vacancy_id = ?', [$userid, $vacancyId]);


            if(empty($data[0]['id'])){

                return false;

            } else {

                return true;

            }

        }

        public static function getAll(){

            self::applyConfig();

            $dataAll = array();

            $data = Database::run('SELECT * FROM '. self::$table);

            foreach($data as $d){

                array_push($dataAll,

                new VacancyAddedResume(
                    $d[0]['id'],
                    $d[0]['vacancy_id'],
                    $d[0]['user_id']
                ));

            }

            return $dataAll;

        }

        public function create(){

            $this->validate();

            $query = Database::run('INSERT INTO '. self::$table .'
            (vacancy_id, user_id) 
            VALUES (?, ?)', 
            [
                $this->vacancyId,
                $this->userid,
            ]);

            $this->id = Database::lastInsertId();

            return $query;

        }

        public function update(){

            $this->validate();

            return Database::run(
                    'UPDATE '. self::$table .' SET 
                    vacancy_id = ?,
                    user_id = ?
                    WHERE id = ?', 
                    [
                        $this->vacancyId,
                        $this->userid,
                        $this->id
                    ]);

        }

        public function delete(){

            $query = Database::run('DELETE FROM '. self::$table .' WHERE id = ?', [$this->id]);

            $this->reset();
            
            return $query;

        }

        protected function validate(){

            $regexp_numbers = '/^[\d]{1,}$/u';

            if(is_null($this->vacancyId) || $this->vacancyId === ''){
                throw new Exception('vacancyId');
            }

            if(is_null($this->userid) || $this->userid === ''){
                throw new Exception('userid');
            }

            if(!preg_match($regexp_numbers, $this->vacancyId)){
                throw new Exception('vacancyId');
            }

            if(!preg_match($regexp_numbers, $this->userid)){
                throw new Exception('userid');
            }

        }

    }