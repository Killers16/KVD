<?php
class ce_exam{
    private  $id_ce_exams;
    private $names;

    public function __construct($names){
        $this->names = $names;
    }

    /**
     * Get the value of id_ce_exams
     */ 
    public function getId_ce_exams()
    {
        return $this->id_ce_exams;
    }

    /**
     * Set the value of id_ce_exams
     *
     * @return  self
     */ 
    public function setId_ce_exams($id_ce_exams)
    {
        $this->id_ce_exams = $id_ce_exams;

        return $this;
    }
}

?>