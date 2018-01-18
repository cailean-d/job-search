<?php

    class View {

        private $title;
        private $view;
        private $folder;

        public function __construct($title, $view){

            $this->applyConfig();

            $this->title = $title;
            $this->view = $view;

        }

        public function getView(){
            return $this->view;
        }

        public function getFolder(){
            return $this->folder;
        }

        protected function access(){}

        public function render(){

            $this->access();

            $title = $this->title;
            $body = $this->folder.'/'.$this->view.'.php';
            
            include __DIR__.'/../../index.php';

        }

        private function applyConfig(){

            $path = require __DIR__.'/../config/paths.php';

            $this->folder = $path['view'];

        }

    } 