<?php
class Stipend{
    private $id_stipends;
    private $names;

    public function __construct($names){
        $this->names = $names;
    }
    /**
     * Get the value of id_stipend
     */ 
    public function getId_stipend()
    {
        return $this->id_stipend;
    }

    /**
     * Set the value of id_stipend
     *
     * @return  self
     */ 
    public function setId_stipend($id_stipend)
    {
        $this->id_stipend = $id_stipend;

        return $this;
    }
}


?>