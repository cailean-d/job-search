<?php

    abstract class Model {

        protected static $table;

        protected $id;
        
        abstract public static function get($id);
        
        abstract public static function getAll();

        abstract public function create();

        abstract public function update();

        abstract public function delete();

        abstract protected function validate();

        public function getId(){

            return $this->id;

        }

        public function setId($id){

            $this->id = htmlspecialchars(trim($id));
            return $this;

        }

        public static function getTable(){

            return self::$table;

        }

        protected function reset(){

            $this->id = null;

        }

        public function save(){

            $object = $this::get($this->id);

            if($object->getId() === '' || is_null($object->getId())){

                $this->create();

            } else {

                $this->update();

            }
        }

        protected function applyConfig(){
            
            $table = require __DIR__.'/../config/database_tables.php';

            $thisClass = strtolower(static::class);

            self::$table = $table[$thisClass];

        }

    }