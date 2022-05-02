<?php
    
    class InfoService{
        private $infos;
        
        private $table = "info";

        private $studentsService, $courseService, $professionsService;
        
        public function insertInfo($conn, $fName, $lName,$codes,$years,$pNames,$cNames){
            $studentsService = new StudentsService();
            $courseService = new CoursesService();
            $professionsService = new ProfessionsService();
           

            $studentID = $studentsService->getStudentsID($conn, $fName, $lName,$code,$year);
            $courseID = $courseService->getCoursesID($conn, $cNames);
            $professionID = $professionsService ->getProfessionsID($conn,$pNames);
            

            $infosExists = false;
            $info = $this->getAllInfos($conn);
            foreach($info as $i){
                $studFname = $i->getStudentsID()->getFirstName();
                $studLname = $i->getStudentsID()->getLastName();
                $courName = $i ->getCoursesID()->getNames();
                $profName = $i ->getProfessionsID()->getNames();
                
                
                if($studFname == $fName && $studLname == $lName &&
                  $courName == $cNames && $profName == $pNames){
                    $infosExists = true;
                    break;
                }
            }         

            if(!$infosExists){
               $sql = "INSERT INTO ".$this->table."(student_id,course_id,profession_id) VALUES ($studentID, $courseID, $professionID)";
            
                $isInserted = $conn->query($sql);

                if($isInserted){
                    return "<br> Nodarbiba is added in system!";
                }
                else{
                    return "<br> Insertation process has failed!";
                } 
            }
            else{
                return "<br> Such Nodarbiba already exist in DB!";
            }
        }
        
        
 
        /*
            Update metodes: 
                -> updateNodarbiba
                -> updateNodarbibaKlase
                -> updateNodarbibaPrieksmets
                -> updateNodarbibaSkolotajs
                -> updateNodarbibaKabinets
                -> updateNodarbibaDiena
                -> updateNodarbibaStunda
        
        */
        
        public function deleteInfos($conn, $id){
            $sql = "DELETE FROM ".$this->table." WHERE id_info = $id";
            
            $isDeleted = $conn->query($sql);
            
            if($isDeleted){
                return "<br> Nodarbiba is deleted!";
            }
            else{
                return "<br> Delete process has failed!";
            }
        }


        public function insertNodarbibaAll($conn, $fName, $lName,$codes,$years,$pNames,$cNames){
            $studentsService = new StudentsService();
            $courseService = new CoursesService();
            $professionsService = new ProfessionsService();
            
            $studentID = $studentsService->getStudentsID($conn, $fName, $lName,$code,$year);
            $courseID = $courseService->getCoursesID($conn, $cNames);
            $professionID = $professionsService ->getProfessionsID($conn,$pNames);
            
            
            $sql = "INSERT INTO ".$this->table."(student_id, course_id, profession_id) VALUES ($studentID, $courseID, $professionID)";
            
            $isInserted = $conn->query($sql);
            
            if($isInserted){
                return "<br> INFO is added in system!";
            }
            else{
                return "<br> Insertation process has failed!";
            }
        }
        
        public function getInfosID($conn, $fName, $lName,$codes,$years,$pNames,$cNames):int{
            $studentsService = new StudentsService();
            $courseService = new CoursesService();
            $professionsService = new ProfessionsService();
            
            $studentID = $studentsService->getStudentsID($conn, $fName, $lName,$code,$year);
            $courseID = $courseService->getCoursesID($conn, $cNames);
            $professionID = $professionsService ->getProfessionsID($conn,$pNames);
            
            $sql = "SELECT id_info FROM ".$this->table." WHERE student_id = $studentID AND course_id = $courseID AND profession_id = $professionID";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['id_info'];
            
            return $id;
        }
        
        public function getNodarbibaByID($conn, $id):Info{
            $studentsService = new StudentsService();
            $courseService = new CoursesService();
            $professionsService = new ProfessionsService();
            
            $sql = "SELECT student_id, course_id, profession_id FROM ".$this->table." WHERE id_info = $id";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $studentID = $row['student_id'];
            $courseID = $row['course_id'];
            $professionID = $row['profession_id'];
            
            

            $students = $studentsService->getStudentsByID($conn, $studentID);
            $course = $courseService->getCoursesByID($conn, $courseID);
            $professions = $professionsService->getProfessionsByID($conn, $professionID);
            
            
            $this->infos = new Info($students,$course,$professions);
            
            return $this->infos;
        }
        
        public function getInfosByStudents($conn, $fName, $lName,$codes,$years):array{
            $info = array();
            
            $studentsService = new StudentsService();
            $courseService = new CoursesService();
            $professionsService = new ProfessionsService();
            
            $studentID = $studentsService->getStudentsID($conn, $fName, $lName,$code,$year);
            $studentsIDs = $studentsService->getSpIdByStudentID($conn, $id);
            
            foreach($studentsIDs as $studentsID){
                $sql = "SELECT student_id, course_id, profession_id FROM ".$this->table." WHERE id_student = $studentsID";
            
                $result = $conn->query($sql);
                while($row = $result->fetch_object()){
                    $courseID = $row->course_id;
                    $professionID = $row->profession_id;
                    
                    $student = new Students($fName, $lName);
                    $course = $courseService ->getCoursesByID($conn,$courseID);
                    $profession = $professionsService ->getProfessionsByID($conn,$professionID);
                    
                    $infos = new Info($students,$course,$professions);

                    array_push($infos, $info);
                }
            }            
            
            
            return $infos;
        }
        
        
        public function getAllInfos($conn):array{
            $studentsService = new StudentsService();
            $courseService = new CoursesService();
            $professionsService = new ProfessionsService();
           

            
            $sql = "SELECT * FROM ".$this->table;
            
            $infos = array();
            
            $result = $conn->query($sql);
            
            while($row = $result->fetch_object()){
              
                $id = $row -> id_info;
                $studentID = $row->student_id;
                $courseID = $row->course_id;
                $professionID = $row->profession_id;

                $student = $studentsService ->getStudentsByID($conn,$studentID);
                $course = $courseService ->getCoursesByID($conn,$courseID);
                $profession = $professionsService ->getProfessionsByID($conn,$professionID);
            
                $this->info = new Info($student, $course, $profession);
               $this->info->setID($id);//$row->id_info

                
                
                array_push($infos, $this->info);
            }
            
            return $infos;
        }
    }
