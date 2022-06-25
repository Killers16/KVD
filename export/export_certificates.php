<?php   
header("Content-type: application/vnd.ms-excel; charset=UTF-8");  
header("Content-Disposition: attachment; filename=Certificates_database.xls");  
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
$sql = "SELECT `students_id` ,`students`.`firstName` as 'vards',`students`.`lastName` as 'uzvards',`ce_names`,`ce_codes`,`items`,`ce_years` FROM certificates
INNER JOIN `students` ON `students`.`id_student`=`certificates`.`students_id`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
echo "ID" . "\t " . "Vārds" . "\t" . "Uzvārds" . "\t". "Sertifikāta izglitība" . "\t". "Sertifikāta Nr." . "\t". "Priekšmeti" . "\t". "Izsniegšanas Gads" . "\t"."\n";
    while($row = $result->fetch_assoc()) {
        echo $row['students_id']."\t".$row['vards']."\t". $row['uzvards']."\t".$row['ce_names']."\t".$row['ce_codes']."\t".$row['items']."\t".$row['ce_years']."\t"."\n";
    }
}
?>

