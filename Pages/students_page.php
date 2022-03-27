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
                Audzeknis: <select name="student">

                    <?php
                        $students = $studentsService->getAllStudents($conn);
                        
                        foreach($students as $s){
                            $fName = $s->getFirstName();
                            $lName = $s->getLastName();
                            
                            echo "<option>$fName $lName</option>";
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
                    if($_GET['fname'] != "" && $_GET['lname'] != ""){
                        $firstName = $_GET['fname'];
                        $lastName = $_GET['lname'];
                        
                        $info = $studentsService->insertStudents($conn, $firstName, $lastName);
                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['editStudents'])){
                    if($_GET['fname'] != "" && $_GET['lname'] != ""){
                        $student = $_GET['student'];
                        $oldfname = explode(" ", $student)[0];
                        $oldlname = explode(" ", $student)[1];
                        
                        $newfName = $_GET['fname'];
                        $newlName = $_GET['lname'];
                        
                        $id = $studentsService->getStudentsId($conn, $oldfname, $oldlname);
                        
                        $info = $studentsService->updateStudents($conn, $id, $newfName, $newlName);
                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['deleteStudents'])){
                    $student = $_GET['student'];
                    $fName = explode(" ", $student)[0];
                    $lName = explode(" ", $student)[1];
                        
                    $id = $studentsService->getStudentsID($conn, $fName, $lName);
                        
                    $info = $studentsService->deleteStudents($conn, $id);
                    
                    header('Location: index.php');
                }
            ?>
            
            <table>
                <tr>
                    <th>Nr.</th>
                    <th>Vārds</th>
                    <th>Uzvārds</th>

                    
                </tr>
                <?php
                   
                    $students = $studentsService->getAllStudents($conn);
                    $i = 1;
                        
                    foreach($students as $s){
                        $fName = $s->getFirstName();
                        $lName = $s->getLastName();
                            
                        echo "<tr>
                                <td>$i</td>
                                <td>$fName</td>
                                <td>$lName</td>

                            </tr>";
                        $i++;
                    }
                ?>
            </table>
        

    </body>
    </html>