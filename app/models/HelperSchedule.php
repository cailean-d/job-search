<?php

    require __DIR__.'/../core/Database.php';
    require __DIR__.'/../core/Model.php';

    final class HelperSchedule extends Model {

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

            return new HelperSchedule(
                $schedule[0]['id'],
                $schedule[0]['schedule_name']
            );

        }

        public static function getAll(){

            self::applyConfig();

            $scheduleAll = array();

            $schedule = Database::run('SELECT * FROM '. self::$table);

            foreach($schedule as $sch){

                array_push($scheduleAll,

                new HelperSchedule(
                    $sch['id'],
                    $sch['schedule_name']
                ));

            }

            return $scheduleAll;

        }

        public function create(){

            $this->validate();

            $query = Database::run('INSERT INTO '. self::$table .' (schedule_name) VALUES (?)', 
            [$this->name]);

            $this->id = Database::lastInsertId();

            return $query;

        }

        public function update(){

            $this->validate();

            return Database::run('UPDATE '. self::$table .' SET schedule_name = ? WHERE id = ?', 
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