<?php
    class ProfessionsService{
        private $profession;
        
        private $table = "professions";
        
        public function insertProfessions($conn, $names){
            $professionExists = false;
            $professions = $this->getAllProfessions($conn);
            foreach($professions as $p){
                $name = $p->getNames();
                
                if($names == $name){
                    $professionExists = true;
                    break;
                }
            }
            
            if(!$professionExists){
                $sql = "INSERT INTO ".$this->table."(names) VALUES ('$names')";
                                                               

                $isInserted = $conn->query($sql);

                if($isInserted){
                    return "<br> New Professions is added in system!";
                }
                else{
                    return "<br> Insertation process has failed!";
                }
            }
            else{
                return "<br> Professions $names already exist in DB!";
            }
        }
        public function updateProfessionsNames($conn, $id, $newNames){
            $professionsService = new ProfessionsService();
            
            $sql = "UPDATE ".$this->table." SET names = '$newNames' WHERE id_profession = $id";
            
            $isUpdated = $conn->query($sql);
            
            if($isUpdated){
                return "<br> Professions is updated!";
            }
            else{
                return "<br> Update process has failed!";
            }
        }
 
        
        public function deleteProfessions($conn, $id){
            $sql = "DELETE FROM ".$this->table." WHERE id_profession = $id";
            
            $isDeleted = $conn->query($sql);
            
            if($isDeleted){
                return "<br> Professions is deleted!";
            }
            else{
                return "<br> Delete process has failed!";
            }
        }
        
        public function getProfessionsID($conn, $names):int{
            $sql = "SELECT id_profession FROM ".$this->table." WHERE names = '$names'";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['id_profession'];
            
            return $id;
        }
        
        public function getProfessionsByID($conn, $id):Professions{
            $sql = "SELECT names FROM ".$this->table." WHERE id_profession = $id";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $names = $row['names'];
             
            
            $this->profession = new Professions($names);
            
            return $this->profession;
        }
        
      
        
        public function getAllProfessions($conn):array{
            $sql = "SELECT * FROM ".$this->table;
            
            $professions = array();
            
            $result = $conn->query($sql);
            
            while($row = $result->fetch_object()){
                $id = $row->id_profession;
                $names = $row->names;
                
                
                $this->profession = new Courses($names);
                $this->profession->setID($id);
                
                array_push($professions, $this->profession);
            }
            
            return $professions;
        }
    }
