<?php

    final class HelperWorkPlace extends Model {

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

            $data = Database::run('SELECT * FROM '. self::$table .' WHERE id = ? ', [$id]);

            return new HelperWorkPlace(
                $data[0]['id'],
                $data[0]['work_place_name']
            );

        }

        public static function getAll(){

            self::applyConfig();

            $dataAll = array();

            $data = Database::run('SELECT * FROM '. self::$table);

            foreach($data as $d){

                array_push($dataAll,

                new HelperWorkPlace(
                    $d['id'],
                    $d['work_place_name']
                ));

            }

            return $dataAll;

        }

        public function create(){

            $this->validate();

            $query = Database::run('INSERT INTO '. self::$table .' (work_place_name) VALUES (?)', 
            [$this->name]);

            $this->id = Database::lastInsertId();

            return $query;

        }

        public function update(){

            $this->validate();

            return Database::run('UPDATE '. self::$table .' SET work_place_name = ? WHERE id = ?', 
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