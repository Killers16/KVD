<?php


class Remarks
{
    private $id;
    private $Rnames;
    private $students_id;


    public function __construct($students_id, $Rnames)
    {


        $this->students_id = $students_id;
        $this->Rnames = $Rnames;
    }

    public function setID(int $id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setRnames($Rnames)
    {
        $this->Rnames = $Rnames;
    }

    public function getRnames()
    {
        return $this->Rnames;
    }




    public function getReStudentID()
    {
        return $this->students_id;
    }


    public function setReStudentID($students_id)
    {
        $this->students_id = $students_id;

        return $this;
    }
}
