<?php
    include_once('skolotajs.php');
    include_once('prieksmets.php');
    include_once('kabinets.php');
    include_once('klase.php');
    include_once('diena.php');
    include_once('stunda.php');

    class Nodarbiba{
        private $id;
        private $skolotajs;
        private $prieksmets;
        private $kabinets;
        private $klase;
        private $diena;
        private $stunda;
        
        public function __construct(Skolotajs $skolotajs, Prieksmets $prieksmets, int $diena, int $stunda, Klase $klase){
            $this->skolotajs = $skolotajs;
            $this->prieksmets = $prieksmets;
            $this->diena = $diena;
            $this->stunda = $stunda;
            $this->klase = $klase;
        }
        
        public function setID(int $id){
            $this->id = $id;
        }
        
        public function getID(){
            return $this->id;
        }
        
        public function setSkolotajs(Skolotajs $skolotajs){
            $this->skolotajs = $skolotajs;
        }
        
        public function getSkolotajs():Skolotajs{
            return $this->skolotajs;
        }
        
        public function setPrieksmets(Prieksmets $prieksmets){
            $this->prieksmets = $prieksmets;
        }
        
        public function getPrieksmets():Prieksmets{
            return $this->prieksmets;
        }
        
        public function setKlase(Klase $klase){
            $this->klase = $klase;
        }
        
        public function getKlase():Klase{
            return $this->klase;
        }
        
        public function setKabinets(Kabinets $kabinets){
            $this->kabinets = $kabinets;
        }
        
        public function getKabinets():Kabinets{
            return $this->kabinets;
        }
        
        public function setDiena(int $diena){
            $this->diena = $diena;
        }
        
        public function getDiena():int{
            return $this->diena;
        }
        
        public function setStunda(int $stunda){
            $this->stunda = $stunda;
        }
        
        public function getStunda():int{
            return $this->stunda;
        }
    }
?>