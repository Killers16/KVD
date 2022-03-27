<?php
 

    class Students{
        private $id;
        private $firstName;
        private $lastName;
       

        public function __construct($firstName, $lastName){
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            
        }
        
        public function setID(int $id){
            $this->id = $id;
        }

        public function getID(){
            return $this->id;
        }
        
        public function setFirstName($firstName){
            $this->firstName = $firstName;
        }
        public function getFirstName(){
            return $this->firstName;
        }
        
        public function setLastName($lastName){
            $this->lastName = $lastName;
        }
        
        public function getLastName(){
            return $this->lastName;
        }
       
    }
?>