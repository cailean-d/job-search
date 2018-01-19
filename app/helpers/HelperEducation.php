<?php

    require_once __DIR__.'/../core/Database.php';
    require_once __DIR__.'/../core/Model.php';

    final class HelperEducation extends Model {

        private $name;

        public function __construct($id = null, $name = null){

            self::applyConfig();

            $this->id = htmlspecialchars(trim($id));
            $this->name = htmlspecialchars(trim($name));

        }

        public function getName(){

            return $this->name;

        }

        public function setName($name){
            
            $this->name = htmlspecialchars(trim($name));
            return $this;

        }

        public function reset(){

            parent::reset();

            $this->name = null;

        }

        public static function get($id){

            self::applyConfig();

            $schedule = Database::run('SELECT * FROM '. self::$table .' WHERE id = ? ', [$id]);

            return new HelperEducation(
                $schedule[0]['id'],
                $schedule[0]['education_name']
            );

        }

        public static function getAll(){

            self::applyConfig();

            $dataAll = array();

            $data = Database::run('SELECT * FROM '. self::$table);

            foreach($data as $d){

                array_push($dataAll,

                new HelperEducation(
                    $d['id'],
                    $d['education_name']
                ));

            }

            return $dataAll;

        }

        public function create(){

            $this->validate();

            $query = Database::run('INSERT INTO '. self::$table .' (education_name) VALUES (?)', 
            [$this->name]);

            $this->id = Database::lastInsertId();

            return $query;

        }

        public function update(){

            $this->validate();

            return Database::run('UPDATE '. self::$table .' SET education_name = ? WHERE id = ?', 
                    [
                        $this->name,
                        $this->id
                    ]);

        }

        public function delete(){

            $query = Database::run('DELETE FROM '. self::$table .' WHERE id = ?', [$this->id]);

            $this->reset();
            
            return $query;

        }

        protected function validate(){}

    }