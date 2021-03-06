<?php

    final class Resume extends Model {

        private $userid;
        private $birthday;
        private $city;
        private $phone;
        private $email;
        private $post;
        private $industryId;
        private $scheduleId;
        private $salary;
        private $workPlaceId;
        private $compSkillId;
        private $car;
        private $courses;
        private $skills;

        private $industryName;
        private $scheduleName;
        private $workPlaceName;
        private $compSkillName;
        private $avatar;
        private $user;

        public function __construct($id = null,
                                        $userid = null,
                                        $birthday = null,
                                        $city = null,
                                        $phone = null,
                                        $email = null,
                                        $post = null,
                                        $industryId = null,
                                        $scheduleId = null,
                                        $salary = null,
                                        $workPlaceId = null,
                                        $compSkillId = null,
                                        $car = null,
                                        $courses = null,
                                        $skills = null,
                                        $industryName = null,
                                        $scheduleName = null,
                                        $workPlaceName = null,
                                        $compSkillName = null,
                                        $avatar = null,
                                        $user = null){

            self::applyConfig();

            $this->id = htmlspecialchars(trim($id));
            $this->userid = htmlspecialchars(trim($userid));
            $this->birthday = htmlspecialchars(trim($birthday));
            $this->city = htmlspecialchars(trim($city));
            $this->phone = htmlspecialchars(trim($phone));
            $this->email = htmlspecialchars(trim($email));
            $this->post = htmlspecialchars(trim($post));
            $this->industryId = htmlspecialchars(trim($industryId));
            $this->scheduleId = htmlspecialchars(trim($scheduleId));
            $this->salary = htmlspecialchars(trim($salary));
            $this->workPlaceId = htmlspecialchars(trim($workPlaceId));
            $this->compSkillId = htmlspecialchars(trim($compSkillId));
            $this->car = htmlspecialchars(trim($car));
            $this->courses = htmlspecialchars(trim($courses));
            $this->skills = htmlspecialchars(trim($skills));
            $this->industryName = htmlspecialchars(trim($industryName));
            $this->scheduleName = htmlspecialchars(trim($scheduleName));
            $this->workPlaceName = htmlspecialchars(trim($workPlaceName));
            $this->compSkillName = htmlspecialchars(trim($compSkillName));
            $this->avatar = htmlspecialchars(trim($avatar));
            $this->user = $user;
        }

        public function getUserid(){
            return $this->userid;
        }

        public function getBirthday(){
            return $this->birthday;
        }

        public function getCity(){
            return $this->city;
        }

        public function getPhone(){
            return $this->phone;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getPost(){
            return $this->post;
        }

        public function getIndustryId(){
            return $this->industryId;
        }

        public function getScheduleId(){
            return $this->scheduleId;
        }

        public function getSalary(){
            return $this->salary;
        }

        public function getWorkPlaceId(){
            return $this->workPlaceId;
        }

        public function getCompSkillId(){
            return $this->compSkillId;
        }

        public function getCar(){
            return $this->car;
        }

        public function getCourses(){
            return $this->courses;
        }

        public function getSkills(){
            return $this->skills;
        }

        public function getIndustryName(){
            return $this->industryName;
        }

        public function getScheduleName(){
            return $this->scheduleName;
        }

        public function getWorkPlaceName(){
            return $this->workPlaceName;
        }

        public function getCompSkillName(){
            return $this->compSkillName;
        }

        public function getAvatar() {
            return $this->avatar;
        }

        public function getUser() {
            return $this->user;
        }
        
        public function setUserid($userid){

            $this->userid = htmlspecialchars(trim($userid));
            return $this;

        }

        public function setBirthday($birthday){

            $this->birthday = htmlspecialchars(trim($birthday));
            return $this;

        }

        public function setCity($city){

            $this->city = htmlspecialchars(trim($city));
            return $this;

        }

        public function setPhone($phone){

            $this->phone = htmlspecialchars(trim($phone));
            return $this;

        }

        public function setEmail($email){

            $this->email = htmlspecialchars(trim($email));
            return $this;

        }

        public function setPost($phone){

            $this->post = htmlspecialchars(trim($phone));
            return $this;

        }

        public function setIndustryId($industryId){

            $this->industryId = htmlspecialchars(trim($industryId));
            return $this;

        }

        public function setScheduleId($scheduleId){

            $this->scheduleId = htmlspecialchars(trim($scheduleId));
            return $this;

        }

        public function setSalary($salary){

            $this->salary = htmlspecialchars(trim($salary));
            return $this;

        }

        public function setWorkPlaceId($workPlaceId){

            $this->workPlaceId = htmlspecialchars(trim($workPlaceId));
            return $this;

        }

        public function setCompSkillId($compSkillId){

            $this->compSkillId = htmlspecialchars(trim($compSkillId));
            return $this;

        }

        public function setCar($car){

            $this->car = htmlspecialchars(trim($car));
            return $this;

        }

        public function setCourses($courses){

            $this->courses = htmlspecialchars(trim($courses));
            return $this;

        }

        public function setSkills($skills){

            $this->skills = htmlspecialchars(trim($skills));
            return $this;

        }

        public function reset(){

            parent::reset();

            $userid = null;
            $birthday = null;
            $city = null;
            $phone = null;
            $email = null;
            $post = null;
            $industryId = null;
            $scheduleId = null;
            $salary = null;
            $workPlaceId = null;
            $compSkillId = null;
            $car = null;
            $courses = null;
            $skills = null;

        }

        public static function get($id){

            self::applyConfig();

            $data = Database::run('SELECT * FROM '. self::$table .' WHERE id = ? ', [$id]);

            return new Resume(
                $data[0]['id'],
                $data[0]['user_id'],
                $data[0]['birthday'],
                $data[0]['city'],
                $data[0]['phone'],
                $data[0]['email'],
                $data[0]['post'],
                $data[0]['industry_id'],
                $data[0]['schedule_id'],
                $data[0]['salary'],
                $data[0]['work_place_id'],
                $data[0]['comp_skill_id'],
                $data[0]['car'],
                $data[0]['courses'],
                $data[0]['skills']
            );

        }

        public static function getByUserId($id){

            self::applyConfig();

            $data = Database::run('SELECT * FROM '. self::$table .' WHERE user_id = ? ', [$id]);

            return new Resume(
                $data[0]['id'],
                $data[0]['user_id'],
                $data[0]['birthday'],
                $data[0]['city'],
                $data[0]['phone'],
                $data[0]['email'],
                $data[0]['post'],
                $data[0]['industry_id'],
                $data[0]['schedule_id'],
                $data[0]['salary'],
                $data[0]['work_place_id'],
                $data[0]['comp_skill_id'],
                $data[0]['car'],
                $data[0]['courses'],
                $data[0]['skills']
            );

        }
        
        public static function getAll(){

            self::applyConfig();

            $dataAll = array();

            $data = Database::run('SELECT * FROM '. self::$table);

            foreach($data as $d){

                $avatar = Avatar::get($d['user_id']);

                array_push($dataAll,

                new Resume(
                    $d['id'],
                    $d['user_id'],
                    $d['birthday'],
                    $d['city'],
                    $d['phone'],
                    $d['email'],
                    $d['post'],
                    $d['industry_id'],
                    $d['schedule_id'],
                    $d['salary'],
                    $d['work_place_id'],
                    $d['comp_skill_id'],
                    $d['car'],
                    $d['courses'],
                    $d['skills'],
                    null,
                    null,
                    null,
                    null,
                    $avatar->getSource(),
                    User::get($d['user_id'])
                ));

            }

            return $dataAll;

        }

        public static function getJoinedByUserId($userid){

            
            self::applyConfig();

            $data = Database::run('
                    SELECT 
                    '. self::$table .'.*,
                    '. self::getClassTable('HelperSchedule') .'.schedule_name,
                    '. self::getClassTable('HelperIndustry') .'.industry_name,
                    '. self::getClassTable('HelperWorkPlace') .'.work_place_name,
                    '. self::getClassTable('HelperCompSkill') .'.cs_name
                    FROM '. self::$table .' 
                    LEFT JOIN '. self::getClassTable('HelperSchedule') .' ON '. self::$table .'.schedule_id = '. self::getClassTable('HelperSchedule') .'.id
                    LEFT JOIN '. self::getClassTable('HelperIndustry') .' ON '. self::$table .'.industry_id = '. self::getClassTable('HelperIndustry') .'.id 
                    LEFT JOIN '. self::getClassTable('HelperWorkPlace') .' ON '. self::$table .'.work_place_id = '. self::getClassTable('HelperWorkPlace') .'.id 
                    LEFT JOIN '. self::getClassTable('HelperCompSkill') .' ON '. self::$table .'.comp_skill_id = '. self::getClassTable('HelperCompSkill') .'.id 
                    WHERE user_id = ?', [$userid]);

            return new Resume(
                $data[0]['id'],
                $data[0]['user_id'],
                $data[0]['birthday'],
                $data[0]['city'],
                $data[0]['phone'],
                $data[0]['email'],
                $data[0]['post'],
                $data[0]['industry_id'],
                $data[0]['schedule_id'],
                $data[0]['salary'],
                $data[0]['work_place_id'],
                $data[0]['comp_skill_id'],
                $data[0]['car'],
                $data[0]['courses'],
                $data[0]['skills'],
                $data[0]['industry_name'],
                $data[0]['schedule_name'],
                $data[0]['work_place_name'],
                $data[0]['cs_name']
            );

        }

        public function create(){

            $this->validate();

            $query = Database::run('INSERT INTO '. self::$table .'
            (
                user_id, birthday, city, phone, email, post,
                industry_id, schedule_id, salary, work_place_id, 
                comp_skill_id, car, courses, skills
            ) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
            [
                $this->userid,
                $this->birthday,
                $this->city,
                $this->phone,
                $this->email,
                $this->post,
                $this->industryId,
                $this->scheduleId,
                $this->salary,
                $this->workPlaceId,
                $this->compSkillId,
                $this->car,
                $this->courses,
                $this->skills
            ]);

            $this->id = Database::lastInsertId();

            return $query;

        }

        public function update(){

            $this->validate();

            return Database::run(
                    'UPDATE '. self::$table .' SET 
                    birthday = ?,
                    city = ?,
                    phone = ?,
                    email = ?,
                    post = ?,
                    industry_id = ?,
                    schedule_id = ?,
                    salary = ?,
                    work_place_id = ?,
                    comp_skill_id = ?,
                    car = ?,
                    courses = ?,
                    skills = ? 
                    WHERE user_id = ?', 
                    [
                        $this->birthday,
                        $this->city,
                        $this->phone,
                        $this->email,
                        $this->post,
                        $this->industryId,
                        $this->scheduleId,
                        $this->salary,
                        $this->workPlaceId,
                        $this->compSkillId,
                        $this->car,
                        $this->courses,
                        $this->skills,
                        $this->userid
                    ]);

        }

        public function delete(){

            $query = Database::run('DELETE FROM '. self::$table .' WHERE user_id = ? ', [$this->userid]);

            $this->reset();
            
            return $query;

        }

        protected function validate(){

            $regexp_phone = '/^\+[\d]{11}$/u';
            $regexp_city = '/^[A-zА-яЁё\"\-\s?]{4,}$/u';
            $regexp_birth = '/^[\d]{2}\.[\d]{2}\.[\d]{4}$/u';
            $regexp_email = '/(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/u';
            $regexp_sentence = '/^[A-zА-яЁё0-9\.,!:\\(\)#"\-\s?]{4,}$/u';
            $regexp_numbers = '/^[\d]{1,}$/u';

            if(is_null($this->birthday) || $this->birthday === ''){
                throw new Exception('birthday');
            }

            elseif(is_null($this->city) || $this->city === ''){
                throw new Exception('city');
            }

            elseif(is_null($this->phone) || $this->phone === ''){
                throw new Exception('phone');
            }

            elseif(is_null($this->email) || $this->email === ''){
                throw new Exception('email');
            }

            elseif(is_null($this->post) || $this->post === ''){
                throw new Exception('post');
            }

            elseif(is_null($this->industryId) || $this->industryId === ''){
                throw new Exception('industryId');
            }

            elseif(is_null($this->scheduleId) || $this->scheduleId === ''){
                throw new Exception('scheduleId');
            }

            elseif(is_null($this->salary) || $this->salary === ''){
                throw new Exception('salary');
            }

            elseif(is_null($this->workPlaceId) || $this->workPlaceId === ''){
                throw new Exception('workPlaceId');
            }

            elseif(!preg_match($regexp_birth, $this->birthday)){
                throw new Exception('birthday');
            }

            elseif(!preg_match($regexp_city, $this->city)){
                throw new Exception('city');
            }

            elseif(!preg_match($regexp_phone, $this->phone)){
                throw new Exception('phone');
            }

            elseif(!preg_match($regexp_email, $this->email)){
                throw new Exception('email');
            }

            elseif(!preg_match($regexp_sentence, $this->post)){
                throw new Exception('post');
            }

            elseif(!preg_match($regexp_numbers, $this->industryId)){
                throw new Exception('industryId');
            }

            elseif(!preg_match($regexp_numbers, $this->scheduleId)){
                throw new Exception('scheduleId');
            }

            elseif(!preg_match($regexp_numbers, $this->workPlaceId)){
                throw new Exception('workPlaceId');
            }

            elseif(!preg_match($regexp_numbers, $this->salary)){
                throw new Exception('salary');
            }

            elseif(
                    !empty($this->compSkillId) && 
                    !preg_match($regexp_numbers, $this->compSkillId)
                   ){
                    throw new Exception('compSkillId');
            }

            elseif(
                    !empty($this->car) && 
                    ($_POST['car'] != "Да" && $this->car != "Нет")
                   ){
                    throw new Exception('car');
            }

            elseif(
                    !empty($this->courses) && 
                    !preg_match($regexp_sentence, $this->courses)
                   ){
                    throw new Exception('courses');
            }
            
            elseif(
                    !empty($this->skills) && 
                    !preg_match($regexp_sentence, $this->skills)
                   ){
                    throw new Exception('skills');
            }

        }

    }