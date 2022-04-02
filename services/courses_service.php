<?php
    class CoursesService{
        private $course;
        
        private $table = "courses";
        
        public function insertCourses($conn, $names){
            $courseExists = false;
            $courses = $this->getAllCourses($conn);
            foreach($courses as $c){
                $name = $c->getNames();
                
                if($names == $name){
                    $courseExists = true;
                    break;
                }
            }
            
            if(!$courseExists){
                $sql = "INSERT INTO ".$this->table."(names) VALUES ('$names')";
                                                               

                $isInserted = $conn->query($sql);

                if($isInserted){
                    return "<br> New course is added in system!";
                }
                else{
                    return "<br> Insertation process has failed!";
                }
            }
            else{
                return "<br> Course $names already exist in DB!";
            }
        }
        public function updateCoursesNames($conn, $id, $newNames){
            $coursesService = new CoursesService();
            
            $sql = "UPDATE ".$this->table." SET names = '$newNames' WHERE id_course = $id";
            
            $isUpdated = $conn->query($sql);
            
            if($isUpdated){
                return "<br> Course is updated!";
            }
            else{
                return "<br> Update process has failed!";
            }
        }
 
        
        public function deleteCourses($conn, $id){
            $sql = "DELETE FROM ".$this->table." WHERE id_course = $id";
            
            $isDeleted = $conn->query($sql);
            
            if($isDeleted){
                return "<br> Course is deleted!";
            }
            else{
                return "<br> Delete process has failed!";
            }
        }
        
        public function getCoursesID($conn, $names):int{
            $sql = "SELECT id_course FROM ".$this->table." WHERE names = '$names'";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['id_course'];
            
            return $id;
        }
        
        public function getCoursesByID($conn, $id):Courses{
            $sql = "SELECT names FROM ".$this->table." WHERE id_course = $id";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $names = $row['names'];
             
            
            $this->course = new Courses($names);
            
            return $this->course;
        }
        
      
        
        public function getAllCourses($conn):array{
            $sql = "SELECT * FROM ".$this->table;
            
            $courses = array();
            
            $result = $conn->query($sql);
            
            while($row = $result->fetch_object()){
                $id = $row->id_course;
                $names = $row->names;
                
                
                $this->course = new Courses($names);
                $this->course->setID($id);
                
                array_push($courses, $this->course);
            }
            
            return $courses;
        }
    }
?>