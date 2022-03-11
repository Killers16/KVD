<?php
    class StudentService{
        private $student;
        
        private $table = "students";
        
        /*public function insertSkolotajs($conn, $firstname, $lastname, $){
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
        */
        public function getStudentID($conn, $firstname, $lastname, $kurss_id, $program_id, $discipline_id, $years):int{
            $sql = "SELECT id_students FROM ".$this->table." WHERE firstname = '$firstname' AND lastname = '$lastname' WHERE kurss_id='$kurss_id' WHERE program_id = '$program_id' AND discipline_id ='$discipline_id' WHERE years = '$years'";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['id_students'];
            
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
        
        public function getAllStudents($conn):array{
            $sql = "SELECT * FROM ".$this->table;
            
            $students = array();
            
            $result = $conn->query($sql);
            
            while($row = $result->fetch_object()){
                
                $id_students = $row->$id_students ;
                $firstname = $row->  $firstname;
                $lastname = $row->$lastname;
                $kurss_id = $row->$kurss_id;
                $program_id = $row->$program_id;
                $personal_code = $row->$personal_code;
                $discipline_id = $row->$discipline_id;
                $years = $row->$years;

                $this->student = new Student($firstname, $lastname, $personal_code, $years);
                $this->student->setID($id_students);
                
                array_push($students, $this->student);
            }
            
            return $students;
        }
    }
?>