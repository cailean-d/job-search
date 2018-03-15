<?php

    final class VacancyMistakes extends Model {

        private $vacancyId;
        private $description;

        public function __construct($id = null, $vacancyId = null, $description = null){

            self::applyConfig();

            $this->id = htmlspecialchars(trim($id));
            $this->vacancyId = htmlspecialchars(trim($vacancyId));
            $this->description = htmlspecialchars(trim($description));

        }

        public function getVacancyId(){

            return $this->vacancyId;

        }

        public function setVacancyId($vacancyId){
            
            $this->vacancyId = htmlspecialchars(trim($vacancyId));
            return $this;

        }

        public function getDescription(){

            return $this->description;

        }

        public function setDescription($desc){
            
            $this->description = htmlspecialchars(trim($desc));
            return $this;

        }

        public function reset(){

            parent::reset();

            $this->vacancyId = null;
            $this->description = null;

        }

        public static function get($id){

            self::applyConfig();

            $data = Database::run('SELECT * FROM '. self::$table .' WHERE id = ? ', [$id]);

            return new VacancyMistakes(
                $data[0]['id'],
                $data[0]['vacancy_id'],
                $data[0]['description']
            );

        }

        public static function getAll(){

            self::applyConfig();

            $dataAll = array();

            $data = Database::run('SELECT * FROM '. self::$table);

            foreach($data as $d){

                array_push($dataAll,

                new HelperCompSkill(
                    $data[0]['id'],
                    $data[0]['vacancy_id'],
                    $data[0]['description']
                ));

            }

            return $dataAll;

        }

        public static function getByVacancyId($id){
            
            self::applyConfig();

            $data = Database::run('SELECT * FROM '. self::$table .' WHERE vacancy_id = ? ', [$id]);

            return new VacancyMistakes(
                $data[0]['id'],
                $data[0]['vacancy_id'],
                $data[0]['description']
            );

        }

        public function create(){

            $this->validate();

            $query = Database::run('INSERT INTO '. self::$table .' (vacancy_id, description) VALUES (?, ?)', 
            [$this->vacancyId, $this->description]);

            $this->id = Database::lastInsertId();

            return $query;

        }

        public function update(){

            $this->validate();

            return Database::run('UPDATE '. self::$table .' SET vacancy_id = ?, description = ? WHERE id = ?', 
                    [
                        $this->vacancyId,
                        $this->description,
                        $this->id
                    ]);

        }

        public function delete(){

            $query = Database::run('DELETE FROM '. self::$table .' WHERE id = ?', [$this->id]);

            $this->reset();
            
            return $query;

        }

        protected function validate(){

            $regexp_sentence = '/^[A-zА-яЁё0-9\(\)\-\.,!\:\"\s?]{5,}$/ui';
            $regexp_numbers = '/^[\d]{1,}$/ui';
            
            if(is_null($this->vacancyId) || $this->vacancyId === ''){
                throw new Exception('vacancy_id');
            }

            if(is_null($this->description) || $this->description === ''){
                throw new Exception('description');
            }

            if(!preg_match($regexp_numbers, $this->vacancyId)){
                throw new Exception('vacancy_id');
            }
            
            if(!preg_match($regexp_sentence, $this->description)){
                throw new Exception('description');
            }
        }

    }