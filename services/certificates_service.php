<?php
class CertificatesService
{
    private $certificate;

    private $table = "certificates";
    //Izmanto masivā saglabatas vērtibas un veic manīgo salidzināsanu. 
    public function insertCertificates($conn, $students_id, $ce_names, $ce_codes, $ce_items, $ce_years)
    {
        $certificateExists = false;
        $certificates = $this->getAllCertificates($conn);
        foreach ($certificates as $c) {
            $students = $c->getCeStudentsID();
            $ce_name = $c->getCe_name();
            $ce_code = $c->getCe_codes();
            $ce_item = $c->getCeItems();
            $ce_year = $c->getCe_Years();
            if ($students == $students_id && $ce_name == $ce_names && $ce_code == $ce_codes && $ce_year == $ce_years && $ce_items == $ce_item) {
                $certificateExists = true;
                break;
            }
        }
        // parbauda vai dati ir korekti , ja nav korekti dati parāda pazīņojumu, kā dati nav pievienoti, ja ir pievieno datus pievieno datubaze, 
        //citādi parāda paziņojumu kā tādi dati jau eksistē datubaze 
        if (!$certificateExists) {
      $sql = "INSERT INTO " . $this->table . "(students_id,ce_names,ce_codes,items,ce_years) VALUES ('$students_id','$ce_names','$ce_codes','$ce_items',$ce_years)";

            $isInserted = $conn->query($sql);

            if ($isInserted) {
                return "<br> Students $students $ce_name $ce_codes $ce_items $ce_year is added in system!";
            } else {
                return "<br> Insertation process has failed!";
            }
        } else {
            return "<br> Students $students $ce_name $ce_codes $ce_items $ce_year already exist in DB!";
        }
    }
    //atjauno ieraksta datus, kuri tika pievienoti datubaze
    public function updateCertificates($conn, $id, $newStudents_id, $newCe_name, $newCe_code, $newItems, $newCeYear)
    {
        $sql = "UPDATE " . $this->table . " SET students_id = '$newStudents_id', ce_names = '$newCe_name', ce_codes = '$newCe_code', items = '$newItems',ce_years = '$newCeYear' WHERE id_ce = $id";

        $isUpdated = $conn->query($sql);

        if ($isUpdated) {
            return "<br> Students is updated!";
        } else {
            return "<br> Update process has failed!";
        }
    }
    // dzeš  jeb ierakstu no datubāzes
    public function deleteCertificates($conn, $id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE id_ce = $id";
        $isDeleted = $conn->query($sql);
        if ($isDeleted) {
            return "<br> Students is deleted!";
        } else {
            return "<br> Delete process has failed!";
        }
    }
    //atalasa datus pēc indifikātora un atgiež indifikātora vertību
    public function getCertificatesID($conn, $students, $ce_name, $ce_code, $items, $ce_year): int
    {
        $sql = "SELECT id_ce FROM " . $this->table . " WHERE students_id = '$students' AND ce_names = '$ce_name'
        AND ce_codes = '$ce_code' AND items = '$items' AND ce_years = '$ce_year'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $id = $row['id_ce'];
        return $id;
    }
    //atlasa datus priekšs indifikātora un atgiež izvētas vertības
    public function getCertificatesByID($conn, $id): Certificates
    {
        $sql = "SELECT students_id, ce_names ,ce_codes,items,ce_years FROM " . $this->table . " WHERE id_ce = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $students = $row['students_id'];
        $ce_name = $row['ce_names'];
        $ce_code =  $row['ce_codes'];
        $items =  $row['items'];
        $ce_year = $row['ce_years'];
        $this->certificate = new Certificates($students, $ce_name, $ce_code, $items, $ce_year);
        return $this->certificate;
    }
    
    //saglaba datus masīva un atgiežs masīva saglabātas vērtības
    public function getAllCertificates($conn): array
    {
        $sql = "SELECT * FROM " . $this->table;
        $certificates = array();
        $result = $conn->query($sql);
        while ($row = $result->fetch_object()) {
            $id = $row->id_ce;
            $students = $row->students_id;
            $ce_name = $row->ce_names;
            $ce_code = $row->ce_codes;
            $items = $row->items;
            $ce_year = $row->ce_years;
            $this->certificate = new Certificates($students, $ce_name, $ce_code, $items, $ce_year);
            $this->certificate->setID($id);
            array_push($certificates, $this->certificate);
        }
        return $certificates;
    }
}
