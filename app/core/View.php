<?php

    class View {

        private $title;
        private $view;
        private $folder;

        protected function viewAccess(){}

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