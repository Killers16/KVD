<?php
    class PrieksmetsService{
        private $prieksmets;
        
        private $table = "prieksmeti";
        
        public function insertPrieksmets($conn, $nos){
            $prieksmetsExists = false;
            $prieksmeti = $this->getAllPrieksmeti($conn);
            foreach($prieksmeti as $p){
                $nosaukums = $p->getNosaukums();
                
                if($nosaukums == $nos){
                    $prieksmetsExists = true;
                    break;
                }
            }
            
            if(!$prieksmetsExists){
               $sql = "INSERT INTO ".$this->table."(nosaukums) VALUES ('$nos')";
            
                $isInserted = $conn->query($sql);

                if($isInserted){
                    return "<br> Priekšmets $nos is added in system!";
                }
                else{
                    return "<br> Insertation process has failed!";
                } 
            }
            else{
                return "<br> Priekšmets $nos already exist in DB!";
            }
        }
        
        public function updatePrieksmets($conn, $id, $newNos){
            $sql = "UPDATE ".$this->table." SET nosaukums = '$newNos' WHERE id_prieksmets = $id";
            
            $isUpdated = $conn->query($sql);
            
            if($isUpdated){
                return "<br> Priekšmets is updated!";
            }
            else{
                return "<br> Update process has failed!";
            }
        }
        
        public function deletePrieksmets($conn, $id){
            $sql = "DELETE FROM ".$this->table." WHERE id_prieksmets = $id";
            
            $isDeleted = $conn->query($sql);
            
            if($isDeleted){
                return "<br> Priekšmets is deleted!";
            }
            else{
                return "<br> Delete process has failed!";
            }
        }
        
        public function getPrieksmetsID($conn, $nos):int{
            $sql = "SELECT id_prieksmets FROM ".$this->table." WHERE nosaukums = '$nos'";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['id_prieksmets'];
            
            return $id;
        }
        
        public function getPrieksmetsByID($conn, $id):Prieksmets{
            $sql = "SELECT nosaukums FROM ".$this->table." WHERE id_prieksmets = $id";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $nos = $row['nosaukums'];
            
            $this->prieksmets = new Prieksmets($nos);
            
            return $this->skolotajs;
        }
        
        public function getAllPrieksmeti($conn):array{
            $sql = "SELECT * FROM ".$this->table;
            
            $prieksmeti = array();
            
            $result = $conn->query($sql);
            
            while($row = $result->fetch_object()){
                $id = $row->id_prieksmets;
                $nos = $row->nosaukums;
                
                $this->prieksmets = new Prieksmets($nos);
                $this->prieksmets->setID($id);
                
                array_push($prieksmeti, $this->prieksmets);
            }
            
            return $prieksmeti;
        }
    }
?>