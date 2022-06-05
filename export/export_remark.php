<?php  
$conn = new mysqli('localhost', 'admin', 'admin');  
mysqli_select_db($conn, 'KVD');  
$sql = "SELECT students_id ,concat(`students`.`firstName`,' ',`students`.`lastName`) as 'students',`names` FROM remarks
INNER JOIN `students` ON	`students`.`id_student`=`remarks`.`students_id`";  
$setRec = mysqli_query($conn, $sql);  
$columnHeader = '';  
$columnHeader = "Id" . "\t" . "Vards/Uzvards" . "\t" . "Piezīme" . "\t";  
$setData = '';  
  while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
  
header("Content-type: multipart/form-data; charset=ISO-3166-1");  

header("Content-Disposition: attachment; filename=Remarks_database.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";
