<?php  
$conn = new mysqli('localhost', 'admin', 'admin');  
mysqli_select_db($conn, 'KVD');  
$sql = "SELECT * FROM students";  
$setRec = mysqli_query($conn, $sql);  
$columnHeader = '';  
$columnHeader = "Id" . "\t" . "Vards" . "\t" . "Uzvārds" . "\t"."Kurss" . "\t" . "Profesija" . "\t" . "Gads". "\t";  
$setData = '';  
  while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
  
header("Content-type: application/vnd.ms-excel;");  
header("Content-Disposition: attachment; filename=Students_database.xls");  
header("Pragma: no-cache");
  
header("Expires: 0");  
  echo pack("CCC",0xef,0xbb,0xbf);
  echo ucwords($columnHeader) . "\n" . $setData . "\n";
