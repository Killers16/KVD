<?php
ini_set('display_errors', '1');
?>
<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css" />

    
        <?php
         include_once('extras/includes.php');
            $studentsService = new StudentsService();
            
           
        ?>
    </head>
    <body>
    
            <h1>Audzekņa dati</h1>
            <form method="get">
            
                Vārds: <input type="text" name="fname"  /><br>
                Uzvārds: <input type="text" name="lname"  /><br>
                Personas kods: <input type="text" name="code"/> </br>
                Iestāšanas gads: <input type="text" name="year"/><br>
                Audzeknis: <select name="student" >

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
            <form method="post" action="extras/export_students.php">
             <input type="submit" name="export" class="btn btn-success" value="Export" />
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
                   

                        $newfName = $_GET['fname'];
                        $newlName = $_GET['lname'];
                        $newCode = $_GET['code'];
                        $newYear = $_GET['year'];
                       
                        
                        $id = $studentsService->getStudentsID($conn, $oldfname, $oldlname,$oldCode,$oldYear);
                        
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
                // Filter
                if(isset($_POST['search']))
                {
                    $valueToSearch = $_POST['valueToSearch'];
                    $query = "SELECT * FROM `students` WHERE CONCAT(`firstName`, `lastName`, `years`,`codes`) LIKE '%".$valueToSearch."%'";
                    $search_result = filterTable($query);

                }
                 else {
                    $query = "SELECT * FROM `students`";
                    $search_result = filterTable($query);
                }

                // function to connect and execute the query
                function filterTable($query)
                {
                    $connect = mysqli_connect("localhost", "root", "root", "KVD");
                    $filter_Result = mysqli_query($connect, $query);
                    return $filter_Result;
                }
            ?>
            
            <form action="" method="post">
                        <input type="text" name="valueToSearch" placeholder="Value To Search">
                        <input type="submit" name="search" value="Filter" class="margin:5px;">
                        <input type="submit" name="search" value="Cancel" class="margin:5px;"><br><br>

                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Uzvārds</th>
                                <th>Gads</th>
                                <th>Personas Kods</th>
                            </tr>

                            <?php while($row = mysqli_fetch_array($search_result)):?>
                            <tr>
                                <td><?php echo $row['firstName'];?></td>
                                <td><?php echo $row['lastName'];?></td>
                                <td><?php echo $row['years'];?></td>
                                <td><?php echo $row['codes'];?></td>
                            </tr>
                            <?php endwhile;?>
                        </table>
                    </form>


    </body>
    </html>