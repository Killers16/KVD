<?php

    class PersCodesService{
        private $persCode;
        
        private $table = "pers_codes";
/* 
    CRUD datu bāzes apstrāde
    C - Create  (Create - struktūras veidošana; Insert - satura ievietošana) 
    R - Read    (Select - satura atlase)
    U - Update  (Alter - struktūras koriģēšana; Update - satura koriģēšana)
    D - Delete  (Drop - struktūras dzēšana; Delete - satura dzēšana)
*/
        
/* C */ public function insertPersCodes($conn, $codes){
            $persCodeExists = false;
            $pers_codes = $this->getAllPersCodes($conn);
            foreach($pers_codes as $p){
                $code = $p->getCodes();
                
                if($codes == $code){
                    $persCodeExists = true;
                    break;
                }
            }
            
            if(!$persCodeExists){
               $sql = "INSERT INTO ".$this->table."(codes) VALUES ('$codes')";
            
                $isInserted = $conn->query($sql);

                if($isInserted){
                    return "<br> New Persons code is added in system!";
                }
                else{
                    return "<br> Insertation process has failed!";
                } 
            }
            else{
                return "<br> Persons code $codes already exist in DB!";
            }
            
        }
        
/* U */ public function updatePersCodes($conn, $id, $newCode){
            $sql = "UPDATE ".$this->table." SET codes = '$newCode' WHERE id_pers = $id";
            
            $isUpdated = $conn->query($sql);
            
            if($isUpdated){
                return "<br> Persons code is updated!";
            }
            else{
                return "<br> Update process has failed!";
            }
        }
        
/* D */ public function deletePersCodes($conn, $id){
            $sql = "DELETE FROM ".$this->table." WHERE id_pers = $id";
            
            $isDeleted = $conn->query($sql);
            
            if($isDeleted){
                return "<br> Persons code is deleted!";
            }
            else{
                return "<br> Delete process has failed!";
            }
        }
        
/* R */ public function getPersCodesID($conn, $codes):int{
            $sql = "SELECT id_pers FROM ".$this->table." WHERE codes = '$codes'";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $id = $row['id_pers'];
            
            return $id;
        }
        
        public function getPersCodesByID($conn, $id):PersCodes{
            $sql = "SELECT codes FROM ".$this->table." WHERE id_pers = $id";
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $codes = $row['codes'];
            
            $this->persCode = new PersCodes($codes);
            
            return $this->kabinets;
        }
        
        public function getKabinetsByCode($conn, $codes):PersCodes{
            $sql = "SELECT id_pers, codes FROM ".$this->table." WHERE codes = '$codes'";
            
            // izvelk datus no DB
            $result = $conn->query($sql);
            
            // no DB iegūtos datus pārveido asociatīvā masīva formātā, kur atslēgu nosaukumi sakrīt ar vaicājuma SELECT daļā uzskaitīto lauku nosaukumiem
            $row = $result->fetch_assoc();
            
            // saglabā katra lauka vērtību savā mainīgajā/objektā
            $id = $row['id_pers'];
            $codes = $row['codes'];
            
            // izveido atbilstošās klases objektu un, ja nepieciešams, ar set() metodēm uzstāda vērtības, ko neuzstādīja ar __construct() palīdzību
            $this->persCode = new PersCodes($codes);
            $this->persCode->setID($id);
            
            return $this->persCode;
        }
        
        public function getAllPersCodes($conn):array{
            $sql = "SELECT * FROM ".$this->table;
            
            $pers_codes = array();
            
            // izvelk datus no DB
            $result = $conn->query($sql);
            
            // no DB iegūtos datus pārveido objetu formātā, kur objekta attribūtu nosaukumi sakrīt ar vaicājuma SELECT daļā uzskaitīto lauku nosaukumiem
            while($row = $result->fetch_object()){
                // saglabā katra lauka vērtību savā mainīgajā/objektā
                $id = $row->id_pers;
                $codes = $row->codes;
                
                // izveido atbilstošās klases objektu un, ja nepieciešams, ar set() metodēm uzstāda vērtības, ko neuzstādīja ar __construct() palīdzību
                $this->persCode = new PersCodes($codes);
                $this->persCode->setID($id);
                
                array_push($pers_codes, $this->persCode);
            }
            
            return $pers_codes;
        }
    }
?>