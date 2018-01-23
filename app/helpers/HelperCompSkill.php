<?php

    final class HelperCompSkill extends Model {

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

            return new HelperCompSkill(
                $data[0]['id'],
                $data[0]['cs_name']
            );

        }

        public static function getAll(){

            self::applyConfig();

            $dataAll = array();

            $data = Database::run('SELECT * FROM '. self::$table);

            foreach($data as $d){

                array_push($dataAll,

                new HelperCompSkill(
                    $d['id'],
                    $d['cs_name']
                ));

            }

            return $dataAll;

        }

        public function create(){

            $this->validate();

            $query = Database::run('INSERT INTO '. self::$table .' (cs_name) VALUES (?)', 
            [$this->name]);

            $this->id = Database::lastInsertId();

            return $query;

        }

        public function update(){

            $this->validate();

            return Database::run('UPDATE '. self::$table .' SET cs_name = ? WHERE id = ?', 
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