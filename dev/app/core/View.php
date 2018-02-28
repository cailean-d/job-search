<?php

    class View {

        private $title;
        private $view;
        private $folder;
        private $index;

        public function viewAccess(callable $callback = null){

            if(isset($callback)){

                $callback();

            }

        }

        public function __construct($title = null, $view = null){

            $this->applyConfig();

            $this->title = $title;
            $this->view = $view;

        }

        public function getView(){
            return $this->view;
        }

        public function getTitle(){
            return $this->title;
        }
        
        public function getFolder(){
            return $this->folder;
        }

        public function setView($view){
            $this->view = $view;
        }

        public function setTitle($title){
            $this->title = $title;
        }

        public function setIndex($index){
            $this->index = $index;
        }

        public function render(array $data = null, string $view = null){

            $this->viewAccess();

            $title = $this->title;
            $body = $this->folder.'/'.$this->view.'.php';

            if(!is_null($data)) {

                extract($data);
            
            }
            
            include $this->index;

        }

        private function applyConfig(){

            $path = require __DIR__.'/../config/paths.php';

            $this->folder = $path['view'];
            $this->index = $path['index'];

        }

    } 