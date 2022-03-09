<?php
    class SkolotajsService{
        private $skolotajs;
        
        private $table = "skolotaji";
        
        public function insertSkolotajs($conn, $vards, $uzvards){
            $skolotajsExists = false;
            $skolotaji = $this->getAllSkolotaji($conn);
            foreach($skolotaji as $s){
                $fName = $s->getVards();
                $lName = $s->getUzvards();
                
                if($fName == $vards && $lName == $uzvards){
                    $skolotajsExists = true;
                    break;
                }
            }
            
            if(!$skolotajsExists){
                $sql = "INSERT INTO ".$this->table."(vards, uzvards) VALUES ('$vards', '$uzvards')";
                
                $isInserted = $conn->query($sql);
            
                if($isInserted){
                    return "<br> Skolotājs $uzvards $vards is added in system!";
                }
                else{
                    return "<br> Insertation process has failed!";
                }
            }
            else{
                return "<br> Skolotajs $vards $uzvards already exist in DB!";
            }
            
        }
        
        public function updateSkolotajs($conn, $id, $newVards, $newUzvards){
            $sql = "UPDATE ".$this->table." SET vards = '$newVards', uzvards = '$newUzvards' WHERE id_skolotajs = $id";
            
            $isUpdated = $conn->query($sql);
            
            if($isUpdated){
                return "<br> Skolotājs is updated!";
            }
            else{
                return "<br> Update process has failed!";
            }
        }
        
        public function deleteSkolotajs($conn, $id){
            $sql = "DELETE FROM ".$this->table." WHERE id_skolotajs = $id";
            
            $isDeleted = $conn->query($sql);
            
            if($isDeleted){
                return "<br> Skolotājs is deleted!";
            }
            else{
                return "<br> Delete process has failed!";
            }
        }
        
        public function getSkolotajsID($conn, $vards, $uzvards):int{
            $sql = "SELECT id_skolotajs FROM ".$this->table." WHERE vards = '$vards' AND uzvards = '$uzvards'";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['id_skolotajs'];
            
            return $id;
        }
        
        public function getSkolotajsByID($conn, $id):Skolotajs{
            $sql = "SELECT vards, uzvards FROM ".$this->table." WHERE id_skolotajs = $id";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $vards = $row['vards'];
            $uzvards = $row['uzvards'];
            
            $this->skolotajs = new Skolotajs($vards, $uzvards);
            
            return $this->skolotajs;
        }
        
        public function getAllSkolotaji($conn):array{
            $sql = "SELECT * FROM ".$this->table;
            
            $skolotaji = array();
            
            $result = $conn->query($sql);
            
            while($row = $result->fetch_object()){
                $id = $row->id_skolotajs;
                $vards = $row->vards;
                $uzvards = $row->uzvards;
                
                $this->skolotajs = new Skolotajs($vards, $uzvards);
                $this->skolotajs->setID($id);
                
                array_push($skolotaji, $this->skolotajs);
            }
            
            return $skolotaji;
        }
    }
?>