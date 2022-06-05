<?php
class RemarksService
{
    private $remark;

    private $table = "remarks";

    public function insertRemarks($conn, $students_id, $names)
    {
        $remarkExists = false;
        $remarks = $this->getAllRemarks($conn);
        foreach ($remarks as $r) {
            $students = $r->getReStudentID();
            $Rnames = $r->getRNames();

            if ($students == $students_id && $names == $Rnames) {
                $remarkExists = true;
                break;
            }
        }

        if (!$remarkExists) {
            $sql = "INSERT INTO " . $this->table . "(students_id,names) VALUES ('$students_id','$names')";

            $isInserted = $conn->query($sql);

            if ($isInserted) {
                return "<br> Students $students_id $names is added in system!";
            } else {
                return "<br> Insertation process has failed!";
            }
        } else {
            return "<br> Students $students_id $names already exist in DB!";
        }
    }

    public function updateRemarks($conn, $id, $newstudents, $newRname)
    {
        $sql = "UPDATE " . $this->table . " SET students_id = '$newstudents', names = '$newRname' WHERE id_remarks = $id";

        $isUpdated = $conn->query($sql);

        if ($isUpdated) {
            return "<br> Students is updated!";
        } else {
            return "<br> Update process has failed!";
        }
    }

    public function deleteRemarks($conn, $id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE id_remarks = $id";

        $isDeleted = $conn->query($sql);

        if ($isDeleted) {
            return "<br> Students is deleted!";
        } else {
            return "<br> Delete process has failed!";
        }
    }

    public function getRemarksID($conn, $students, $Rnames): int
    {
        $sql = "SELECT id_remarks FROM " . $this->table . " WHERE students_id = '$students' AND names = '$Rnames'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $id = $row['id_remarks'];

        return $id;
    }
    public function getRemarksByID($conn, $id): Remarks
    {
        $sql = "SELECT students_id ,names FROM " . $this->table . " WHERE id_remarks = $id";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $students = $row['students_id'];

        $Rnames =  $row['names'];

        $this->student = new Remarks($students, $Rnames);

        return $this->student;
    }



    public function getAllRemarks($conn): array
    {
        $sql = "SELECT * FROM " . $this->table;

        $remarks = array();

        $result = $conn->query($sql);

        while ($row = $result->fetch_object()) {
            $id = $row->id_remarks;
            $students = $row->students_id;

            $Rnames = $row->names;


            $this->remark = new Remarks($students, $Rnames);
            $this->remark->setID($id);

            array_push($remarks, $this->remark);
        }

        return $remarks;
    }
}
