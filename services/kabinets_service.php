<?php
    include_once('../data/kabinets.php');

    class KabinetsService{
        private $kabinets;
        
        private $table = "kabineti";
/* 
    CRUD datu bāzes apstrāde
    C - Create  (Create - struktūras veidošana; Insert - satura ievietošana) 
    R - Read    (Select - satura atlase)
    U - Update  (Alter - struktūras koriģēšana; Update - satura koriģēšana)
    D - Delete  (Drop - struktūras dzēšana; Delete - satura dzēšana)
*/
        
/* C */ public function insertKabinets($conn, $nos){
            $kabinetsExists = false;
            $kabineti = $this->getAllKabineti($conn);
            foreach($kabineti as $k){
                $nosaukums = $k->getNosaukums();
                
                if($nosaukums == $nos){
                    $kabinetsExists = true;
                    break;
                }
            }
            
            if(!$kabinetsExists){
               $sql = "INSERT INTO ".$this->table."(nosaukums) VALUES ('$nos')";
            
                $isInserted = $conn->query($sql);

                if($isInserted){
                    return "<br> New Kabinets is added in system!";
                }
                else{
                    return "<br> Insertation process has failed!";
                } 
            }
            else{
                return "<br> Kabinets $nos already exist in DB!";
            }
            
        }
        
/* U */ public function updateKabinets($conn, $id, $newNos){
            $sql = "UPDATE ".$this->table." SET nosaukums = '$newNos' WHERE id_kabinets = $id";
            
            $isUpdated = $conn->query($sql);
            
            if($isUpdated){
                return "<br> Kabinets is updated!";
            }
            else{
                return "<br> Update process has failed!";
            }
        }
        
/* D */ public function deleteKabinets($conn, $id){
            $sql = "DELETE FROM ".$this->table." WHERE id_kabinets = $id";
            
            $isDeleted = $conn->query($sql);
            
            if($isDeleted){
                return "<br> Kabinets is deleted!";
            }
            else{
                return "<br> Delete process has failed!";
            }
        }
        
/* R */ public function getKabinetsID($conn, $nos):int{
            $sql = "SELECT id_kabinets FROM ".$this->table." WHERE nosaukums = '$nos'";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['id_kabinets'];
            
            return $id;
        }
        
        public function getKabinetsByID($conn, $id):Kabinets{
            $sql = "SELECT nosaukums FROM ".$this->table." WHERE id_kabinets = $id";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $nos = $row['nosaukums'];
            
            $this->kabinets = new Kabinets($nos);
            
            return $this->kabinets;
        }
        
        public function getKabinetsByNos($conn, $nos):Kabinets{
            $sql = "SELECT id_kabinets, nosaukums FROM ".$this->table." WHERE nosaukums = '$nos'";
            
            // izvelk datus no DB
            $result = $conn->query($sql);
            
            // no DB iegūtos datus pārveido asociatīvā masīva formātā, kur atslēgu nosaukumi sakrīt ar vaicājuma SELECT daļā uzskaitīto lauku nosaukumiem
            $row = $result->fetch_assoc();
            
            // saglabā katra lauka vērtību savā mainīgajā/objektā
            $id = $row['id_kabinets'];
            $nosaukums = $row['nosaukums'];
            
            // izveido atbilstošās klases objektu un, ja nepieciešams, ar set() metodēm uzstāda vērtības, ko neuzstādīja ar __construct() palīdzību
            $this->kabinets = new Kabinets($nosaukums);
            $this->kabinets->setID($id);
            
            return $this->kabinets;
        }
        
        public function getAllKabineti($conn):array{
            $sql = "SELECT * FROM ".$this->table;
            
            $kabineti = array();
            
            // izvelk datus no DB
            $result = $conn->query($sql);
            
            // no DB iegūtos datus pārveido objetu formātā, kur objekta attribūtu nosaukumi sakrīt ar vaicājuma SELECT daļā uzskaitīto lauku nosaukumiem
            while($row = $result->fetch_object()){
                // saglabā katra lauka vērtību savā mainīgajā/objektā
                $id = $row->id_kabinets;
                $nos = $row->nosaukums;
                
                // izveido atbilstošās klases objektu un, ja nepieciešams, ar set() metodēm uzstāda vērtības, ko neuzstādīja ar __construct() palīdzību
                $this->kabinets = new Kabinets($nos);
                $this->kabinets->setID($id);
                
                array_push($kabineti, $this->kabinets);
            }
            
            return $kabineti;
        }
    }
?>