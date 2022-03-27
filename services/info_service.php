<?php
    
    class InfoService{
        private $infos;
        
        private $table = "info";
        
        private $studentsService, $courseService, $professionsService, $yearsService, $persCodesService;
        
        public function insertInfo($conn, $fName, $lName, $Cname, $persName,$pName,$yName){
            $studentsService = new StudentsService();
            $courseService = new CoursesService();
            $professionsService = new ProfessionsService();
            $yearsService = new YearsService();
            $persCodesService = new PersCodesService();


            $studentID = $studentsService->getStudentsID($conn, $fName, $lName);
            $courseID = $courseService->getCoursesID($conn, $names);
            $professionID = $professionsService ->getProfessionsID($conn,$names);
            $yearID = $yearService->getYearsID($conn, $names);
            $persCodeID = $persCodesService->getCodesID($conn, $codes);

            $infosExists = false;
            $info = $this->getAllInfos($conn);
            foreach($info as $i){
                $studFname = $i->getStudent_id()->getFirstName();
                $studLname = $i->getStudent_id()->getLastName();
                $courName = $i ->getCourse_id()->getNames();
                $profName = $i ->getProfession_id()->getNames();
                $yearName = $i ->getYear_id()->getNames();
                $persCode = $i ->getPers_code_id()->getCodes();
                
                if($studFname == $fName && $studLname == $lName &&
                  $courName == $Cname && $profName == $pName &&
                  $yearName == $yName && $persCode == $persName){
                    $infosExists = true;
                    break;
                }
            }         
            
            if(!$infosExists){
               $sql = "INSERT INTO ".$this->table."(sp_id, klase_id, diena, stunda) VALUES ($spID, $klaseID, $diena, $stunda)";
            
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
        
        public function deleteKlase($conn, $id){
            $sql = "DELETE FROM ".$this->table." WHERE id_nodarbiba = $id";
            
            $isDeleted = $conn->query($sql);
            
            if($isDeleted){
                return "<br> Nodarbiba is deleted!";
            }
            else{
                return "<br> Delete process has failed!";
            }
        }
        
        public function insertNodarbibaAll($conn, $prNos, $klaseNos, $vards, $uzvards,  $kabNos, int $diena, int $stunda){
            $klaseService = new KlaseService();
            $spService = new SpService();
            $kabinetsService = new KabinetsService();
            
            $spID = $spService->getSpID($conn, $prNos, $vards, $uzvards);
            $klaseID = $klaseService->getKlaseID($conn, $klaseNos);
            $kabinetsID = $kabinetsService->getKabinetsID($conn, $kabNos);
            
            
            $sql = "INSERT INTO ".$this->table."(sp_id, klase_id, kabinets_id, diena, stunda) VALUES ($spID, $klaseID, $kabinetsID, $diena, $stunda)";
            
            $isInserted = $conn->query($sql);
            
            if($isInserted){
                return "<br> Nodarbiba is added in system!";
            }
            else{
                return "<br> Insertation process has failed!";
            }
        }
        
        public function getNodarbibaID($conn, $prNos, $klaseNos, $vards, $uzvards, int $diena, int $stunda):int{
            $klaseService = new KlaseService();
            $spService = new SpService();
            
            $spID = $spService->getSpID($conn, $prNos, $vards, $uzvards);
            $klaseID = $klaseService->getKlaseID($conn, $klaseNos);
            
            $sql = "SELECT id_nodarbiba FROM ".$this->table." WHERE id_sp = $spID AND klase_id = $klaseID AND diena = $diena AND stunda = $stunda";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['id_nodarbiba'];
            
            return $id;
        }
        
        public function getNodarbibaByID($conn, $id):Nodarbiba{
            $klaseService = new KlaseService();
            $spService = new SpService();
            $kabinetsService = new KabinetsService();
            
            $sql = "SELECT sp_id, kabinets_id, klase_id, diena, stunda FROM ".$this->table." WHERE id_nodarbiba = $id";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $spID = $row['sp_id'];
            $kabinetsID = $row['kabinets_id'];
            $klaseID = $row['klase_id'];
            $diena = $row['diena'];
            $stunda = $row['stunda'];
            
            $klase = $klaseService->getKlaseByID($conn, $klaseID);
            $kabinets = $kabinetsService->getKabinetsByID($conn, $kabinetsID);
            $rinda = $spService->getSpByID($conn, $spID);
            
            $skolotajs = $rinda[0];
            $prieksmets = $rinda[1];
            
            $this->nodarbiba = new Nodarbiba($skolotajs, $prieksmets, $diena, $stunda, $klase, $kabinets);
            
            return $this->skolotajs;
        }
        
        public function getNodarbibasBySkolotajs($conn, $vards, $uzvards):array{
            $nodarbibas = array();
            
            $skolotajsService = new SkolotajsService();
            $spService = new SpService();
            $prieksmetsService = new PrieksmetsService();
            $klaseService = new KlaseService();
            $kabinetsService = new KabinetsService();
            
            $skolotajsID = $skolotajsService->getSkolotajsID($conn, $vards, $uzvards);
            $spIDs = $spService->getSpIdBySkolotajs($conn, $skolotajsID);
            
            foreach($spIDs as $spID){
                $sql = "SELECT kabinets_id, klase_id, diena, stunda FROM ".$this->table." WHERE sp_id = $spID";
            
                $result = $conn->query($sql);
                while($row = $result->fetch_object()){
                    $kabinetsID = $row->kabinets_id;
                    $klaseID = $row->klase_id;
                    $diena = $row->diena;
                    $stunda = $row->stunda;
                    
                    $skolotajs = new Skolotajs($vards, $uzvards);
                    $prieksmets = $spService->getSpByID($conn, $spID)[1];
                    $klase = $klaseService->getKlaseByID($conn, $klaseID);
                    $kabinets = $kabinetsService->getKabinetsByID($conn, $kabinetsID);
                    
                    $nodarbiba = new Nodarbiba($skolotajs, $prieksmets, $diena, $stunda, $klase);
                    $nodarbiba->setKabinets($kabinets);

                    array_push($nodarbibas, $nodarbiba);
                }
            }            
            
            
            return $nodarbibas;
        }
        
        public function getNodarbibasByPrieksmets($conn, $nos):array{
            $nodarbibas = array();
            
            $skolotajsService = new SkolotajsService();
            $spService = new SpService();
            $prieksmetsService = new PrieksmetsService();
            $klaseService = new KlaseService();
            $kabinetsService = new KabinetsService();
            
            $prieksmetsID = $prieksmetsService->getPrieksmetsID($conn, $nos);
            $spIDs = $spService->getSpIdByPrieksmets($conn, $prieksmetsID);
            
            foreach($spIDs as $spID){
                $sql = "SELECT kabinets_id, klase_id, diena, stunda FROM ".$this->table." WHERE sp_id = $spID";
            
                $result = $conn->query($sql);
                while($row = $result->fetch_object()){
                    $kabinetsID = $row->kabinets_id;
                    $klaseID = $row->klase_id;
                    $diena = $row->diena;
                    $stunda = $row->stunda;
                    
                    $skolotajs = $spService->getSpByID($conn, $spID)[0];
                    $prieksmets = new Prieksmets($nos);
                    $klase = $klaseService->getKlaseByID($conn, $klaseID);
                    $kabinets = $kabinetsService->getKabinetsByID($conn, $kabinetsID);
                    
                    $nodarbiba = new Nodarbiba($skolotajs, $prieksmets, $diena, $stunda, $klase);
                    $nodarbiba->setKabinets($kabinets);

                    array_push($nodarbibas, $nodarbiba);
                }
            }            
            
            
            return $nodarbibas;
        }
        
       

        /*
            
            getNodarbibaByKlase, 
            getNodarbibaByKabinets, 
            getNodarbibaByDiena, 
            getNodarbibaByStunda
         */
        
        public function getAllInfos($conn):array{
            $studentsService = new StudentsService();
            $courseService = new CoursesService();
            $professionsService = new ProfessionsService();
            $yearsService = new YearsService();
            $persCodesService = new PersCodesService();

            
            $sql = "SELECT * FROM ".$this->table;
            
            $info = array();
            
            $result = $conn->query($sql);
            
            while($row = $result->fetch_object()){
              
                
                $studentID = $row->student_id;
                $courseID = $row->course_id;
                $professionID = $row->profession_id;
                $yearID = $row->year_id;
                $persCodeID = $row->pers_code_id;

                $student = $studentsService ->getStudentsByID($conn,$studentID);
                $course = $courseService ->getCoursesByID($conn,$courseID);
                $profession = $professionsService ->getProfessionsByID($conn,$professionID);
                $year = $yearService ->getYearsByID($conn,$yearID);
                $persCode = $persCodesService ->getPersCodesByID($conn,$persCodeID);
                
                


                
                $this->infos = new Info($student, $course, $profession, $year, $persCode);
                $this->infos->setID($id);
                
                
                array_push($info, $this->infos);
            }
            
            return $info;
        }
    }
?>