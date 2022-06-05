<?php  
$conn = new mysqli('localhost', 'admin', 'admin');  
mysqli_select_db($conn, 'KVD');  
$sql = "SELECT * FROM certificates";  
$setRec = mysqli_query($conn, $sql);  
$columnHeader = '';  
$columnHeader = "Id" . "\t" . "Vards/Uzvārds" . "\t"."Sertefikāta izglitība" . "\t" . "Kods" . "\t". "Priekšmets" . "\t" . "Gads". "\t";  
$setData = '';  
  while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
  
header("Content-type: text/html; charset=utf-8");  
header("Content-Disposition: attachment; filename=Сertificates_database.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";
