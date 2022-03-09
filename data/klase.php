<?php
    include_once('skolotajs.php');

    class Klase{
        private $id;
        private $nosaukums;
        private $audzinatajs;
        
        public function __construct($nosaukums){
            $this->nosaukums = $nosaukums;
        }
        
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
        
        public function setAudzinatajs(Skolotajs $audzinatajs){
            $this->audzinatajs = $audzinatajs;
        }
        
        public function getAudzinatajs():Skolotajs{
            return $this->audzinatajs;
        }
    }
?>