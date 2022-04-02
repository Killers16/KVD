<?php
 

    class Students{
        private $id;
        private $firstName;
        private $lastName;
        private $codes;
        private $years;

        public function __construct($firstName, $lastName,$codes,$years){
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->codes = $codes;
            $this->years = $years;
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
       
        public function getCodes()
        {
                return $this->codes;
        }

       
        public function setCodes($codes)
        {
                $this->codes = $codes;

                return $this;
        }

    
        public function getYears()
        {
                return $this->years;
        }

     
        public function setYears($years)
        {
                $this->years = $years;

                return $this;
        }
    }
?>