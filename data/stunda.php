<?php
    class Stunda{
        private $id;
        private $nosaukums;
        
        public function setID(int $id){
            $this->id = $id;
        }
        
        public function getID(){
            return $this->id;
        }
        
        public function setNosaukums(int $nosaukums){
            $this->nosaukums = $nosaukums;
        }
        
        public function getNosaukums():int{
            return $this->nosaukums;
        }
    }
?>