<?php
class Program {
    private  $id_program;
    private $names;

    public function __construct($names){
        $this->names = $names;
    }

    /**
     * Get the value of id_program
     */ 
    public function getId_program()
    {
        return $this->id_program;
    }

    /**
     * Set the value of id_program
     *
     * @return  self
     */ 
    public function setId_program($id_program)
    {
        $this->id_program = $id_program;

        return $this;
    }
}

?>