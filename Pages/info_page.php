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

        $nodarbibaService = new NodarbibaService();
        
        ?>
    </head>
    <body>
    <h1>info </h1>
            <form method="get">
                Nosaukums: <input type="text" name="gNos" /><br>
                <br>
                info: <select name="nodarbiba">
                    <?php
                        $nodarbiba = $nodarbibaService->getAllNodarbibas($conn);
                        
                        foreach($nodarbiba as $n){
                            $klaseID = $n->getKlaseID($nos);
                            $nos = $klaseID ->getNosaukums();
                            echo "<option>$nos </option>";
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
            
            <table>
                <tr>
                    <th>Nr.</th>
                    <th>Gads</th>
                </tr>
                <?php
                    $gadi = $gadsService->getAllGadi($conn);
                    $i = 1;
                        
                    foreach($gadi as $g){
                        $nos = $g->getNosaukums();
                            
                        echo "<tr>
                                <td>$i</td>
                                <td>$nos</td>
                            </tr>";
                        $i++;
                    }
                ?>
            </table>
        
                </body>
                </html>