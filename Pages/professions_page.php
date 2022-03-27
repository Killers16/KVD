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

        $professionsService = new ProfessionsService();
        
        ?>
    </head>
    <body>
    <h1>Priekšmetu dati</h1>
            <form method="get">
                Profesijas Nosaukums: <input type="text" name="name" /><br>
                </select>
                <br>
                <br>
                Profesija: <select name="profession">
                    <?php
                        $professions = $professionsService->getAllProfessions($conn);
                        
                        foreach($professions as $p){
                            $names = $p->getNames();
                            
                            echo "<option>$names</option>";
                        }
                    ?>
                </select>
                
                <br>
                <br>
                <input type="submit" name="newProfessions" value="Pievienot" /> 
                <input type="submit" name="editProfessions" value="Labot" /> 
                <input type="submit" name="deleteProfessions" value="Dzēst" />
            </form>
            <br>
            
            <?php
                if(isset($_GET['newProfessions'])){
                    if($_GET['name'] != ""){
                        $names = $_GET['name'];
                        
                        
                        $info = $professionsService->insertProfessions($conn,$names);
                        
                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['editProfessions'])){
                    if($_GET['name'] != ""){
                        $profession = $_GET['profession'];
                        
                        $newNames = $_GET['name'];
                        
                        $id = $professionsService->getProfessionsID($conn, $profession);
                        
                        $info = $professionsService->updateProfessionsNames($conn, $id, $newNames);
                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['deleteProfessions'])){
                    $profession = $_GET['profession'];
                        
                    $id = $professionsService->getProfessionsID($conn, $profession);
                        
                    $info = $professionsService->deleteProfessions($conn, $id,);
                    
                    header('Location: index.php');
                }
            ?>
            
            <table>
                <tr>
                    <th>Nr.</th>
                    <th>Mācību priekšmets</th>
                </tr>
                <?php
                    $professions = $professionsService->getAllProfessions($conn);
                    $i = 1;
                        
                    foreach($professions as $p){
                        $names = $p->getNames();
                            
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