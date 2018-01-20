<?php

    class View {

        private $title;
        private $view;
        private $folder;

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

        public function setView($view){
            $this->view = $view;
        }

        public function setTitle($title){
            $this->title = $title;
        }

        public function getFolder(){
            return $this->folder;
        }

        public function render(array $data = null){

            $this->viewAccess();

            $title = $this->title;
            $body = $this->folder.'/'.$this->view.'.php';

            if(!is_null($data)) {

                extract($data);
            
            }
            
            include __DIR__.'/../../public/index.php';

        }

        private function applyConfig(){

            $path = require __DIR__.'/../config/paths.php';

            $this->folder = $path['view'];

        }

    } 