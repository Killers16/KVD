<?php
ini_set('display_errors', '1');
?>
<!doctype html>
<html>
<title>Galvenā lapa</title>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/mainMenuBar.css" />
  <script src="/KVD/js/script.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/KVD/extras/includes.php"); ?>
</head>

<body>
  <nav class="navMenu">
    
    <a href="/KVD/Pages/students_page.php">Students</a>
    <a href="../KVD/Pages/remark_page.php">Remarks</a>
    <br>
    <div class="dot"></div>
    <footer class='footer'>&copy; Artjoms L. & Kristaps K. </footer>
    <input onclick="change();changeMode()" type="button" value="Night Mode" id="Mode" class='modeButton'></input>
  </nav>
  <div>

</body>

</html>