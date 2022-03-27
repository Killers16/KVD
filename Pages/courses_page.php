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

        $coursesService = new CoursesService();
        
        ?>
    </head>
    <body>
  <h1>Kursa dati</h1>
            <form method="get">
                Nosaukums: <input type="text" name="name" /><br>
                <br>
                Kurss: <select name="course">
                    <?php
                        $courses = $coursesService->getAllCourses($conn);
                        
                        foreach($courses as $c){
                            $names = $c->getNames();
                            
                            echo "<option>$names</option>";
                        }
                    ?>
                </select>
                
                <br>
                <br>
                <input type="submit" name="newCourses" value="Pievienot" /> 
                <input type="submit" name="editCourses" value="Labot" /> 
                <input type="submit" name="deleteCourses" value="Dzēst" />
            </form>
            <br>
            
            <?php
                if(isset($_GET['newCourses'])){
                    if($_GET['name'] != ""){
                        $names = $_GET['name'];
 
                            $info = $coursesService->insertCourses($conn, $names);

                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['editCourses'])){
                  
                    
                    // Ar IF - ELSE konstrukciju - labot ieraksta visus laukus vispirms, katru individuāli pēc tam
                    if($_GET['name'] != ""){
                        $course = $_GET['course'];
                        
                        $newNames = $_GET['name'];
                        
                        $id = $coursesService->getCoursesID($conn, $course);
                        
                        $info = $coursesService->updateCoursesNames($conn, $id, $newNames);
                    }

                    
                    /*  Ar IF konstrukcijām - sekundāros vispirms, primāros pēc tam
                        if($skolotajs != "-- Skolotājs --"){
                            $klase = $_GET['klase'];

                            $vards = explode(" ", $skolotajs)[0];
                            $uzvards = explode(" ", $skolotajs)[1];

                            $id = $klaseService->getKlaseID($conn, $klase);

                            $info = $klaseService->updateKlaseAudz($conn, $id, $vards, $uzvards);
                        }

                        if($_GET['klaseNos'] != ""){
                            $klase = $_GET['klase'];

                            $newKlase = $_GET['klaseNos'];

                            $id = $klaseService->getKlaseID($conn, $klase);

                            $info = $klaseService->updateKlaseNos($conn, $id, $newKlase);
                        }
                    */
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['deleteCourses'])){
                    $course = $_GET['course'];
                        
                    $id = $coursesService->getCoursesID($conn, $course);
                        
                    $info = $coursesService->deleteCourses($conn, $id);
                    
                    header('Location: index.php');
                }
            ?>
            
            <table>
                <tr>
                    <th>Nr.</th>
                    <th>Klase</th>
                </tr>
                <?php
                    $courses = $coursesService->getAllCourses($conn);
                    $i = 1;
                        
                    foreach($courses as $c){
                        $names = $c->getNames();
                        
                            
                        echo "<tr>
                                <td>$i</td>
                                <td>$names</td>
                            </tr>";
                        $i++;
                    }
                ?>
            </table>




    </body>
    </html>