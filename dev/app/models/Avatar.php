<?php 

    final class Avatar extends Model{

        private static $folder;

        private $userid;
        private $source;
        private $file;

        public function __construct($id = null, $userid = null, $source = null, $file = null){

            self::applyConfig();

            $this->id = htmlspecialchars(trim($id));
            $this->userid = htmlspecialchars(trim($userid));
            $this->source = htmlspecialchars(trim($source));
            $this->file = htmlspecialchars(trim($file));

        }

        public function getUserid(){

            return $this->userid;

        }

        public function getSource(){

            return $this->source;

        }

        public function setUserid($userid){

            $this->userid = $userid;

        }

        public function setSource($source){

            $this->source = $source;

        }

        public function setFile($file){

            $this->file = $file;

        }

        public function reset(){

            parent::reset();

            $this->id = null;
            $this->userid = null;
            $this->source = null;

        }

        public static function get($id){
           
            self::applyConfig();

            $avatar = Database::run('SELECT * FROM '. self::$table .' WHERE user_id = ? ', [$id]);

            return new Avatar(
                $avatar[0]['id'],
                $avatar[0]['user_id'],
                $avatar[0]['source']
            );

        }

        public static function getAll(){

            self::applyConfig();

            $dataAll = array();

            $data = Database::run('SELECT * FROM '. self::$table);

            foreach($data as $d){

                array_push($dataAll,

                new Avatar(
                    $d['id'],
                    $d['user_id'],
                    $d['source']
                ));

            }

            return $dataAll;

        }

        public function create(){

            $this->validate();

            $this->saveFile();

            $query = Database::run('INSERT INTO '. self::$table .'(user_id, source) VALUES (?, ?)', 
            [
                $this->userid,
                $this->source
            ]);

            $this->id = Database::lastInsertId();

            return $query;

        }

        public function update(){

            $this->validate();

            $this->saveFile();

            return Database::run('UPDATE '. self::$table .' SET source = ? WHERE user_id = ?', 
            [$this->source, $this->id]);

        }

        public function delete(){

            $query = Database::run('DELETE FROM '. self::$table .' WHERE user_id = ? ', [$this->userid]);

            $this->reset();
            
            return $query;

        }

        protected function validate(){

            if(is_null($this->file) || is_null($this->file["tmp_name"])){
                throw new Exception('FILE_DOES_NOT_EXIST');
            }

            if($this->file['size'] > 1024*3*1024){
                throw new Exception('UPLOAD_MAX_FIZESIZE');
            }

            if(!is_uploaded_file($this->file['tmp_name'])){
                throw new Exception('UPLOAD_FILE_ERROR');
            } 

            if(is_null($this->userid) || $this->userid === ''){
                throw new Exception('USERID');
            }

        }

        protected function applyConfig(){

            parent::applyConfig();
            
            $folder = require __DIR__.'/../config/paths.php';

            self::$folder = $folder['avatar'];

        }

        protected function getFileExtension(){

            return substr($this->file["name"], strpos($this->file["name"], "."));

        }

        protected function saveFile(){

            $PROJECT_ROOT = __DIR__.'/../../';
            $dir = $PROJECT_ROOT . self::$folder . '/';
            $filename = uniqid().$this->getFileExtension();
            $path = $dir.$filename;

            move_uploaded_file($this->file["tmp_name"], $path);

            $this->setSource(self::$folder . '/' . $filename);
            
        }

    }