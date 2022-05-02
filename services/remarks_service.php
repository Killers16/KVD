<?php
    class RemarksService{
        private $remark;
        
        private $table = "remarks";
        
        public function insertRemarks($conn, $firstName, $lastName, $names){
            $remarkExists = false;
            $remarks = $this->getAllRemarks($conn);
            foreach($remarks as $r){
                $fName = $r->getFirstName();
                $lName = $r->getLastName();
                $Rnames = $r->getRNames();
               
                if($fName == $firstName && $lName == $lastName && $names == $Rnames ){
                    $remarkExists = true;
                    break;
                }
            }
            
            if(!$remarkExists){
                $sql = "INSERT INTO ".$this->table."(firstName, lastName,names) VALUES ('$firstName', '$lastName','$names')";
                
                $isInserted = $conn->query($sql);
            
                if($isInserted){
                    return "<br> Students $firstName $lastName $names is added in system!";
                }
                else{
                    return "<br> Insertation process has failed!";
                }
            }
            else{
                return "<br> Students $firstName $lastName $names already exist in DB!";
            }
            
        }
        
        public function updateRemarks($conn, $id, $newfName, $newlName, $newRname){
            $sql = "UPDATE ".$this->table." SET firstName = '$newfName', lastName = '$newlName', names = '$newRname' WHERE id_remarks = $id";
            
            $isUpdated = $conn->query($sql);
            
            if($isUpdated){
                return "<br> Students is updated!";
            }
            else{
                return "<br> Update process has failed!";
            }
        }
        
        public function deleteRemarks($conn, $id){
            $sql = "DELETE FROM ".$this->table." WHERE id_remarks = $id";
            
            $isDeleted = $conn->query($sql);
            
            if($isDeleted){
                return "<br> Students is deleted!";
            }
            else{
                return "<br> Delete process has failed!";
            }
        }
        
        public function getRemarksID($conn, $fName, $lName, $Rnames):int{
            $sql = "SELECT id_remarks FROM ".$this->table." WHERE firstName = '$fName' AND lastName = '$lName' AND names = '$Rnames'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['id_remarks'];
            
            return $id;
        }
        public function getRemarksByID($conn, $id):Remarks{
            $sql = "SELECT firstName, lastName ,names FROM ".$this->table." WHERE id_remarks = $id";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $fName = $row['firstName'];
            $lName = $row['lastName'];
            $Rnames =  $row['names'];
            
            $this->student = new Remarks($fName, $lName,$Rnames);
            
            return $this->student;
        }
        
       
        
        public function getAllRemarks($conn):array{
            $sql = "SELECT * FROM ".$this->table;
            
            $remarks = array();
            
            $result = $conn->query($sql);
            
            while($row = $result->fetch_object()){
                $id = $row->id_remarks;
                $fName = $row->firstName;
                $lName = $row->lastName;
                $Rnames = $row->names;
              

                $this->remark = new Remarks($fName, $lName, $Rnames);
                $this->remark->setID($id);
                
                array_push($remarks, $this->remark);
            }
            
            return $remarks;
        }
    }
