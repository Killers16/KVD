<?php
    include_once('students.php');
    include_once('professions.php');
    include_once('pers_code.php');
    include_once('courses.php');
    include_once('years.php');

    class Info{
        private $id;
        private $student_id; 
	    private $course_id;
	    private $pers_code_id; 
        private $profession_id; 
        private $year_id;
        
        public function __construct(Students $student_id, Course $course_id ,PersCodes $pers_code_id ,Professions $profession_id, Years $year_id){
            $this->student_id = $student_id;
            $this->course_id = $course_id;
            $this->pers_code_id = $pers_code_id;
            $this->profession_id = $profession_id;
            $this->year_id = $year_id;
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
 
	    public function getPers_code_id()
	    {
	    	    return $this->pers_code_id;
	    }

	    public function setPers_code_id($pers_code_id)
	    {
	    	    $this->pers_code_id = $pers_code_id;

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

        public function getYear_id()
        {
                return $this->year_id;
        }

        public function setYear_id($year_id)
        {
                $this->year_id = $year_id;

                return $this;
        }
    }
?>