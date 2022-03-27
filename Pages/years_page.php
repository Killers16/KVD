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

        $yearsService = new YearsService();
        
        ?>
    </head>
    <body>
  <h1>Gads dati</h1>
            <form method="get">
               Gada Skaitlis: <input type="text" name="name" /><br>
                <br>
                Gads: <select name="year">
                    <?php
                        $years = $yearsService->getAllYears($conn);
                        
                        foreach($years as $y){
                            $names = $y->getNames();
                            
                            echo "<option>$names</option>";
                        }
                    ?>
                </select>
                
                <br>
                <br>
                <input type="submit" name="newYears" value="Pievienot" /> 
                <input type="submit" name="editYears" value="Labot" /> 
                <input type="submit" name="deleteYears" value="Dzēst" />
            </form>
            <br>
            
            <?php
                if(isset($_GET['newYears'])){
                    if($_GET['name'] != ""){
                        $names = $_GET['name'];
 
                            $info = $yearsService->insertYears($conn, $names);

                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['editYears'])){
                  
                    
                    // Ar IF - ELSE konstrukciju - labot ieraksta visus laukus vispirms, katru individuāli pēc tam
                    if($_GET['name'] != ""){
                        $year = $_GET['year'];
                        
                        $newNames = $_GET['name'];
                        
                        $id = $yearsService->getYearsID($conn, $year);
                        
                        $info = $yearsService->updateYearsNames($conn, $id, $newNames);
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
            
                if(isset($_GET['deleteYears'])){
                    $year = $_GET['year'];
                        
                    $id = $yearsService->getYearsID($conn, $year);
                        
                    $info = $yearsService->deleteYears($conn, $id);
                    
                    header('Location: index.php');
                }
            ?>
            
            <table>
                <tr>
                    <th>Nr.</th>
                    <th>Klase</th>
                </tr>
                <?php
                    $years = $yearsService->getAllYears($conn);
                    $i = 1;
                        
                    foreach($years as $y){
                        $names = $y->getNames();
                        
                            
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