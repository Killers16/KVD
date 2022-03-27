<?php
    class PersCodes{
        private $id;
        private $codes;
        
        public function __construct($codes){
            $this->codes = $codes;
        }
        
        public function setID(int $id){
            $this->id = $id;
        }
        
        public function getID(){
            return $this->id;
        }
        
        public function setCodes($code){
            $this->codes = $codes;
        }
        
        public function getCodes(){
            return $this->codes;
        }
    }
?>