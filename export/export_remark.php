<?php   
header("Content-type: application/vnd.ms-excel;charset=UTF-8 ");  
header("Content-Disposition: attachment; filename=Remarks_database.xls");  
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "KVD";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT `students_id` ,`students`.`firstName` as 'vards',`students`.`lastName` as 'uzvards',`names` FROM remarks
INNER JOIN `students` ON	`students`.`id_student`=`remarks`.`students_id`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
echo "ID" . "\t " . "Vārds" . "\t" . "Uzvārds" . "\t". "Piezīmes" . "\t"."\n";
    while($row = $result->fetch_assoc()) {
        echo $row['students_id']."\t".$row['vards']."\t". $row['uzvards']."\t".$row['names']."\t"."\n";
    }
}
?>

