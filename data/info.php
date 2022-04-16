<?php


    class Info{
        private $id;
        private $student_id; 
	private $course_id;
        private $profession_id; 
       
        
        public function __construct(Students $student_id, Courses $course_id ,Professions $profession_id){
            $this->student_id = $student_id;
            $this->course_id = $course_id;
            $this->profession_id = $profession_id;
            
        }

        public function getId()
        {
                return $this->id;
        }
 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }
 
        public function getStudent_id()
        {
                return $this->student_id;
        }

        public function setStudent_id($student_id)
        {
                $this->student_id = $student_id;

                return $this;
        }

	    public function getCourse_id()
	    {
	    	    return $this->course_id;
	    }

	    public function setCourse_id($course_id)
	    {
	    	    $this->course_id = $course_id;

	    	    return $this;
	    }
 
	    

        public function getProfession_id()
        {
                return $this->profession_id;
        }

    
        public function setProfession_id($profession_id)
        {
                $this->profession_id = $profession_id;

                return $this;
        }

        
    }
?>