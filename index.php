<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css" />
        <script src="js/script.js"></script>
        <?php
            ob_start();
            header('Content-Type: text/html; charset=utf-8');
            
            $$servername = "localhost";
            $username = "root";
            $password = "root";
            
            try {
              $conn = new PDO("mysql:host=$servername;dbname=kvd", $username, $password);
              // set the PDO error mode to exception
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              echo "Connected successfully";
            } catch(PDOException $e) {
              echo "Connection failed: " . $e->getMessage();
            }
            
            include('pages/audzeknis_page.php');
            
        ?>
        <br>
    </head>
    <body>

        <div class="tab">
            <button class="tablinks" onclick="openSection(event, 'student')">Students</button>
            <button class="tablinks" onclick="openSection(event, 'discipline')">Discipline</button>
            <button class="tablinks" onclick="openSection(event, 'stipend')">Stipend</button>
            <button class="tablinks" onclick="openSection(event, 'kabineti')">Kabineti</button>
            <button class="tablinks" onclick="openSection(event, 'nodarbibas')" >Nodarbības</button>
        
       </div>
            
   
       
        <div id="student" class="tabcontent">
            
        <?php
                include('pages/student_page.php');
            ?>
           
        </div>
        <div id="discipline" class="tabcontent">
            
        <?php
                include('pages/discipline_page.php');
            ?>
           

        </div>

        <div id="stipend" class="tabcontent">
            
        <?php
                include('pages/stipend_page.php');
            ?>
           
        </div>
        
       
    </body>
    
    <script>
        document.getElementById("defaultOpen").click();
    </script>
</html>