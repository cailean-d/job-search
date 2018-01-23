<?php

    final class Language extends Model {

        private $userid;
        private $langId;
        private $langLevel;

        private $langName;

        public function __construct($id = null, $userid = null, 
                                    $langId = null, $langLevel = null, $langName = null){

            self::applyConfig();

            $this->id = htmlspecialchars(trim($id));
            $this->userid = htmlspecialchars(trim($userid));
            $this->langId = htmlspecialchars(trim($langId));
            $this->langLevel = htmlspecialchars(trim($langLevel));
            $this->langName = htmlspecialchars(trim($langName));

        }

        public function getUserid(){
            return $this->userid;
        }

        public function getLangId(){
            return $this->langId;
        }

        public function getLangLevel(){
            return $this->langLevel;
        }

        public function getLangName(){
            return $this->langName;
        }

        public function setUserid($userid){

            $this->userid = htmlspecialchars(trim($userid));
            return $this;

        }

        public function setLangId($langId){

            $this->langId = htmlspecialchars(trim($langId));
            return $this;

        }

        public function setLangLevel($langLevel){

            $this->langLevel = htmlspecialchars(trim($langLevel));
            return $this;
            
        }

        public function reset(){

            parent::reset();

            $this->userid = null;
            $this->langId = null;
            $this->langLevel = null;

        }

        public static function get($id){

            self::applyConfig();

            $lang = Database::run('SELECT * FROM '. self::$table .' WHERE id = ? ', [$id]);

            return new Language(
                $lang[0]['id'],
                $lang[0]['user_id'],
                $lang[0]['lang_id'],
                $lang[0]['lang_level']
            );

        }

        public static function getByUserId($id){

            self::applyConfig();

            $languageAll = array();

            $language = Database::run('SELECT * FROM '. self::$table .' WHERE user_id = ? ', [$id]);

            foreach($language as $lang){

                array_push($languageAll,

                new Language(
                    $lang['id'],
                    $lang['user_id'],
                    $lang['lang_id'],
                    $lang['lang_level']
                ));

            }

            return $languageAll;

        }

        public static function getAll(){

            self::applyConfig();

            $languageAll = array();

            $language = Database::run('SELECT * FROM '. self::$table);

            foreach($language as $lang){

                array_push($languageAll,

                new Language(
                    $lang['id'],
                    $lang['user_id'],
                    $lang['lang_id'],
                    $lang['lang_level']
                ));

            }

            return $languageAll;

        }

        public static function getJoinedByUserid($id){

            self::applyConfig();

            $languageAll = array();

            $language = Database::run('
                        SELECT 
                        '. self::$table .'.*,
                        help_languages.lang_name
                        FROM '. self::$table .'
                        LEFT JOIN help_languages ON '. self::$table .'.lang_id = help_languages.id
                        WHERE user_id = ?', [$id]);

            foreach($language as $lang){

                array_push($languageAll,

                new Language(
                    $lang['id'],
                    $lang['user_id'],
                    $lang['lang_id'],
                    $lang['lang_level'],
                    $lang['lang_name']
                ));

            }

            return $languageAll;

        }

        public function create(){

            $this->validate();

            $query = Database::run('INSERT INTO '. self::$table .' (user_id,lang_id,lang_level) 
            VALUES (?,?,?)', 
            [
                $this->userid,
                $this->langId,
                $this->langLevel
            ]);

            $this->id = Database::lastInsertId();

            return $query;

        }

        public function update(){

            $this->validate();

            return Database::run(
                    'UPDATE '. self::$table .' SET 
                    lang_id = ?,
                    lang_level = ?
                    WHERE user_id = ? AND id = ?', 
                    [
                        $this->langId,
                        $this->langLevel,
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

            $regexp_numbers = '/^[\d]{1,}$/ui';

            if(is_null($this->userid) || $this->userid === ''){
                throw new Exception('userid');
            }

            if(is_null($this->langId) || $this->langId === ''){
                throw new Exception('langId');
            }

            if(is_null($this->langLevel) || $this->langLevel === ''){
                throw new Exception('langLevel');
            }
    
            if(!preg_match($regexp_numbers, $this->userid)){
                throw new Exception('userid');
            }
    
            if(!preg_match($regexp_numbers, $this->langId)){
                throw new Exception('langId');
            }

            if(
                $this->langLevel != "Не владею" &&
                $this->langLevel != "Базовый" &&
                $this->langLevel != "Технический" &&
                $this->langLevel != "Разговорный" &&
                $this->langLevel != "Свободно владею"
                ){
                throw new Exception('langLevel');
            }

        }

    }