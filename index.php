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
            $database = "KVD";

            $conn = new mysqli($hostname, $user, 'root', $database);

            if($conn->connect_error){
                die("Connection failed!".$conn->connect_error);
            }
        
        ?>
    </head>
    <body>
        <div class="tab">
            <button id="defaultOpen" class="tablinks" onclick="openSection(event, 'student')">Audzeknis</button>
            <button class="tablinks" onclick="openSection(event, 'course')">Kurss</button>
            <button class="tablinks" onclick="openSection(event, 'profession')">Profesija</button>         
            <button class="tablinks" onclick="openSection(event, 'pers_code')">Personas Kods</button>
            <button class="tablinks" onclick="openSection(event, 'year')">Gads</button>
            <button class="tablinks" onclick="openSection(event, 'info')" >Info</button>
             </div>

        <div id="student" class="tabcontent">
                <?php include_once('Pages/students_page.php');?>
        </div>
        <div id="course" class="tabcontent">
                <?php include("Pages/courses_page.php");?>
        </div>

        <div id="profession" class="tabcontent">
                <?php include("Pages/professions_page.php");?>
        </div>
        
        <div id="pers_code" class="tabcontent">
                <?php include("Pages/pers_codes_page.php");?>
        </div>

        <div id="year" class="tabcontent">
                <?php include("Pages/years_page.php");?>
        </div>
         <div id="info" class="tabcontent">
                <?php include("Pages/info_page.php");?>
                </div>


            </body>
            
            <script>
                document.getElementById("defaultOpen").click();
            </script>
        </html>