<?php 

        class Controller {

        protected $view;
        protected $data = array();

        public function __construct($routerVars, $misc = null){

            $this->view = new View();

            $this->setRouterVariables($routerVars);
            $this->additionalRouterVars($misc);
            
            $this->data['user']['id'] = $_SESSION['id'];
            $this->data['user']['authorized'] = $_SESSION['authorized'];
            $this->data['own_avatar'] = Avatar::get($_SESSION['id']);

            $this->setUserData();            
            $this->setAccess();

        }

        protected function setRouterVariables(array $routerVars){
            
            if($routerVars){

                foreach ($routerVars as $key => $value) {
                    
                    $this->data[$key] = $value;

                }

            }
            
        }

        protected function additionalRouterVars($data){

            if($data){

                foreach ($data as $key => $value) {

                    $this->data['router'][$key] = $value;
    
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

        private function setUserData(){

            $user = User::get($_SESSION['id']);

            $this->data['user']['firstname'] = $user->getFirstname();
            $this->data['user']['lastname'] = $user->getLastname();
            $this->data['user']['type'] = $user->getType();
            $this->data['user']['email'] = $user->getEmail();
            $this->data['user']['gender'] = $user->getGender();

        }

    }