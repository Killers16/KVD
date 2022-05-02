<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/KVD/config.php");
$result = $dbConn->query("SELECT * FROM students ORDER BY id_student ASC");
?>
<!doctype html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="../css/menuBar.css" />
  <link type="text/css" rel="stylesheet" href="../css/style.css" />
  <script src="/KVD/js/navBar.js"></script>
</head>

<body>
  <div class="flexHeader">
    <h1>Test page </h1><span class="btn_style" onclick="openNav()"><strong>☰ Open Menu</strong></span>
  </div>
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">X</a>
    <a href="../index.php">Home</a>
    <a href="/KVD/Pages/students_page.php">Students</a>
    <a href="/KVD/Pages/remark_page.php">Piezīmes</a>
  </div>
  <h1>Testa tabelis ar edit pogu katrai ailei</h1>
  <table>
    <tr>
      <th>ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Codes</th>
      <th>Courses</th>
      <th>Profesija</th>
      <th>Years</th>
    </tr>
    </thead>
    <tbody>
      <?php
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '
      <tr>
       <td>' . $row["id_student"] . '</td>
       <td>' . $row["firstName"] . '</td>
       <td>' . $row["lastName"] . '</td>
       <td>' . $row["codes"] . '</td>
       <td>' . $row["courses"] . '</td>
       <td>' . $row["professions"] . '</td>
       <td>' . $row["years"] . '</td>';
        echo "<td><a href=\"../Pages/TablesEdit.php/?id=$row[id_student]\">Edit</a></td>";
        echo '
      </tr>
      ';
      }
      ?>
      <table>

        <body>

</html>