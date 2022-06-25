<?php   
header("Content-type: application/vnd.ms-excel; charset=UTF-8");  
header("Content-Disposition: attachment; filename=Students_database.xls");  
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
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
echo "ID" . "\t " . "Vārds" . "\t" . "Uzvārds" . "\t". "Personas kods" . "\t" . "Kurss" . "\t". "Profesija" . "\t" . "Iestāšanas Gads" . "\t"
. "Tel. Numurs" . "\t" . "Ieprekšeja skola" . "\t"."\n";
    while($row = $result->fetch_assoc()) {
        echo $row['id_student']."\t".$row['firstName']."\t". $row['lastName']."\t".$row['codes']."\t". $row['courses']."\t".$row['professions']."\t". $row['years']."\t".$row['phones']."\t". $row['lastSchools']."\t"."\n";
    }
}
?>



  
