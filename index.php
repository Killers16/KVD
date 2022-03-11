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
            ob_start();
            header('Content-Type: text/html; charset=utf-8');
            include_once('extras/includes.php');
        
            $hostname = "localhost";
            $user = "root";
            $database = "stundu_saraksts";

            $conn = new mysqli($hostname, $user, 'root', $database);

            if($conn->connect_error){
                die("Connection failed!".$conn->connect_error);
            }
        
            $skolotajsService = new SkolotajsService();
            $prieksmetsService = new PrieksmetsService();
            $spService = new SpService();
            $klaseService = new KlaseService();
        ?>
    </head>
    <body>
        <div class="tab">
            <button id="defaultOpen" class="tablinks" onclick="openSection(event, 'skolotaji')">Skolotāji</button>
            <button class="tablinks" onclick="openSection(event, 'prieksmeti')">Priekšmeti</button>
            <button class="tablinks" onclick="openSection(event, 'klases')">Klases</button>
            <button class="tablinks" onclick="openSection(event, 'kabineti')">Kabineti</button>
            <button class="tablinks" onclick="openSection(event, 'nodarbibas')" >Nodarbības</button>
        </div>
        
        <div id="skolotaji" class="tabcontent">
            <h1>Skolotāju dati</h1>
            <form method="get">
                Vārds: <input type="text" name="vards" /><br>
                Uzvārds: <input type="text" name="uzvards" /><br>
                Skolotajs: <select name="skolotajs">
                    <?php
                        $skolotaji = $skolotajsService->getAllSkolotaji($conn);
                        
                        foreach($skolotaji as $s){
                            $fName = $s->getVards();
                            $lName = $s->getUzvards();
                            
                            echo "<option>$fName $lName</option>";
                        }
                    ?>
                </select>
                <br>
                <br>
                <input type="submit" name="newSkolotajs" value="Pievienot" /> 
                <input type="submit" name="editSkolotajs" value="Labot" /> 
                <input type="submit" name="deleteSkolotajs" value="Dzēst" />
            </form>
            <br>
            
            <?php
                if(isset($_GET['newSkolotajs'])){
                    if($_GET['vards'] != "" && $_GET['uzvards'] != ""){
                        $vards = $_GET['vards'];
                        $uzvards = $_GET['uzvards'];
                        
                        $info = $skolotajsService->insertSkolotajs($conn, $vards, $uzvards);
                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['editSkolotajs'])){
                    if($_GET['vards'] != "" && $_GET['uzvards'] != ""){
                        $skolotajs = $_GET['skolotajs'];
                        $oldVards = explode(" ", $skolotajs)[0];
                        $oldUzvards = explode(" ", $skolotajs)[1];
                        
                        $newVards = $_GET['vards'];
                        $newUzvards = $_GET['uzvards'];
                        
                        $id = $skolotajsService->getSkolotajsID($conn, $oldVards, $oldUzvards);
                        
                        $info = $skolotajsService->updateSkolotajs($conn, $id, $newVards, $newUzvards);
                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['deleteSkolotajs'])){
                    $skolotajs = $_GET['skolotajs'];
                    $vards = explode(" ", $skolotajs)[0];
                    $uzvards = explode(" ", $skolotajs)[1];
                        
                    $id = $skolotajsService->getSkolotajsID($conn, $vards, $uzvards);
                        
                    $info = $skolotajsService->deleteSkolotajs($conn, $id);
                    
                    header('Location: index.php');
                }
            ?>
            
            <table>
                <tr>
                    <th>Nr.</th>
                    <th>Uzvārds</th>
                    <th>Vārds</th>
                </tr>
                <?php
                    $skolotaji = $skolotajsService->getAllSkolotaji($conn);
                    $i = 1;
                        
                    foreach($skolotaji as $s){
                        $fName = $s->getVards();
                        $lName = $s->getUzvards();
                            
                        echo "<tr>
                                <td>$i</td>
                                <td>$lName</td>
                                <td>$fName</td>
                            </tr>";
                        $i++;
                    }
                ?>
            </table>
        </div>
        
        <div id="prieksmeti" class="tabcontent">
            <h1>Priekšmetu dati</h1>
            <form method="get">
                Nosaukums: <input type="text" name="prNos" /><br>
                Skolotajs: <select name="skolotajs">
                    <option>-- Skolotājs --</option>
                    <?php
                        $skolotaji = $skolotajsService->getAllSkolotaji($conn);
                        
                        foreach($skolotaji as $s){
                            $fName = $s->getVards();
                            $lName = $s->getUzvards();
                            
                            echo "<option>$fName $lName</option>";
                        }
                    ?>
                </select>
                <br>
                <br>
                Priekšmets: <select name="prieksmets">
                    <?php
                        $prieksmeti = $prieksmetsService->getAllPrieksmeti($conn);
                        
                        foreach($prieksmeti as $p){
                            $nos = $p->getNosaukums();
                            
                            echo "<option>$nos</option>";
                        }
                    ?>
                </select>
                
                <br>
                <br>
                <input type="submit" name="newPrieksmets" value="Pievienot" /> 
                <input type="submit" name="editPrieksmets" value="Labot" /> 
                <input type="submit" name="deletePrieksmets" value="Dzēst" />
            </form>
            <br>
            
            <?php
                if(isset($_GET['newPrieksmets'])){
                    if($_GET['prNos'] != ""){
                        $prNos = $_GET['prNos'];
                        $skolotajs = $_GET['skolotajs'];
                        
                        $info = $prieksmetsService->insertPrieksmets($conn, $prNos);
                        
                        if($skolotajs != "-- Skolotājs --"){
                            $vards = explode(" ", $skolotajs)[0];
                            $uzvards = explode(" ", $skolotajs)[1];
                            
                            $info = $spService->insertSP($conn, $prNos, $vards, $uzvards);
                        }
                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['editPrieksmets'])){
                    if($_GET['prNos'] != ""){
                        $prieksmets = $_GET['prieksmets'];
                        
                        $newPrieksmets = $_GET['prNos'];
                        
                        $id = $prieksmetsService->getPrieksmetsID($conn, $prieksmets);
                        
                        $info = $prieksmetsService->updatePrieksmets($conn, $id, $newPrieksmets);
                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['deletePrieksmets'])){
                    $prieksmets = $_GET['prieksmets'];
                        
                    $id = $prieksmetsService->getPrieksmetsID($conn, $prieksmets);
                        
                    $info = $prieksmetsService->deletePrieksmets($conn, $id);
                    
                    header('Location: index.php');
                }
            ?>
            
            <table>
                <tr>
                    <th>Nr.</th>
                    <th>Mācību priekšmets</th>
                </tr>
                <?php
                    $prieksmeti = $prieksmetsService->getAllPrieksmeti($conn);
                    $i = 1;
                        
                    foreach($prieksmeti as $p){
                        $nos = $p->getNosaukums();
                            
                        echo "<tr>
                                <td>$i</td>
                                <td>$nos</td>
                            </tr>";
                        $i++;
                    }
                ?>
            </table>
        </div>
        
        <div id="klases" class="tabcontent">
            <h1>Klašu dati</h1>
            <form method="get">
                Nosaukums: <input type="text" name="klaseNos" /><br>
                Skolotajs: <select name="skolotajs">
                    <option>-- Skolotājs --</option>
                    <?php
                        $skolotaji = $skolotajsService->getAllSkolotaji($conn);
                        
                        foreach($skolotaji as $s){
                            $fName = $s->getVards();
                            $lName = $s->getUzvards();
                            
                            echo "<option>$fName $lName</option>";
                        }
                    ?>
                </select>
                <br>
                <br>
                Klase: <select name="klase">
                    <?php
                        $klases = $klaseService->getAllKlases($conn);
                        
                        foreach($klases as $k){
                            $nos = $k->getNosaukums();
                            
                            echo "<option>$nos</option>";
                        }
                    ?>
                </select>
                
                <br>
                <br>
                <input type="submit" name="newKlase" value="Pievienot" /> 
                <input type="submit" name="editKlase" value="Labot" /> 
                <input type="submit" name="deleteKlase" value="Dzēst" />
            </form>
            <br>
            
            <?php
                if(isset($_GET['newKlase'])){
                    if($_GET['klaseNos'] != ""){
                        $klaseNos = $_GET['klaseNos'];
                        $skolotajs = $_GET['skolotajs'];
                        
                        if($skolotajs != "-- Skolotājs --"){
                            $vards = explode(" ", $skolotajs)[0];
                            $uzvards = explode(" ", $skolotajs)[1];
                            
                            $audzinatajs = new Skolotajs($vards, $uzvards);
                            
                            $info = $klaseService->insertKlase($conn, $klaseNos, $audzinatajs);
                        }
                    }
                    
                    header('Location: index.php');
                }
            
                if(isset($_GET['editKlase'])){
                    $skolotajs = $_GET['skolotajs'];
                    
                    // Ar IF - ELSE konstrukciju - labot ieraksta visus laukus vispirms, katru individuāli pēc tam
                    if($_GET['klaseNos'] != "" && $skolotajs != "-- Skolotājs --"){
                        $klase = $_GET['klase'];
                        
                        $newKlase = $_GET['klaseNos'];
                        $vards = explode(" ", $skolotajs)[0];
                        $uzvards = explode(" ", $skolotajs)[1];
                        
                        $id = $klaseService->getKlaseID($conn, $klase);
                        
                        $info = $klaseService->updateKlase($conn, $id, $newKlase, $vards, $uzvards);
                    }
                    else if($_GET['klaseNos'] != ""){
                        $klase = $_GET['klase'];
                        
                        $newKlase = $_GET['klaseNos'];
                        
                        $id = $klaseService->getKlaseID($conn, $klase);
                        
                        $info = $klaseService->updateKlaseNos($conn, $id, $newKlase);
                    }
                    else if($skolotajs != "-- Skolotājs --"){
                        $klase = $_GET['klase'];
                        
                        $vards = explode(" ", $skolotajs)[0];
                        $uzvards = explode(" ", $skolotajs)[1];
                        
                        $id = $klaseService->getKlaseID($conn, $klase);
                        
                        $info = $klaseService->updateKlaseAudz($conn, $id, $vards, $uzvards);
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
            
                if(isset($_GET['deleteKlase'])){
                    $klase = $_GET['klase'];
                        
                    $id = $klaseService->getKlaseID($conn, $klase);
                        
                    $info = $klaseService->deleteKlase($conn, $id);
                    
                    header('Location: index.php');
                }
            ?>
            
            <table>
                <tr>
                    <th>Nr.</th>
                    <th>Klase</th>
                    <th>Audzinātājs</th>
                </tr>
                <?php
                    $klases = $klaseService->getAllKlases($conn);
                    $i = 1;
                        
                    foreach($klases as $k){
                        $nos = $k->getNosaukums();
                        $audz = $k->getAudzinatajs();
                        $vards = $audz->getVards();
                        $uzvards = $audz->getUzvards();
                            
                        echo "<tr>
                                <td>$i</td>
                                <td>$nos</td>
                                <td>$vards $uzvards</td>
                            </tr>";
                        $i++;
                    }
                ?>
            </table>
        </div>
        
        <div id="kabineti" class="tabcontent">
            <h1>Kabinetu dati</h1>
        </div>
        
        <div id="nodarbibas" class="tabcontent">
            <h1>Nodarbību dati</h1>
        </div>
    </body>
    
    <script>
        document.getElementById("defaultOpen").click();
    </script>
</html>