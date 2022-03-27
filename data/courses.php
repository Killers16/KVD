<?php
    include_once('students.php');

    class Courses{
        private $id;
        private $names;
       
        
        public function __construct($names){
            $this->names = $names;
        }
        
        public function setID(int $id){
            $this->id = $id;
        }
        
        public function getID(){
            return $this->id;
        }
        
        public function setNames($names){
            $this->names = $names;
        }
        
        public function getNames(){
            return $this->names;
        }
        
    }
?>