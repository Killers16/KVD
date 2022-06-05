<?php
ini_set('display_errors', '1');

?>
<!doctype html>
<html>
<title>Galvenā lapa</title>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/mainMenuBar.css" />
  <script src="../js/script.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>

<body>
  <nav class="navMenu">

    <a href="./Pages/students_page.php">Students</a>
    <a href="./Pages/remark_page.php">Remarks</a>
    <a href="./Pages/certificates_page.php">Sertifikāti</a>
    <br>
    <footer class='footer'>&copy; Artjoms L. & Kristaps K. </footer>
    <input onclick="change();changeMode()" type="button" value="Night Mode" id="Mode" class='modeButton'></input>
  </nav>
  <div>

</body>

</html>