<?php
    include_once('skolotajs.php');

    class Prieksmets{
        private $id;
        private $nosaukums;
        private $skolotaji;
        
        public function __construct($nosaukums){
            $this->nosaukums = $nosaukums;
            
            $this->skolotaji = array();
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
        
        public function addSkolotajs(Skolotajs $skolotajs){
            array_push($skolotaji, $skolotajs);
        }
        
        // izmantojot indeksu
        public function editSkolotajs($pos, $vards, $uzvards){
            $skolotaji[$pos]->setVards($vards);
            $skolotaji[$pos]->setUzvards($uzvards);
        }
        
        public function editSkolotajsByValues($pos, $value, bool $changeName){
            if($changeName){
                $skolotaji[$pos]->setVards($value);
            }
            else{
                $skolotaji[$pos]->setUzvards($nUzvards);
            }
        }
        
        public function deleteSkolotajs(Skolotajs $skolotajs){
            $vards = $skolotajs->getVards();
            $uzvards = $skolotajs->getUzvards();
            
            $id = 0;
            foreach($skolotaji as $s){
                if($s->getVards() == $vards && $s->getUzvards() == $uzvards){
                    break;
                } 
                
                $id++;
            }
            
            // izdzēš vērtību no masīva
            unset($skolotaji[$id]);
            
            // sakārto masīva indeksāciju
            $skolotaji = array_values($skolotaji);
        }
        
        public function printSkolotaji(){
            foreach($skolotaji as $s){
                echo $s->getVards()." ".$s->getUzvards()."<br>";
            }
        }
    }
?>