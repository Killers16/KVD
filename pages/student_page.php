<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="style.css" type="text/css"/>
    </head>
    
    <body>
        <form method="get" class="form">
            Vārds: <input type="text" name="vards"/>
            Uzvārds: <input type="text" name="uzvards"/>
            Kurss: <input type="text" name="kurss"/>
            Programmas: <input type="text" name="programma"/>
            Personas kods: <input type="text" name="kods_personas"/><br>
            Gads: <input type="text" name="gads"/>
           
    
            <input type="submit" name="insertA" value="Pievienot"/>
            <input type="submit" name="updateA" value="Labot"/>
            <input type="submit" name="deleteA" value="Dzēst"/><br>
        </form>
        <hr>
                <table class="table">
                
                    <tr>
                        
                        <th>Nr.</th>
                        <th>Vārds</th>
                        <th>Uzvārds</th>
                        <th>Kurss</th>
                        <th>Programmas</th>
                        <th>Personas kods</th>
                        <th>Gads</th>
                        <th>Pārkapumi</th>
                    </tr>
                    <?php
                    $studentService = new StudentService();
                    $student = $studentService->getAllKlases($conn);
                    $i = 1;
                        
                    foreach($student as $s){
                        $firstname =$s->getFirstname();
                        $lastname =$s->getLastname();
                        $personal_code =$s->getPersonalCode();
                        $gads =$s->getGads();
                        
                            
                        echo "<tr>
                                <td>$i</td>
                                <td>$firstname</td>
                                <td>$lastname</td>
                                <td></td>
                                <td></td>
                                <td>$personal_code</td>
                                <td>$gads</td>
                                <td></td>
                                
                            </tr>";
                        $i++;
                    }
                ?>
            </table>
                </table>
        
        
    </body>
</html>