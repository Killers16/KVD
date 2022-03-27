<?php
    class SpService{
        private $sp;
        private $table = "skolotaji_prieksmeti";
        
        private $skolotajsService, $prieksmetsService;
        
        public function insertSP($conn, $prNos, $vards, $uzvards){
            $skolotajsService = new SkolotajsService();
            $prieksmetsService = new PrieksmetsService();
            
            $skolotajsID = $skolotajsService->getSkolotajsID($conn, $vards, $uzvards);
            $prieksmetsID = $prieksmetsService->getPrieksmetsID($conn, $prNos);
            
            
            $sql = "INSERT INTO ".$this->table."(skolotajs_id, prieksmets_id) VALUES ($skolotajsID, $prieksmetsID)";
            
            $isInserted = $conn->query($sql);
            
            if($isInserted){
                return "<br> Skolotājs $uzvards $vards with Priekšmets $prNos is added in system!";
            }
            else{
                return "<br> Insertation process has failed!";
            }
        }
        
        public function getSpID($conn, $prNos, $vards, $uzvards):int{
            $skolotajsService = new SkolotajsService();
            $prieksmetsService = new PrieksmetsService();
            
            $skolotajsID = $skolotajsService->getSkolotajsID($conn, $vards, $uzvards);
            $prieksmetsID = $prieksmetsService->getPrieksmetsID($conn, $prNos);
            
            
            $sql = "SELECT id_sp FROM ".$this->table." WHERE skolotajs_id = $skolotajsID AND prieksmets_id = $prieksmetsID";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['id_sp'];
            
            return $id;
        }
        
        public function getSpByID($conn, $id):array{
            $rinda = array();
            
            $skolotajsService = new SkolotajsService();
            $prieksmetsService = new PrieksmetsService();
            
            $skolotajsID = $skolotajsService->getSkolotajsID($conn, $vards, $uzvards);
            $prieksmetsID = $prieksmetsService->getPrieksmetsID($conn, $prNos);
            
            
            $sql = "SELECT skolotajs_id, prieksmets_id FROM ".$this->table." WHERE id_sp = $id";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $skolotajsID = $row['skolotajs_id'];
            $prieksmetsID = $row['prieksmets_id'];
            
            $skolotajs = $skolotajsService->getSkolotajsByID($conn, $skolotajsID);
            $prieksmets = $prieksmetsService->getPrieksmetsByID($conn, $prieksmetsID);
            
            array_push($rinda, $skolotajs);
            array_push($rinda, $prieksmets);
            
            return $rinda;
        }
        
        public function getSkolotajiByPrieksmets($conn, $nos):array{
            $skolotaji = array();
            
            $skolotajsService = new SkolotajsService();
            $prieksmetsService = new PrieksmetsService();
            
            $prieksmetsID = $prieksmetsService->getPrieksmetsID($conn, $nos);
            
            $sql = "SELECT skolotajs_id FROM ".$this->table." WHERE prieksmets_id = $prieksmetsID";
            
            $result = $conn->query($sql);
            while($row = $result->fetch_object()){
                $skolotajsID = $row->skolotajs_id;
                $skolotajs = $skolotajsService->getSkolotajsByID($skolotajsID);
                
                array_push($skolotaji, $skolotajs);
            }
            
            return $skolotaji;
        }
        
        public function getPrieksmetiBySkolotajs($conn, $vards, $uzvards):array{
            $prieksmeti = array();
            
            $skolotajsService = new SkolotajsService();
            $prieksmetsService = new PrieksmetsService();
            
            $skolotajsID = $skolotajsService->getSkolotajsID($conn, $vards, $uzvards);
            
            $sql = "SELECT prieksmets_id FROM ".$this->table." WHERE skolotajs_id = $skolotajsID";
            
            $result = $conn->query($sql);
            while($row = $result->fetch_object()){
                $prieksmetsID = $row->skolotajs_id;
                $prieksmets = $skolotajsService->getSkolotajsByID($skolotajsID);
                
                array_push($prieksmeti, $prieksmets);
            }
            
            return $prieksmeti;
        }
        
        // Metode nepieciešamas priekš vaicājumiem NodarbibaService klasē
        public function getSpIdBySkolotajs($conn, $skolotajsID):array{
            $spIDs = array();
            
            $sql = "SELECT id_sp FROM ".$this->table." WHERE skolotajs_id = $skolotajsID";
            
            $result = $conn->query($sql);
            while($row = $result->fetch_object()){
                $spID = $row->id_sp;
                
                array_push($spIDs, $spID);
            }
            
            return $spIDs;
        }
        
        // Metode nepieciešamas priekš vaicājumiem NodarbibaService klasē
        public function getSpIdByPrieksmets($conn, $nos):array{
            $spIDs = array();
            
            $prieksmetsService = new PrieksmetsService();
            $prieksmetsID = $prieksmetsService->getPrieksmetsID($conn, $nos);
            
            $sql = "SELECT id_sp FROM ".$this->table." WHERE prieksmets_id = $prieksmetsID";
            
            $result = $conn->query($sql);
            while($row = $result->fetch_object()){
                $spID = $row->id_sp;
                
                array_push($spIDs, $spID);
            }
            
            return $spIDs;
        }
    }
?>