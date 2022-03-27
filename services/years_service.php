<?php
    class YearsService{
        private $year;
        
        private $table = "years";
        
        public function insertYears($conn, $names){
            $yearExists = false;
            $years = $this->getAllYears($conn);
            foreach($years as $y){
                $name = $y->getNames();
                
                if($names == $name){
                    $yearExists = true;
                    break;
                }
            }
            
            if(!$yearExists){
                $sql = "INSERT INTO ".$this->table."(names) VALUES ('$names')";
                                                               

                $isInserted = $conn->query($sql);

                if($isInserted){
                    return "<br> New Years is added in system!";
                }
                else{
                    return "<br> Insertation process has failed!";
                }
            }
            else{
                return "<br> Years $names already exist in DB!";
            }
        }
        public function updateYearsNames($conn, $id, $newNames){
            $yearsService = new YearsService();
            
            $sql = "UPDATE ".$this->table." SET names = '$newNames' WHERE id_year = $id";
            
            $isUpdated = $conn->query($sql);
            
            if($isUpdated){
                return "<br> Years is updated!";
            }
            else{
                return "<br> Update process has failed!";
            }
        }
 
        
        public function deleteYears($conn, $id){
            $sql = "DELETE FROM ".$this->table." WHERE id_year = $id";
            
            $isDeleted = $conn->query($sql);
            
            if($isDeleted){
                return "<br> Years is deleted!";
            }
            else{
                return "<br> Delete process has failed!";
            }
        }
        
        public function getYearsID($conn, $names):int{
            $sql = "SELECT id_year FROM ".$this->table." WHERE names = '$names'";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['id_year'];
            
            return $id;
        }
        
        public function getYearsByID($conn, $id):Years{
            $sql = "SELECT names FROM ".$this->table." WHERE id_year = $id";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $names = $row['names'];
             
            
            $this->year = new Years($names);
            
            return $this->year;
        }
        
      
        
        public function getAllYears($conn):array{
            $sql = "SELECT * FROM ".$this->table;
            
            $years = array();
            
            $result = $conn->query($sql);
            
            while($row = $result->fetch_object()){
                $id = $row->id_year;
                $names = $row->names;
                
                
                $this->year = new Years($names);
                $this->year->setID($id);
                
                array_push($years, $this->year);
            }
            
            return $years;
        }
    }
?>