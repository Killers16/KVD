<?php


    class Remarks{
        private $id;
        private $Rnames;
        private $firstName;
        private $lastName;
        
        public function __construct($firstName,$lastName,$Rnames){
            
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->Rnames = $Rnames;
        }
        
        public function setID(int $id){
            $this->id = $id;
        }
        
        public function getID(){
            return $this->id;
        }
        
        public function setRnames($Rnames){
            $this->Rnames = $Rnames;
        }
        
        public function getRnames(){
            return $this->Rnames;
        }
        
        public function getFirstName()
        {
                return $this->firstName;
        }

        public function setFirstName($firstName)
        {
                $this->firstName = $firstName;

                return $this;
        }

 
        public function getLastName()
        {
                return $this->lastName;
        }


        public function setLastName($lastName)
        {
                $this->lastName = $lastName;

                return $this;
        }
    }
?>