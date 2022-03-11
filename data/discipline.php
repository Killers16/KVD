<?php
class Discipline{
    private $id_disciplines;
    private $names;

    public function __construct($names){
        $this->names = $names;
    }
    /**
     * Get the value of id_disciplines
     */ 
    public function getId_disciplines()
    {
        return $this->id_disciplines;
    }

    /**
     * Set the value of id_disciplines
     *
     * @return  self
     */ 
    public function setId_disciplines($id_disciplines)
    {
        $this->id_disciplines = $id_disciplines;

        return $this;
    }
}

?>