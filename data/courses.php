<?php


    class Courses{
        private $id;
        private $Cnames;
       
        
        public function __construct($Cnames){
            $this->Cnames = $Cnames;
        }
        
        public function setID(int $id){
            $this->id = $id;
        }
        
        public function getID(){
            return $this->id;
        }
        
        public function setNames($Cnames){
            $this->Cnames = $Cnames;
        }
        
        public function getNames(){
            return $this->Cnames;
        }
        
    }
?>