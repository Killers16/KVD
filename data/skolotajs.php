<?php
    include_once('prieksmets.php');

    class Skolotajs{
        private $id;
        private $vards;
        private $uzvards;
        private $prieksmeti;
        
        public function __construct($vards, $uzvards){
            $this->vards = $vards;
            $this->uzvards = $uzvards;
            
            $this->prieksmeti = array();
        }
        
        public function setID(int $id){
            $this->id = $id;
        }
        
        public function setVards($vards){
            $this->vards = $vards;
        }
        
        public function setUzvards($uzvards){
            $this->uzvards = $uzvards;
        }
        
        public function getID(){
            return $this->id;
        }
        
        public function getVards(){
            return $this->vards;
        }
        
        public function getUzvards(){
            return $this->uzvards;
        }
        
        public function addPrieksmets(Prieksmets $prieksmets){
            array_push($prieksmeti, $prieksmets);
        }
        
        // izmantojot indeksu
        public function editPrieksmets($pos, $nosaukums){
            $prieksmeti[$pos]->setNosaukums($nosaukums);
        }
        
        // izmantojot veco vērtību
        public function editPrieksmetsByName(string $oNosaukums, string $nNosaukums){
            $id = 0;
            foreach($prieksmeti as $p){
                if($p->getNosaukums() == $oNosaukums){
                    break;
                } 
                
                $id++;
            }
            
            $prieksmeti[$id]->setNosaukums($nNosaukums);
        }
        
        public function deletePrieksmets(Prieksmets $prieksmets){
            $nosaukums = $prieksmets->getNosaukums();
            
            $id = 0;
            foreach($prieksmeti as $p){
                if($p->getNosaukums() == $nosaukums){
                    break;
                } 
                
                $id++;
            }
            
            // izdzēš vērtību no masīva
            unset($prieksmeti[$id]);
            
            // sakārto masīva indeksāciju
            $prieksmeti = array_values($prieksmeti);
        }
        
        public function printPrieksmeti(){
            foreach($prieksmeti as $p){
                echo $p->getNosaukums()."<br>";
            }
        }
    }
?>