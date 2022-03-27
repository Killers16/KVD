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

        $infoService = new InfoService();
        
        ?>
    </head>
    <body>
    <h1>Info </h1>
            <form method="get">
                Nosaukums: <input type="text" name="gNos" /><br>
                <br>
                info: <select name="infos">
                    <?php
                        $info = $infoService->getAllInfos($conn);
                        
                        foreach($info as $i){
                            $studentID = $i->getStudentID($fName, $lName);
                            $fName = $studentID ->getFirstName();
                            $lName = $studentID ->getLastName();

                            $courseID = $i->getCoursesID($names);
                            $Cname = $courseID ->getNames();

                            $professionID = $i->getProfessionID($names);
                            $pName = $professionID->getNames();

                            $yearID = $i->getYearID($names);
                            $yName = $yearID ->getNames();

                            $persCodeID = $i->getPersCodesID($codes);
                            $persName = $persCodeID ->getCodes();

                            echo "<option>$fName $lName $Cname $profName $yName $persName</option>";
                        }
                    ?>
                    
                </select>

                <br>
                <br>
                <input type="submit" name="newGads" value="Pievienot"/>
                <input type="submit" name="editGads" value="Labot"/>
                <input type="submit" name="deleteGads" value="Dzēst"/>
            </form>
            <br>
            
            <?php
                if(isset($_GET['newGads'])){
                    if($_GET['gNos'] != ""){
                        $gNos = $_GET['gNos'];
                        
                        
                        $info = $gadsService->insertGads($conn, $gNos);
                        
                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['editGads'])){
                    if($_GET['gNos'] != ""){
                        $gads = $_GET['gads'];
                        
                        $newGads = $_GET['gNos'];
                        
                        $id = $gadsService->getGadsID($conn, $gads);
                        
                        $info = $gadsService->updateGads($conn, $id, $newGads);
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
            
            
        
                </body>
                </html>