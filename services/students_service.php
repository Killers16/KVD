<?php
    class StudentsService{
        private $student;
        
        private $table = "students";
        
        public function insertStudents($conn, $firstName, $lastName){
            $studentExists = false;
            $students = $this->getAllStudents($conn);
            foreach($students as $s){
                $fName = $s->getFirstName();
                $lName = $s->getLastName();
                
                if($fName == $firstName && $lName == $lastName){
                    $studentExists = true;
                    break;
                }
            }
            
            if(!$studentExists){
                $sql = "INSERT INTO ".$this->table."(firstName, lastName) VALUES ('$firstName', '$lastName')";
                
                $isInserted = $conn->query($sql);
            
                if($isInserted){
                    return "<br> Students $fName $lName is added in system!";
                }
                else{
                    return "<br> Insertation process has failed!";
                }
            }
            else{
                return "<br> Students $fName $lName already exist in DB!";
            }
            
        }
        
        public function updateStudents($conn, $id, $newfName, $newlName){
            $sql = "UPDATE ".$this->table." SET firstName = '$newfName', lastName = '$newlName' WHERE id_student = $id";
            
            $isUpdated = $conn->query($sql);
            
            if($isUpdated){
                return "<br> Students is updated!";
            }
            else{
                return "<br> Update process has failed!";
            }
        }
        
        public function deleteStudents($conn, $id){
            $sql = "DELETE FROM ".$this->table." WHERE id_student = $id";
            
            $isDeleted = $conn->query($sql);
            
            if($isDeleted){
                return "<br> Students is deleted!";
            }
            else{
                return "<br> Delete process has failed!";
            }
        }
        
        public function getStudentsID($conn, $fName, $lName):int{
            $sql = "SELECT id_student FROM ".$this->table." WHERE firstName = '$fName' AND lastName = '$lName'";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['id_student'];
            
            return $id;
        }
        
        public function getStudentsByID($conn, $id):Students{
            $sql = "SELECT firstName, lastName FROM ".$this->table." WHERE id_student = $id";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $fName = $row['firstName'];
            $lName = $row['lastName'];
            
            $this->student = new Students($fName, $lName);
            
            return $this->student;
        }
        
        public function getAllStudents($conn):array{
            $sql = "SELECT * FROM ".$this->table;
            
            $students = array();
            
            $result = $conn->query($sql);
            
            while($row = $result->fetch_object()){
                $id = $row->id_student;
                $fName = $row->firstName;
                $lName = $row->lastName;
                
                $this->student = new Students($fName, $lName);
                $this->student->setID($id);
                
                array_push($students, $this->student);
            }
            
            return $students;
        }
    }
?>