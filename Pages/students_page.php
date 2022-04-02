<?php
ini_set('display_errors', '1');
?>
<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css" />
        <script src="js/script.js"></script>
        <?php
        
            $studentsService = new StudentsService();
           
            
        ?>
    </head>
    <body>
    
            <h1>Audzekņa dati</h1>
            <form method="get">
                Vārds: <input type="text" name="fname" /><br>
                Uzvārds: <input type="text" name="lname" /><br>
                Personas kods: <input type="text" name="code" placeholder="Personas koda 1 daļa"/><br>
                Iestāšanas gads: <input type="text" name="year" /><br>
                Audzeknis: <select name="student">

                    <?php
                        $students = $studentsService->getAllStudents($conn);
                        
                        foreach($students as $s){
                            $fName = $s->getFirstName();
                            $lName = $s->getLastName();
                            $code = $s->getCodes();
                            $year = $s->getYears();

                            echo "<option>$fName $lName $code $year</option>";
                            
                        }
                    ?>
                </select>
                <br>
                <br>
                <input type="submit" name="newStudents" value="Pievienot" /> 
                <input type="submit" name="editStudents" value="Labot" /> 
                <input type="submit" name="deleteStudents" value="Dzēst" />
            </form>
            <br>
            
            <?php
                if(isset($_GET['newStudents'])){
                    if($_GET['fname'] != "" && $_GET['lname'] != "" && $_GET['code'] != "" && $_GET['year'] != ""){
                        $firstName = $_GET['fname'];
                        $lastName = $_GET['lname'];
                        $codes = $_GET['code'];
                        $years = $_GET['year'];
                        $info = $studentsService->insertStudents($conn, $firstName, $lastName,$codes, $years);
                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['editStudents'])){
                    if($_GET['fname'] != "" && $_GET['lname'] != "" && $_GET['code'] != "" && $_GET['year'] != ""){
                        $student = $_GET['student'];
                        $oldfname = explode(" ", $student)[0];
                        $oldlname = explode(" ", $student)[1];
                        
                    
                        $oldCode = explode(" ", $student)[2];
                        $oldYear = explode(" ", $student)[3];
                    echo $student;

                        $newfName = $_GET['fname'];
                        $newlName = $_GET['lname'];
                        $newCode = $_GET['code'];
                        $newYear = $_GET['year'];
                       
                        
                        $id = $studentsService->getStudentsId($conn, $oldfname, $oldlname,$oldCode,$oldYear);
                        
                        $info = $studentsService->updateStudents($conn, $id, $newfName, $newlName,$newCode,$newYear);
                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['deleteStudents'])){
                    $student = $_GET['student'];
                    $fName = explode(" ", $student)[0];
                    $lName = explode(" ", $student)[1];

                    $code = explode(" ", $student)[2];
                    $year = explode(" ", $student)[3];
                        
                    $id = $studentsService->getStudentsID($conn, $fName, $lName,$code,$year);
                        
                    $info = $studentsService->deleteStudents($conn, $id);
                    
                    header('Location: index.php');
                }
            ?>
            
            <table>
                <tr>
                    <th>Nr.</th>
                    <th>Vārds</th>
                    <th>Uzvārds</th>
                    <th>Personas kods</th>
                    <th>Gads</th>
                    
                </tr>
                <?php
                   
                    $students = $studentsService->getAllStudents($conn);
                    $i = 1;
                        
                    foreach($students as $s){
                        $fName = $s->getFirstName();
                        $lName = $s->getLastName();
                        $code = $s->getCodes();
                        $year = $s->getYears();    
                        echo "<tr>
                                <td>$i</td>
                                <td>$fName</td>
                                <td>$lName</td>
                                <td>$code</td>
                                <td>$year</td>

                            </tr>";
                        $i++;
                    }
                ?>
            </table>
        

    </body>
    </html>