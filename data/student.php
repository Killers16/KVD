<?php
    

    class Student{
        private $id_students;
        private $firstname;
        private $lastname;
        private $kurss_id;
        private $program_id;
        private $personal_code;
        private $discipline_id;
        private $years;
        
        
        public function __construct($firstname, $lastname, $kurss_id, $program_id, $discipline_id, $years){
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->kurss_id = $kurss_idrss;
            $this->program_id = $program_id;
            $this->personal_code = $personal_code;
            $this->discipline_id = $discipline_id;
            $this->years = $years;
        }

        /**
         * Get the value of id_students
         */ 
        public function getId_students()
        {
                return $this->id_students;
        }

        /**
         * Set the value of id_students
         *
         * @return  self
         */ 
        public function setId_students($id_students)
        {
                $this->id_students = $id_students;

                return $this;
        }

        /**
         * Get the value of firstname
         */ 
        public function getFirstname()
        {
                return $this->firstname;
        }

        /**
         * Set the value of firstname
         *
         * @return  self
         */ 
        public function setFirstname($firstname)
        {
                $this->firstname = $firstname;

                return $this;
        }

        /**
         * Get the value of lastname
         */ 
        public function getLastname()
        {
                return $this->lastname;
        }

        /**
         * Set the value of lastname
         *
         * @return  self
         */ 
        public function setLastname($lastname)
        {
                $this->lastname = $lastname;

                return $this;
        }

        /**
         * Get the value of kurss
         */ 
        public function getKurss_id()
        {
                return $this->kurss_id;
        }

        /**
         * Set the value of kurss
         *
         * @return  self
         */ 
        public function setKurss_id($kurss)
        {
                $this->kurss_id = $kurss_id;

                return $this;
        }

        /**
         * Get the value of program_id
         */ 
        public function getProgram_id()
        {
                return $this->program_id;
        }

        /**
         * Set the value of program_id
         *
         * @return  self
         */ 
        public function setProgram_id($program_id)
        {
                $this->program_id = $program_id;

                return $this;
        }

        /**
         * Get the value of personal_code
         */ 
        public function getPersonal_code()
        {
                return $this->personal_code;
        }

        /**
         * Set the value of personal_code
         *
         * @return  self
         */ 
        public function setPersonal_code($personal_code)
        {
                $this->personal_code = $personal_code;

                return $this;
        }

        /**
         * Get the value of years
         */ 
        public function getYears()
        {
                return $this->years;
        }

        /**
         * Set the value of years
         *
         * @return  self
         */ 
        public function setYears($years)
        {
                $this->years = $years;

                return $this;
        }

        /**
         * Get the value of discipline_id
         */ 
        public function getDiscipline_id()
        {
                return $this->discipline_id;
        }

        /**
         * Set the value of discipline_id
         *
         * @return  self
         */ 
        public function setDiscipline_id($discipline_id)
        {
                $this->discipline_id = $discipline_id;

                return $this;
        }
    }
?>