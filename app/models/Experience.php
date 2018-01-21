<?php

    require_once __DIR__.'/../core/Database.php';
    require_once __DIR__.'/../core/Model.php';

    final class Experience extends Model {

        private $userid;
        private $post;
        private $company;
        private $city;
        private $industryId;
        private $workPeriod;
        private $functions;

        private $industryName;

        public function __construct($id = null, $userid = null, $post = null, 
                                    $company = null, $city = null, $industryId = null, 
                                    $workPeriod = null, $functions = null, $industryName = null){

            self::applyConfig();

            $this->id = htmlspecialchars(trim($id));
            $this->userid = htmlspecialchars(trim($userid));
            $this->post = htmlspecialchars(trim($post));
            $this->company = htmlspecialchars(trim($company));
            $this->city = htmlspecialchars(trim($city));
            $this->industryId = htmlspecialchars(trim($industryId));
            $this->workPeriod = htmlspecialchars(trim($workPeriod));
            $this->functions = htmlspecialchars(trim($functions));
            $this->industryName = htmlspecialchars(trim($industryName));

        }

        public function getUserId(){
            return $this->userid;
        }

        public function getPost(){
            return $this->post;
        }

        public function getCompany(){
            return $this->company;
        }

        public function getCity(){
            return $this->city;
        }

        public function getIndustryId(){
            return $this->industryId;
        }

        public function getWorkPeriod(){
            return $this->workPeriod;
        }

        public function getFunctions(){
            return $this->functions;
        }

        public function getIndustryName(){
            return $this->industryName;
        }

        public function setUserId($userid){

            $this->userid = htmlspecialchars(trim($userid));
            return $this;

        }

        public function setPost($post){
            
            $this->post = htmlspecialchars(trim($post));
            return $this;

        }

        public function setCompany($company){

            $this->company = htmlspecialchars(trim($company));
            return $this;

        }

        public function setCity($city){
           
            $this->city = htmlspecialchars(trim($city));
            return $this;
        
        }

        public function setIndustryId($industryId){

            $this->industryId = htmlspecialchars(trim($industryId));
            return $this;

        }

        public function setWorkPeriod($workPeriod){

            $this->workPeriod = htmlspecialchars(trim($workPeriod));
            return $this;

        }

        public function setFunctions($functions){

            $this->functions = htmlspecialchars(trim($functions));
            return $this;
            
        }

        public function reset(){

            parent::reset();

            $this->userid = null;
            $this->post = null;
            $this->company = null;
            $this->city = null;
            $this->industryId = bull;
            $this->workPeriod = null;
            $this->functions = null;

        }

        public static function get($id){

            self::applyConfig();

            $experience = Database::run('SELECT * FROM '. self::$table .' WHERE id = ? ', [$id]);

            return new Experience(
                $experience[0]['id'],
                $experience[0]['user_id'],
                $experience[0]['post'],
                $experience[0]['company'],
                $experience[0]['city'],
                $experience[0]['industry_id'],
                $experience[0]['work_period'],
                $experience[0]['functions']
            );

        }

        public static function getByUserId($id){

            self::applyConfig();

            $experienceAll = array();

            $experience = Database::run('SELECT * FROM '. self::$table .' WHERE user_id = ? ', [$id]);

            foreach($experience as $exp){

                array_push($experienceAll,

                new Experience(
                    $exp['id'],
                    $exp['user_id'],
                    $exp['post'],
                    $exp['company'],
                    $exp['city'],
                    $exp['industry_id'],
                    $exp['work_period'],
                    $exp['functions']
                ));

            }

            return $experienceAll;

        }

        public static function getAll(){

            self::applyConfig();

            $experienceAll = array();

            $experience = Database::run('SELECT * FROM '. self::$table);

            foreach($experience as $exp){

                array_push($experienceAll,

                new Experience(
                    $exp['id'],
                    $exp['user_id'],
                    $exp['post'],
                    $exp['company'],
                    $exp['city'],
                    $exp['industry_id'],
                    $exp['work_period'],
                    $exp['functions']
                ));

            }

            return $experienceAll;

        }

        public static function getJoinedByUserid($id){
            
            self::applyConfig();

            $experienceAll = array();

            $experience = Database::run('
                SELECT 
                '. self::$table .'.*,
                help_industry.industry_name
                FROM '. self::$table .'
                LEFT JOIN help_industry ON '. self::$table .'.industry_id = help_industry.id
                WHERE user_id = ?', [$id]);

            foreach($experience as $exp){

                array_push($experienceAll,

                new Experience(
                    $exp['id'],
                    $exp['user_id'],
                    $exp['post'],
                    $exp['company'],
                    $exp['city'],
                    $exp['industry_id'],
                    $exp['work_period'],
                    $exp['functions'],
                    $exp['industry_name']
                ));

            }

            return $experienceAll;

        }

        public function create(){

            $this->validate();

            $query = Database::run('INSERT INTO '. self::$table .'
            (user_id, post, company, city, industry_id, work_period, functions) 
            VALUES (?, ?, ?, ?, ?, ?, ?)', 
            [
                $this->userid,
                $this->post,
                $this->company,
                $this->city,
                $this->industryId,
                $this->workPeriod,
                $this->functions
            ]);

            $this->id = Database::lastInsertId();

            return $query;

        }

        public function update(){

            $this->validate();

            return Database::run(
                    'UPDATE '. self::$table .' SET 
                    post = ?,
                    company = ?,
                    city = ?,
                    industry_id = ?,
                    work_period = ?,
                    functions = ?
                    WHERE user_id = ? AND id = ?', 
                    [
                        $this->post,
                        $this->company,
                        $this->city,
                        $this->industryId,
                        $this->workPeriod,
                        $this->functions,
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
            $regexp_work_period = '/^[A-zА-яЁё]{3,8}\s[\d]{4}\s\-\s[A-zА-яЁё]{3,8}\s[\d]{4}$/u';
    
            if(is_null($this->userid) || $this->userid === ''){
                throw new Exception('userid');
            }

            if(is_null($this->post) || $this->post === ''){
                throw new Exception('post');
            }

            if(is_null($this->company) || $this->company === ''){
                throw new Exception('company');
            }

            if(is_null($this->city) || $this->city === ''){
                throw new Exception('city');
            }

            if(is_null($this->industryId) || $this->industryId === ''){
                throw new Exception('industryId');
            }

            if(is_null($this->workPeriod) || $this->workPeriod === ''){
                throw new Exception('workPeriod');
            }

            if(is_null($this->functions) || $this->functions === ''){
                throw new Exception('functions');
            }
            
            if(!preg_match($regexp_numbers, $this->userid)){
                throw new Exception('userid');
            }

            if(!preg_match($regexp_sentence, $this->post)){
                throw new Exception('post');
            }

            if(!preg_match($regexp_sentence, $this->company)){
                throw new Exception('company');
            }

            if(!preg_match($regexp_city, $this->city)){
                throw new Exception('city');
            }

            if(!preg_match($regexp_numbers, $this->industryId)){
                throw new Exception('industryId');
            }

            if(!preg_match($regexp_work_period, $this->workPeriod)){
                throw new Exception('workPeriod');
            }

            if(!preg_match($regexp_sentence, $this->functions)){
                throw new Exception('functions');
            }

        }

    }