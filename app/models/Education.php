<?php

    final class Education extends Model {

        private $userid;
        private $levelId;
        private $institute;
        private $city;
        private $faculty;
        private $studyPeriod;

        private $levelName;

        public function __construct($id = null, $userid = null, $levelId = null, $institute = null,
                                    $city = null, $faculty = null, $studyPeriod = null, $levelName = null){

            self::applyConfig();

            $this->id = htmlspecialchars(trim($id));
            $this->userid = htmlspecialchars(trim($userid));
            $this->levelId = htmlspecialchars(trim($levelId));
            $this->institute = htmlspecialchars(trim($institute));
            $this->city = htmlspecialchars(trim($city));
            $this->faculty = htmlspecialchars(trim($faculty));
            $this->studyPeriod = htmlspecialchars(trim($studyPeriod));
            $this->levelName = htmlspecialchars(trim($levelName));

        }

        public function getUserId(){
            return $this->userid;
        }

        public function getLevelId(){
            return $this->levelId;
        }

        public function getInstitute(){
            return $this->institute;
        }

        public function getCity(){
            return $this->city;
        }

        public function getFaculty(){
            return $this->faculty;
        }

        public function getStudyPeriod(){
            return $this->studyPeriod;
        }

        public function getLevelName(){
            return $this->levelName;
        }

        public function setUserId($userid){

            $this->userid = htmlspecialchars(trim($userid));
            return $this;

        }

        public function setLevelId($levelId){

            $this->levelId = htmlspecialchars(trim($levelId));
            return $this;

        }

        public function setInstitute($institute){

            $this->institute = htmlspecialchars(trim($institute));
            return $this;

        }

        public function setCity($city){

            $this->city = htmlspecialchars(trim($city));
            return $this;

        }

        public function setFaculty($faculty){
        
            $this->faculty = htmlspecialchars(trim($faculty));
            return $this;
        
        }

        public function setStudyPeriod($id){

            $this->studyPeriod = htmlspecialchars(trim($studyPeriod));
            return $this;

        }

        public function reset(){

            parent::reset();

            $this->userid = null;
            $this->userLevel = null;
            $this->institute = bull;
            $this->city = null;
            $this->faculty = null;
            $this->studyPeriod = null;

        }

        public static function get($id){

            self::applyConfig();

            $education = Database::run('SELECT * FROM '. self::$table .' WHERE id = ? ', [$id]);

            return new Education(
                $education[0]['id'],
                $education[0]['user_id'],
                $education[0]['level_id'],
                $education[0]['inst'],
                $education[0]['city'],
                $education[0]['faculty'],
                $education[0]['study_period']
            );

        }

        public static function getByUserId($id){

            self::applyConfig();

            $educationAll = array();

            $education = Database::run('SELECT * FROM '. self::$table .' WHERE user_id = ? ', [$id]);

            foreach($education as $edu){

                array_push($educationAll,

                new Education(
                    $edu['id'],
                    $edu['user_id'],
                    $edu['level_id'],
                    $edu['inst'],
                    $edu['city'],
                    $edu['faculty'],
                    $edu['study_period']
                ));

            }

            return $educationAll;

        }

        public static function getJoinedByUserid($id){

            self::applyConfig();

            $educationAll = array();

            $education = Database::run('
                SELECT 
                '. self::$table .'.*,
                '. self::getClassTable('HelperEducation') .'.education_name
                FROM '. self::$table .'
                LEFT JOIN '. self::getClassTable('HelperEducation') .' ON '. self::$table .'.level_id = '. self::getClassTable('HelperEducation') .'.id
                WHERE user_id = ?', [$id]);

            foreach($education as $edu){

                array_push($educationAll,

                new Education(
                    $edu['id'],
                    $edu['user_id'],
                    $edu['level_id'],
                    $edu['inst'],
                    $edu['city'],
                    $edu['faculty'],
                    $edu['study_period'],
                    $edu['education_name']
                ));

            }

            return $educationAll;

        }

        public static function getAll(){

            self::applyConfig();

            $educationAll = array();

            $education = Database::run('SELECT * FROM '. self::$table);

            foreach($education as $edu){

                array_push($educationAll,

                new Education(
                    $edu['id'],
                    $edu['user_id'],
                    $edu['level_id'],
                    $edu['inst'],
                    $edu['city'],
                    $edu['faculty'],
                    $edu['study_period']
                ));

            }

            return $educationAll;

        }

        public function create(){

            $this->validate();

            $query = Database::run('INSERT INTO '. self::$table .'
            (user_id, level_id, inst, city, faculty, study_period) 
            VALUES (?, ?, ?, ?, ?, ?)', 
            [
                $this->userid,
                $this->levelId,
                $this->institute,
                $this->city,
                $this->faculty,
                $this->studyPeriod
            ]);

            $this->id = Database::lastInsertId();

            return $query;

        }

        public function update(){

            $this->validate();

            return Database::run(
                    'UPDATE '. self::$table .' SET 
                    level_id = ?,
                    inst = ?,
                    city = ?,
                    faculty = ?,
                    study_period = ?
                    WHERE user_id = ? AND id = ?', 
                    [
                        $this->levelId,
                        $this->institute,
                        $this->city,
                        $this->faculty,
                        $this->studyPeriod,
                        $this->userid,
                        $this->id
                    ]);

        }

        public function delete(){

            $query = Database::run('DELETE FROM '. self::$table .' WHERE user_id = ? AND id = ?', [$this->userid, $this->id]);

            $this->reset();
            
            return $query;

        }

        protected function validate(){

            $regexp_city = '/^[A-zА-яЁё\"\-\s?]{4,}$/u';
            $regexp_sentence = '/^[A-zА-яЁё0-9\.,!:\\(\)#"\-\s?]{4,}$/u';
            $regexp_numbers = '/^[\d]{1,}$/u';
            $regexp_edu_period = '/^[\d]{4}\s\-\s[\d]{4}$/u';
    
            if(is_null($this->userid) || $this->userid === ''){
                throw new Exception('userid');
            }

            if(is_null($this->levelId) || $this->levelId === ''){
                throw new Exception('levelId');
            }

            if(is_null($this->institute) || $this->institute === ''){
                throw new Exception('institute');
            }

            if(is_null($this->city) || $this->city === ''){
                throw new Exception('city');
            }

            if(is_null($this->faculty) || $this->faculty === ''){
                throw new Exception('faculty');
            }

            if(is_null($this->studyPeriod) || $this->studyPeriod === ''){
                throw new Exception('studyPeriod');
            }

            if(!preg_match($regexp_numbers, $this->levelId)){
                throw new Exception('levelId');
            }

            if(!preg_match($regexp_sentence, $this->institute)){
                throw new Exception('institute');
            }

            if(!preg_match($regexp_city, $this->city)){
                throw new Exception('city');
            }
            
            if(!empty($this->faculty) && !preg_match($regexp_sentence, $this->faculty)){
                throw new Exception('faculty');
            }

            if(!preg_match($regexp_edu_period, $this->studyPeriod)){
                throw new Exception('studyPeriod');
            }

        }

    }