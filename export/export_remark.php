
<?php  
$conn = new mysqli('localhost', 'admin', 'admin');  
mysqli_select_db($conn, 'KVD');  
$setSql = "SELECT `students_id` ,concat(`students`.`firstName`,' ',`students`.`lastName`) as 'students',`names` FROM remarks
INNER JOIN `students` ON	`students`.`id_student`=`remarks`.`students_id`";  
$setRec = mysqli_query($conn, $setSql);  
$columnHeader = '';  
$columnHeader = "Sr NO" . "\t" . "User Name" . "\t" . "Password" . "\t";  
$setData = '';  
while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value['id'] . '"' . "\t".'"' . $value['students'] . '"'."\t".'"' . $value['names'] . '"';  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
header("Content-type: multipart/form-data; charset UTF-8");   
header("Content-Disposition: attachment; filename = User_Detail_Reoprt.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  
echo ucwords($columnHeader) . "\n" . $setData . "\n";  
?>