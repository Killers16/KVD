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

        $persCodesService = new PersCodesService();
        
        ?>
    </head>
    <body>
    <h1>Personas koda dati</h1>
            <form method="get">
               Audzekņa Personas kods: <input type="text" name="code" /><br>
                <br>
                Personas kods: <select name="persCode">
                    <?php
                        $pers_codes = $persCodesService->getAllPersCodes($conn);
                        
                        foreach($pers_codes as $p){
                            $codes = $p->getCodes();
                            
                            echo "<option>$codes</option>";
                        }
                    ?>
                    
                </select>

                <br>
                <br>
                <input type="submit" name="newPersCode" value="Pievienot"/>
                <input type="submit" name="editPersCode" value="Labot"/>
                <input type="submit" name="deletePersCode" value="Dzēst"/>
            </form>
            <br>
            
            <?php
                if(isset($_GET['newPersCode'])){
                    if($_GET['code'] != ""){
                        $codes = $_GET['code'];
                        
                        
                        $info = $persCodesService->insertPersCodes($conn, $codes);
                        
                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['editPersCode'])){
                    if($_GET['code'] != ""){
                        $persCode = $_GET['persCode'];
                        
                        $newCode = $_GET['code'];
                        
                        $id = $persCodesService->getPersCodesID($conn, $persCode);
                        
                        $info = $persCodesService->updatePersCodes($conn, $id, $newCode);
                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['deletePersCode'])){
                    $persCode = $_GET['persCode'];
                        
                    $id = $persCodesService->getPersCodesID($conn, $persCode);
                        
                    $info = $persCodesService->deletePersCodes($conn, $id);
                    
                    header('Location: index.php');
                }
            ?>
            
            <table>
                <tr>
                    <th>Nr.</th>
                    <th>Gads</th>
                </tr>
                <?php
                    $pers_codes = $persCodesService->getAllPersCodes($conn);
                    $i = 1;
                        
                    foreach($pers_codes as $p){
                        $codes = $p->getCodes();
                            
                        echo "<tr>
                                <td>$i</td>
                                <td>$codes</td>
                            </tr>";
                        $i++;
                    }
                ?>
            </table>
        
                </body>
                </html>