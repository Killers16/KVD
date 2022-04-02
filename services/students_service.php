<?php
    class StudentsService{
        private $student;
        
        private $table = "students";
        
        public function insertStudents($conn, $firstName, $lastName,$codes, $years){
            $studentExists = false;
            $students = $this->getAllStudents($conn);
            foreach($students as $s){
                $fName = $s->getFirstName();
                $lName = $s->getLastName();
                $code = $s->getCodes();
                $year = $s->getYears();
                if($fName == $firstName && $lName == $lastName && $code == $codes && $year == $years){
                    $studentExists = true;
                    break;
                }
            }
            
            if(!$studentExists){
                $sql = "INSERT INTO ".$this->table."(firstName, lastName,codes,years) VALUES ('$firstName', '$lastName',$codes,$years)";
                
                $isInserted = $conn->query($sql);
            
                if($isInserted){
                    return "<br> Students $fName $lName $code $year is added in system!";
                }
                else{
                    return "<br> Insertation process has failed!";
                }
            }
            else{
                return "<br> Students $fName $lName $code $year already exist in DB!";
            }
            
        }
        
        public function updateStudents($conn, $id, $newfName, $newlName, $newCode, $newYear){
            $sql = "UPDATE ".$this->table." SET firstName = '$newfName', lastName = '$newlName', codes = $newCode, years = $newYear WHERE id_student = $id";
            
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
        
        public function getStudentsID($conn, $fName, $lName,$code,$year):int{
            $sql = "SELECT id_student FROM ".$this->table." WHERE firstName = '$fName' AND lastName = '$lName' AND codes = $code AND years = $year;";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['id_student'];
            
            return $id;
        }
        
        public function getStudentsByID($conn, $id):Students{
            $sql = "SELECT firstName, lastName ,codes,years FROM ".$this->table." WHERE id_student = $id";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $fName = $row['firstName'];
            $lName = $row['lastName'];
            $code = $row['codes'];
            $year = $row['years'];
            $this->student = new Students($fName, $lName,$code,$year);
            
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
                $code = $row->codes;
                $year = $row->years;

                $this->student = new Students($fName, $lName,$code,$year);
                $this->student->setID($id);
                
                array_push($students, $this->student);
            }
            
            return $students;
        }
    }
?>