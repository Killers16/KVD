<?php
    class KlaseService{
        private $klase;
        
        private $table = "klases";
        
        public function insertKlase($conn, $nos, Skolotajs $audzinatajs){
            $klaseExists = false;
            $klases = $this->getAllKlases($conn);
            foreach($klases as $k){
                $nosaukums = $k->getNosaukums();
                
                if($nosaukums == $nos){
                    $klaseExists = true;
                    break;
                }
            }
            
            if(!$klaseExists){
                $sql = "INSERT INTO ".$this->table."(nosaukums) VALUES ('$nos')";
                                                               
                if($audzinatajs != null){
                    $vards = $audzinatajs->getVards();
                    $uzvards = $audzinatajs->getUzvards();

                    $skolotajsService = new SkolotajsService();

                    $audzinatajsID = $skolotajsService->getSkolotajsID($conn, $vards, $uzvards);

                    $sql = "INSERT INTO ".$this->table."(nosaukums, audzinatajs_id) VALUES ('$nos', $audzinatajsID)"; 
                }

                $isInserted = $conn->query($sql);

                if($isInserted){
                    return "<br> New Kabinets is added in system!";
                }
                else{
                    return "<br> Insertation process has failed!";
                }
            }
            else{
                return "<br> Kurss $nos already exist in DB!";
            }
        }
        public function updateKlase($conn, $id, $newNos, $vards, $uzvards){
            $skolotajsService = new SkolotajsService();
            $audzID = $skolotajsService->getSkolotajsID($conn, $vards, $uzvards);
            
            $sql = "UPDATE ".$this->table." SET nosaukums = '$newNos', audzinatajs_id = $audzID WHERE id_klase = $id";
            
            $isUpdated = $conn->query($sql);
            
            if($isUpdated){
                return "<br> Klase is updated!";
            }
            else{
                return "<br> Update process has failed!";
            }
        }
        
        public function updateKlaseNos($conn, $id, $newNos){
            $sql = "UPDATE ".$this->table." SET nosaukums = '$newNos' WHERE id_klase = $id";
            
            $isUpdated = $conn->query($sql);
            
            if($isUpdated){
                return "<br> Klase is updated!";
            }
            else{
                return "<br> Update process has failed!";
            }
        }
        
        public function updateKlaseAudz($conn, $id, $vards, $uzvards){
            $skolotajsService = new SkolotajsService();
            $audzID = $skolotajsService->getSkolotajsID($conn, $vards, $uzvards);
            
            $sql = "UPDATE ".$this->table." SET audzinatajs_id = $audzID WHERE id_klase = $id";
            
            $isUpdated = $conn->query($sql);
            
            if($isUpdated){
                return "<br> Klase is updated!";
            }
            else{
                return "<br> Update process has failed!";
            }
        }
        
        public function deleteKlase($conn, $id){
            $sql = "DELETE FROM ".$this->table." WHERE id_klase = $id";
            
            $isDeleted = $conn->query($sql);
            
            if($isDeleted){
                return "<br> Klase is deleted!";
            }
            else{
                return "<br> Delete process has failed!";
            }
        }
        
        public function getKlaseID($conn, $nos):int{
            $sql = "SELECT id_klase FROM ".$this->table." WHERE nosaukums = '$nos'";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['id_klase'];
            
            return $id;
        }
        
        public function getKlaseByID($conn, $id):Klase{
            $sql = "SELECT nosaukums, audzinatajs_id FROM ".$this->table." WHERE id_klase = $id";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $nos = $row['nosaukums'];
            $audzinatajsID = $row['audzinatajs_id'];
            
            $this->klase = new Klase($nos);
            
            if($audzinatajsID != null){
                $skolotajsService = new SkolotajsService();
                
                $audzinatajs = $skolotajsService->getSkolotajsByID($conn, $audzinatajsID);
                
                $this->klase->setAudzinatajs($audzinatajs);
            }
            
            return $this->klase;
        }
        
        public function getKlaseByAudz($conn, Skolotajs $audzinatajs):array{
            $vards = $audzinatajs->getVards();
            $uzvards = $audzinatajs->getUzvards();
            
            // SQL ar INNER JOIN
            $sql = "SELECT nosaukums FROM ".$this->table." k INNER JOIN skolotaji s ON s.id_skolotajs = k.audzinatajs_id WHERE s.vards = '$vards' AND s.uzvards = '$uzvards'";
            
            $klases = array();
            
            $result = $conn->query($sql);
            while($row = $result->fetch_object()){
                $nos = $row->nosaukums;
                
                $this->klase = new Klase($nos);
                $this->klase->setAudzinatajs($audzinatajs);
                
                array_push($klases, $this->klases);
            }
            
            return $klases;
        }
        
        public function getAllKlases($conn):array{
            $sql = "SELECT * FROM ".$this->table;
            
            $klases = array();
            
            $result = $conn->query($sql);
            
            while($row = $result->fetch_object()){
                $id = $row->id_klase;
                $nos = $row->nosaukums;
                $audzinatajsID = $row->audzinatajs_id;
                
                $this->klase = new Klase($nos);
                $this->klase->setID($id);
                
                if($audzinatajsID != null){
                    $skolotajsService = new SkolotajsService();

                    $audzinatajs = $skolotajsService->getSkolotajsByID($conn, $audzinatajsID);

                    $this->klase->setAudzinatajs($audzinatajs);
                }
                
                array_push($klases, $this->klase);
            }
            
            return $klases;
        }
    }
?>