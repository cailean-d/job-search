<?php

    final class Vacancy extends Model {

        private $senderName;
        private $senderId;
        private $email;
        private $company;
        private $phone;
        private $vacancyName;
        private $salaryMin;
        private $salaryMax;
        private $experience;
        private $location;
        private $scheduleId;
        private $industryId;
        private $demands;
        private $duties;
        private $conditions;
        private $description;
        private $status;
        private $date;
        
        private $scheduleName;

        public function __construct($id = null, $senderName = null, $senderId = null, 
                                    $email = null, $company = null, $phone = null, 
                                    $vacancyName = null, $salaryMin = null, $salaryMax = null, 
                                    $experience = null, $location = null, $scheduleId = null, 
                                    $industryId = null, $demands = null, $duties = null, 
                                    $conditions = null, $description = null, $status = null, 
                                    $date = null, $scheduleName = null){

            self::applyConfig();

            $this->id = htmlspecialchars(trim($id));
            $this->senderName = htmlspecialchars(trim($senderName));
            $this->senderId = htmlspecialchars(trim($senderId));
            $this->email = htmlspecialchars(trim($email));
            $this->company = htmlspecialchars(trim($company));
            $this->phone = htmlspecialchars(trim($phone));
            $this->vacancyName = htmlspecialchars(trim($vacancyName));
            $this->salaryMin = htmlspecialchars(trim($salaryMin));
            $this->salaryMax = htmlspecialchars(trim($salaryMax));
            $this->experience = htmlspecialchars(trim($experience));
            $this->location = htmlspecialchars(trim($location));
            $this->scheduleId = htmlspecialchars(trim($scheduleId));
            $this->industryId = htmlspecialchars(trim($industryId));
            $this->demands = htmlspecialchars(trim($demands));
            $this->duties = htmlspecialchars(trim($duties));
            $this->conditions = htmlspecialchars(trim($conditions));
            $this->description = htmlspecialchars(trim($description));
            $this->status = htmlspecialchars(trim($status));
            $this->date = htmlspecialchars(trim($date));
            $this->scheduleName = htmlspecialchars(trim($scheduleName));

        }

        public function getSenderName(){
            return $this->senderName;
        }

        public function getSenderId(){
            return $this->senderId;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getCompany(){
            return $this->company;
        }

        public function getPhone(){
            return $this->phone;
        }

        public function getVacancyName(){
            return $this->vacancyName;
        }

        public function getSalaryMin(){
            return $this->salaryMin;
        }

        public function getSalaryMax(){
            return $this->salaryMax;
        }

        public function getExperience(){
            return $this->experience;
        }

        public function getLocation(){
            return $this->location;
        }

        public function getScheduleId(){
            return $this->scheduleId;
        }

        public function getIndustryId(){
            return $this->industryId;
        }

        public function getDemands(){
            return $this->demands;
        }

        public function getDuties(){
            return $this->duties;
        }

        public function getConditions(){
            return $this->conditions;
        }

        public function getDescription(){
            return $this->description;
        }

        public function getStatus(){
            return $this->status;
        }

        public function getDate(){
            return $this->date;
        }

        public function getScheduleName(){
            return $this->scheduleName;
        }

        public function setSenderName($senderName){

            $this->senderName = htmlspecialchars(trim($senderName));
            return $this;

        }

        public function setSenderId($senderId){

            $this->senderId = htmlspecialchars(trim($senderId));
            return $this;

        }

        public function setEmail($email){

            $this->email = htmlspecialchars(trim($email));
            return $this;

        }

        public function setCompany($company){

            $this->company = htmlspecialchars(trim($company));
            return $this;

        }

        public function setPhone($phone){

            $this->phone = htmlspecialchars(trim($phone));
            return $this;

        }

        public function setVacancyName($vacancyName){

            $this->vacancyName = htmlspecialchars(trim($vacancyName));
            return $this;

        }

        public function setSalaryMin($salaryMin){

            $this->salaryMin = htmlspecialchars(trim($salaryMin));
            return $this;

        }

        public function setSalaryMax($salaryMax){

            $this->salaryMax = htmlspecialchars(trim($salaryMax));
            return $this;

        }

        public function setExperience($experience){

            $this->experience = htmlspecialchars(trim($experience));
            return $this;

        }

        public function setLocation($location){

            $this->location = htmlspecialchars(trim($location));
            return $this;

        }

        public function setScheduleId($scheduleId){

            $this->scheduleId = htmlspecialchars(trim($scheduleId));
            return $this;

        }

        public function setIndustryId($industryId){

            $this->industryId = htmlspecialchars(trim($industryId));
            return $this;

        }

        public function setDemands($demands){

            $this->demands = htmlspecialchars(trim($demands));
            return $this;

        }

        public function setDuties($duties){

            $this->duties = htmlspecialchars(trim($duties));
            return $this;

        }

        public function setConditions($conditions){

            $this->conditions = htmlspecialchars(trim($conditions));
            return $this;

        }

        public function setDescription($description){

            $this->description = htmlspecialchars(trim($description));
            return $this;

        }

        public function setStatus($status){

            $this->status = htmlspecialchars(trim($status));
            return $this;

        }

        public function setDate($date){

            $this->date = htmlspecialchars(trim($date));
            return $this;

        }

        public function reset(){

            parent::reset();

            $this->senderName = null;
            $this->senderId = null;
            $this->email = null;
            $this->company = null;
            $this->phone = null;
            $this->vacancyName = null;
            $this->salaryMin = null;
            $this->salaryMax = null;
            $this->experience = null;
            $this->location = null;
            $this->scheduleId = null;
            $this->industryId = null;
            $this->demands = null;
            $this->duties = null;
            $this->conditions = null;
            $this->description = null;
            $this->status = null;
            $this->date = null;

        }

        public static function get($id){

            self::applyConfig();

            $vacancy = Database::run('SELECT * FROM '. self::$table .' WHERE id = ? ', [$id]);

            return new Vacancy(
                $vacancy[0]['id'],
                $vacancy[0]['sender_name'],
                $vacancy[0]['sender_id'],
                $vacancy[0]['email'],
                $vacancy[0]['company'],
                $vacancy[0]['phone'],
                $vacancy[0]['vacancy'],
                $vacancy[0]['salary_min'],
                $vacancy[0]['salary_max'],
                $vacancy[0]['exp'],
                $vacancy[0]['location'],
                $vacancy[0]['schedule'],
                $vacancy[0]['industry'],
                $vacancy[0]['demands'],
                $vacancy[0]['duties'],
                $vacancy[0]['conditions'],
                $vacancy[0]['description'],
                $vacancy[0]['status'],
                $vacancy[0]['date']
            );

        }

        public static function getByUserId($id){

            self::applyConfig();

            $vacancyAll = array();

            $vacancy = Database::run('SELECT * FROM '. self::$table .' WHERE sender_id = ? ', [$id]);

            foreach($vacancy as $vac){

                array_push($vacancyAll,

                new Vacancy(
                    $vac['id'],
                    $vac['sender_name'],
                    $vac['sender_id'],
                    $vac['email'],
                    $vac['company'],
                    $vac['phone'],
                    $vac['vacancy'],
                    $vac['salary_min'],
                    $vac['salary_max'],
                    $vac['exp'],
                    $vac['location'],
                    $vac['schedule'],
                    $vac['industry'],
                    $vac['demands'],
                    $vac['duties'],
                    $vac['conditions'],
                    $vac['description'],
                    $vac['status'],
                    $vac['date']
                ));

            }

            return $vacancyAll;

        }

        public static function getAll(){

            self::applyConfig();

            $vacancyAll = array();

            $vacancy = Database::run('SELECT * FROM '. self::$table);

            foreach($vacancy as $vac){

                array_push($vacancyAll,

                new Vacancy(
                    $vac['id'],
                    $vac['sender_name'],
                    $vac['sender_id'],
                    $vac['email'],
                    $vac['company'],
                    $vac['phone'],
                    $vac['vacancy'],
                    $vac['salary_min'],
                    $vac['salary_max'],
                    $vac['exp'],
                    $vac['location'],
                    $vac['schedule'],
                    $vac['industry'],
                    $vac['demands'],
                    $vac['duties'],
                    $vac['conditions'],
                    $vac['description'],
                    $vac['status'],
                    $vac['date']
                ));

            }

            return $vacancyAll;

        }

        public static function getFiltered(){
           
            self::applyConfig();

            $vacancyAll = array();

            $vacancy = Database::run(self::getFilteredSQL());

            foreach($vacancy as $vac){

                array_push($vacancyAll,

                new Vacancy(
                    $vac['id'],
                    $vac['sender_name'],
                    $vac['sender_id'],
                    $vac['email'],
                    $vac['company'],
                    $vac['phone'],
                    $vac['vacancy'],
                    $vac['salary_min'],
                    $vac['salary_max'],
                    $vac['exp'],
                    $vac['location'],
                    $vac['schedule'],
                    $vac['industry'],
                    $vac['demands'],
                    $vac['duties'],
                    $vac['conditions'],
                    $vac['description'],
                    $vac['status'],
                    $vac['date'],
                    $vac['schedule_name']
                ));

            }

            return $vacancyAll;

        }

        public static function getJoinedByUserId($id){

            
            self::applyConfig();

            $vacancyAll = array();

            $vacancy = Database::run('
                        SELECT 
                        '. self::$table .'.*,
                        help_schedule.schedule_name
                        FROM '. self::$table .' 
                        LEFT JOIN help_schedule ON '. self::$table .'.schedule = help_schedule.id
                        WHERE sender_id= ?
                        ORDER BY `date` DESC', [$id]);

            foreach($vacancy as $vac){

                array_push($vacancyAll,

                new Vacancy(
                    $vac['id'],
                    $vac['sender_name'],
                    $vac['sender_id'],
                    $vac['email'],
                    $vac['company'],
                    $vac['phone'],
                    $vac['vacancy'],
                    $vac['salary_min'],
                    $vac['salary_max'],
                    $vac['exp'],
                    $vac['location'],
                    $vac['schedule'],
                    $vac['industry'],
                    $vac['demands'],
                    $vac['duties'],
                    $vac['conditions'],
                    $vac['description'],
                    $vac['status'],
                    $vac['date'],
                    $vac['schedule_name']
                ));

            }

            return $vacancyAll;

        }

        public static function getCities(){

            self::applyConfig();

            $a = array();
            
            $res = Database::run('SELECT DISTINCT location FROM '. self::$table);

            foreach($res as $r){

                array_push($a, $r['location']);

            }

            return $a;

        }

        public static function getPublished(){
            
            self::applyConfig();

            $vacancyAll = array();

            $vacancy = Database::run('SELECT * FROM '. self::$table .' WHERE status = ? ', ['1']);

            foreach($vacancy as $vac){

                array_push($vacancyAll,

                new Vacancy(
                    $vac['id'],
                    $vac['sender_name'],
                    $vac['sender_id'],
                    $vac['email'],
                    $vac['company'],
                    $vac['phone'],
                    $vac['vacancy'],
                    $vac['salary_min'],
                    $vac['salary_max'],
                    $vac['exp'],
                    $vac['location'],
                    $vac['schedule'],
                    $vac['industry'],
                    $vac['demands'],
                    $vac['duties'],
                    $vac['conditions'],
                    $vac['description'],
                    $vac['status'],
                    $vac['date']
                ));

            }

            return $vacancyAll;

        }

        public static function getMaxSalary(){

            self::applyConfig();
            
            $res = Database::run('SELECT MAX(salary_max) as MAX FROM '. self::$table.
                                ' WHERE status= ?', ['1']);

            return $res[0]['MAX'];

        }

        public static function getMinSalary(){

            self::applyConfig();
            
            $res = Database::run('SELECT MIN(salary_min) as MIN FROM '. self::$table.
                                ' WHERE status=? ', ['1']);

            return $res[0]['MIN'];

        }

        public function create(){

            $this->validate();

            $query = Database::run('INSERT INTO 
            '. self::$table .'(
                sender_name, 
                sender_id, 
                company, 
                phone, 
                vacancy, 
                salary_min, 
                salary_max, 
                exp, 
                location, 
                schedule, 
                industry, 
                description,
                demands, 
                duties, 
                conditions, 
                email
            ) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
            [
                $this->senderName,
                $this->senderId,
                $this->company,
                $this->phone,
                $this->vacancyName,
                $this->salaryMin,
                $this->salaryMax,
                $this->experience,
                $this->location,
                $this->scheduleId,
                $this->industryId,
                $this->description,
                $this->demands,
                $this->duties,
                $this->conditions,
                $this->email
            ]);

            $this->id = Database::lastInsertId();

            return $query;

        }

        public function update(){

            $this->validate();

            return Database::run(
                    'UPDATE '. self::$table .' SET 
                    company =  ?,
                    phone = ?,
                    vacancy = ?,
                    salary_min = ?,
                    salary_max = ?,
                    exp = ?,
                    location = ?,
                    schedule = ?,
                    industry = ?,
                    description = ?,
                    demands = ?,
                    duties = ?,
                    conditions = ?,
                    email = ?
                    WHERE sender_id = ? AND id = ?', 
                    [
                        $this->company,
                        $this->phone,
                        $this->vacancyName,
                        $this->salaryMin,
                        $this->salaryMax,
                        $this->experience,
                        $this->location,
                        $this->scheduleId,
                        $this->industryId,
                        $this->description,
                        $this->demands,
                        $this->duties,
                        $this->conditions,
                        $this->email,
                        $this->senderId,
                        $this->id
                    ]);

        }

        public function delete(){

            $query = Database::run('DELETE FROM '. self::$table .' WHERE sender_id = ? AND id = ?', [$this->senderId, $this->id]);

            $this->reset();
            
            return $query;

        }

        protected function validate(){

            $REGEXP_email = '/(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ui';
            $REGEXP_phone = '/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/ui';
            $REGEXP_exp = '/(^\d+[-]*\d+$)|(^\d+$)/ui';
            $REGEXP_company = '/^[A-zА-яЁё\"\s?]{5,}$/ui';
            $REGEXP_sentence = '/^[A-zА-яЁё0-9\(\)\-\.,!\:\"\s?]{5,}$/ui';
            $REGEXP_city = '/^[A-zА-яЁё\-\"\s?]{4,}$/ui';
            $regexp_numbers = '/^[\d]{1,}$/ui';
                    
            if(is_null($this->senderName) || $this->senderName === ''){
                throw new Exception('senderName');
            }

            if(is_null($this->senderId) || $this->senderId === ''){
                throw new Exception('senderId');
            }

            if(is_null($this->company) || $this->company === ''){
                throw new Exception('company');
            }

            if(is_null($this->phone) || $this->phone === ''){
                throw new Exception('phone');
            }

            if(is_null($this->vacancyName) || $this->vacancyName === ''){
                throw new Exception('vacancyName');
            }

            if(is_null($this->salaryMin) || $this->salaryMin === ''){
                throw new Exception('salaryMin');
            }

            if(is_null($this->salaryMax) || $this->salaryMax === ''){
                throw new Exception('salaryMax');
            }

            if(is_null($this->experience) || $this->experience === ''){
                throw new Exception('experience');
            }

            if(is_null($this->location) || $this->location === ''){
                throw new Exception('location');
            }

            if(is_null($this->scheduleId) || $this->scheduleId === ''){
                throw new Exception('scheduleId');
            }

            if(is_null($this->industryId) || $this->industryId === ''){
                throw new Exception('industryId');
            }

            if(is_null($this->demands) || $this->demands === ''){
                throw new Exception('demands');
            }

            if(is_null($this->duties) || $this->duties === ''){
                throw new Exception('duties');
            }

            if(is_null($this->conditions) || $this->conditions === ''){
                throw new Exception('conditions');
            }

            if(is_null($this->email) || $this->email === ''){
                throw new Exception('email');
            }
                        
            if(!preg_match($regexp_numbers, $this->senderId)){
                throw new Exception('senderId');
            }
                        
            if(!preg_match($REGEXP_company, $this->company)){
                throw new Exception('company');
            }
            
            if(!preg_match($REGEXP_phone, $this->phone)){
                throw new Exception('phone');
            }
            
            if(!preg_match($REGEXP_company, $this->vacancyName)){
                throw new Exception('vacancyName');
            }

            if(!preg_match($regexp_numbers, $this->salaryMin)){
                throw new Exception('salaryMin');
            }

            if(!preg_match($regexp_numbers, $this->salaryMax)){
                throw new Exception('salaryMax');
            }

            if(!preg_match($REGEXP_exp, $this->experience)){
                throw new Exception('experience');
            }

            if(!preg_match($REGEXP_city, $this->location)){
                throw new Exception('location');
            }

            if(!is_null($this->description) && !preg_match($REGEXP_company, $this->description)){
                throw new Exception('description');
            }

        }

        private static function getFilteredSQL(){
                        
            $sort = 'date';
            $salary = '';
            $industry = '';
            $location = '';
            $time = '';
            $schedule = '';        
            $query = '';
        
        
            if($_GET['sort'] && $_GET['sort'] == 'salary'){
                $sort = 'salary_min';
            } 
        
            if($_GET['time']){
                if($_GET['time'] == '1'){
                    $time = ' AND date >= ( CURDATE() - INTERVAL 1 DAY )';
                } else if($_GET['time'] == '3'){
                    $time = ' AND date >= ( CURDATE() - INTERVAL 3 DAY )';
                } else if($_GET['time'] == '7'){
                    $time = ' AND date >= ( CURDATE() - INTERVAL 7 DAY )';
                } else if($_GET['time'] == '30'){
                    $time = ' AND date >= ( CURDATE() - INTERVAL 30 DAY )';
                } else {
                    $time =  '';
                }
            }
        
            if($_GET['salary']){
                if($_GET['salary'] == '-1'){
                    $salary = '';
                } else{
                    $salary = ' AND `salary_min` >='.$_GET['salary'];
                } 
            }
        
            if($_GET['industry']){
                if($_GET['industry'] == '-1'){
                    $industry = '';
                } else{
                    $industry = ' AND `industry`='.$_GET['industry'];
                } 
            }
        
            if($_GET['schedule']){
                if($_GET['schedule'] == '-1'){
                    $schedule = '';
                } else{
                    $schedule = ' AND `schedule`='.$_GET['schedule'];
                } 
            }
        
            if($_GET['location']){
                if($_GET['location'] == '-1'){
                    $location = '';
                } else{
                    $location = ' AND `location`="'.$_GET['location'].'"';
                } 
            }
        
            if($_GET['query']){
                $query = " AND 
                        `vacancy` LIKE '%".$_GET['query']."%' 
                        OR 
                        `description` LIKE '%".$_GET['query']."%'
                        ";
            }
        
            $sql = '
                SELECT 
                '. self::$table .'.*,
                help_schedule.schedule_name
                FROM '. self::$table .' 
                LEFT JOIN help_schedule ON '. self::$table .'.schedule = help_schedule.id
                WHERE status="1"
                '.$salary.'
                '.$industry.'
                '.$location.'
                '.$time.'
                '.$schedule.'
                '.$query.'
                ORDER BY '.$sort.' DESC
            ';

            return $sql;

        }

    }