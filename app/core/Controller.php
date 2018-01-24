<?php 

        class Controller {

        protected $view;
        protected $data = array();

        public function __construct($routerVars){

            $this->view = new View();

            $this->setRouterVariables($routerVars);
            
            $this->data['user']['id'] = $_SESSION['id'];
            $this->data['user']['authorized'] = $_SESSION['authorized'];
            $this->data['user']['firstname'] = $_SESSION['firstname'];
            $this->data['user']['lastname'] = $_SESSION['lastname'];
            $this->data['user']['type'] = $_SESSION['type'];

            $this->data['own_avatar'] = Avatar::get($this->data['user']['id']);

            $this->setAccess();

        }

        protected function setRouterVariables(array $routerVars){
            
            if($routerVars){

                foreach ($routerVars as $key => $value) {
                    
                    $this->data[$key] = $value;

                }

            }
            
        }

        protected function getId(){

            if(isset($this->data['router']['id'])){

                return $this->data['router']['id'];

            } else {

                return $_SESSION['id'];

            }

        }

        protected function setAccess(){}

        public function render(){

            $this->view->render($this->data);

        }

    }