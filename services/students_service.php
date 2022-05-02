<?php
    class StudentsService{
        private $student;
        
        private $table = "students";
        
        public function insertStudents($conn, $firstName, $lastName, $codes,$courses,$professions, $years){
            $studentExists = false;
            $students = $this->getAllStudents($conn);
            foreach($students as $s){
                $fName = $s->getFirstName();
                $lName = $s->getLastName();
                $code = $s->getCodes();
                $course = $s->getCourses();
                $year = $s->getYears();
                $profession = $s->getProfessions();
                if($fName == $firstName && $lName == $lastName && $code == $codes && $year == $years && $course == $courses && $profession == $professions){
                    $studentExists = true;
                    break;
                }
            }
            
            if(!$studentExists){
                $sql = "INSERT INTO ".$this->table."(firstName, lastName,codes,courses,professions,years) VALUES ('$firstName', '$lastName','$codes','$courses','$professions',$years)";
                
                $isInserted = $conn->query($sql);
            
                if($isInserted){
                    return "<br> Students $fName $lName $code $course $professions $year is added in system!";
                }
                else{
                    return "<br> Insertation process has failed!";
                }
            }
            else{
                return "<br> Students $fName $lName $code $course $professions $year already exist in DB!";
            }
            
        }
        
        public function updateStudents($conn, $id, $newfName, $newlName, $newCode,$newCourse,$newProfession, $newYear){
            $sql = "UPDATE ".$this->table." SET firstName = '$newfName', lastName = '$newlName', codes = '$newCode', courses = '$newCourse',professions = '$newProfession', years = $newYear WHERE id_student = $id";
            
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
        
        public function getStudentsID($conn, $fName, $lName, $code,$course,$profession,$year):int{
            $sql = "SELECT id_student FROM ".$this->table." WHERE firstName = '$fName' AND lastName = '$lName' AND codes = '$code' AND courses = '$course' AND professions = '$profession' AND years = $year;";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['id_student'];
            
            return $id;
        }
        
        public function getStudentsByID($conn, $id):Students{
            $sql = "SELECT firstName, lastName ,codes,courses,professions,years FROM ".$this->table." WHERE id_student = $id";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $fName = $row['firstName'];
            $lName = $row['lastName'];
            $code =  $row['codes'];
            $course =  $row['courses'];
            $profession = $row['professions'];
            $year =  $row['years'];
            $this->student = new Students($fName, $lName,$code,$course,$profession,$year);
            
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
                $course = $row->courses;
                $profession = $row->professions;
                $year = $row->years;

                $this->student = new Students($fName, $lName, $code,$course,$profession,$year);
                $this->student->setID($id);
                
                array_push($students, $this->student);
            }
            
            return $students;
        }
    }
