<?php
    class Diena{
        private $id;
        private $nosaukums;
        
        public function setID(int $id){
            $this->id = $id;
        }
        
        public function getID(){
            return $this->id;
        }
        
        public function setNosaukums($nosaukums){
            $this->nosaukums = $nosaukums;
        }
        
        public function getNosaukums(){
            return $this->nosaukums;
        }
    }
?>