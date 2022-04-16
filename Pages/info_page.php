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
        include_once('extras/includes.php');
        $infoService = new InfoService();
        
        ?>
    </head>
    <body>
    <h1>Info </h1>
            <form method="get">
                Nosaukums: <input type="text" name="gNos" /><br>
                <br>
                    Info: <select name="info">
                    <?php
                       $infos = $infoService->getAllInfos($conn);
                        
                        $studentsService = new StudentsService();
                        $courseService = new CoursesService();
                        $professionsService = new ProfessionsService();
                       
                        foreach($infos as $i){
                          
                         
                            $fName = $i->getStudent_id()->getFirstName();
                            $lName = $i->getStudent_id()->getLastName();
                            $code = $i ->getStudent_id()->getCodes();
                            $year = $i ->getStudent_id()->getYears();
                            $course = $i ->getCourse_id()->getNames();
                            $profession = $i ->getProfession_id()->getNames();  
                            
                            
                            echo "<option> $fName $lName  $code $year $course $profession</option>";
                                
                        }
                        
                    ?>
                    </select><br />
                   
                   
                
                 
                <input type="submit" name="editCourses" value="Labot" /> 
                <input type="submit" name="deleteCourses" value="Dzēst" />

            </form>
            <br>
            <form method="post" action="extras/export_info.php">
             <input type="submit" name="export" class="btn btn-success" value="Export" />
            </form>

                
            
            <?php
                
            
                if(isset($_GET['editCourses'])){
                    if($_GET['gNos'] != ""){
                        $nos = $_GET['gNos'];
                        
                        $newCnames = $_GET['gNos'];
                        
                        $id = $infoService->get($conn, $nos);
                        
                        $info = $infoService->updateInfosCourse($conn, $id, $newCnames);
                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['deleteGads'])){
                    $gads = $_GET['gads'];
                        
                    $id = $gadsService->getGadsID($conn, $gads);
                        
                    $info = $gadsService->deleteGads($conn, $id);
                    
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
                    <th>Kurss</th>
                    <th>Profesija</th>
                </tr>
                <?php
                   
                   $infos = $infoService->getAllInfos($conn);
                    $n = 1;
                        
                    foreach($infos as $i){
                            $fName = $i->getStudent_id()->getFirstName();
                            $lName = $i->getStudent_id()->getLastName();
                            $code = $i ->getStudent_id()->getCodes();
                            $year = $i ->getStudent_id()->getYears();
                            $course = $i ->getCourse_id()->getNames();
                            $profession = $i ->getProfession_id()->getNames();  
                        echo "<tr>
                                <td>$n</td>
                                <td>$fName</td>
                                <td>$lName</td>
                                <td>$code</td>
                                <td>$year</td>
                                <td>$course</td>
                                <td>$profession</td>

                            </tr>";
                        $n++;
                    }
                ?>
            </table>
            
        
                </body>
                </html>