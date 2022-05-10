<?php
ini_set('display_errors', '1');
include_once($_SERVER["DOCUMENT_ROOT"] . "/KVD/extras/includes.php");
$connect = mysqli_connect("localhost", "root", "root", "KVD");

?>
<?php $studentsService = new StudentsService(); ?>
<!doctype html>
<html>

<head>
  <title>Audzekņu Tabula</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/sidebar/style.css">
  <link rel="stylesheet" href="../css/form/style.css">
  <link rel="stylesheet" href="../css/extras/bootstrap.min.css">
  <link rel="stylesheet" href="../css/extras/owl.carousel.min.css">



</head>

<body>
  <div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
      <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
          <i class="fa fa-bars"></i>
          <span class="sr-only">Toggle Menu</span>
        </button>
      </div>
      <h1><a class="logo">Uzskaites Sistēma</a></h1>
      <ul class="list-unstyled components mb-5">
        <li class="active">
          <a href="../index.php"><span class="fa fa-home mr-3"></span> Home</a>
        </li>
        <li>
          <a href="../Pages/students_page.php"><span class="fa fa-user mr-3"></span> Auzdekņi</a>
        </li>
        <li>
          <a href="../Pages/remark_page.php"><span class="fa fa-sticky-note mr-3"></span> Piezīmes</a>
        </li>
        <li>
          <a href="#"><span class="fa fa-sticky-note mr-3"></span> Subcription</a>
        </li>
        <li>
          <a href="#"><span class="fa fa-paper-plane mr-3"></span> Settings</a>
        </li>
        <li>
          <a href="#"><span class="fa fa-paper-plane mr-3"></span> Information</a>
        </li>
      </ul>

    </nav>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5 ">

      <button class="btn btn-primary" onclick="document.getElementById('id02').style.display='block'">Pievienot</button>
      <form method="post" action="../export/export_students.php">
        <input type="submit" name="export" class="btn btn-success" value="Export" />
      </form>


      <form method="post" enctype="multipart/form-data">
        <label>Select Excel File</label>
        <input type="file" name="excel" />
        <input type="submit" name="import" class="btn btn-info" value="Import" style="display:block;" />
      </form>


      <?php

      $remarksService = new RemarksService();

      include_once "../Pages/student_table.php";

      ?>
      <?php
      if (isset($_GET['newStudents'])) {
        if ($_GET['fname'] != "" && $_GET['lname'] != "" && $_GET['code'] != "" && $_GET['course'] != "" && $_GET['profession'] != "" && $_GET['year'] != "") {
          $firstName = $_GET['fname'];
          $lastName = $_GET['lname'];
          $codes = $_GET['code'];
          $courses = $_GET['course'];
          $professions = $_GET['profession'];
          $years = $_GET['year'];
          $info = $studentsService->insertStudents($conn, $firstName, $lastName, $codes, $courses, $professions, $years);
        }
        header('Location: students_page.php');
      }
      if (isset($_GET['edit'])) {
        if (isset($_GET['fname']) && $_GET['lname'] != "" && $_GET['code'] && $_GET['course'] && $_GET['profession'] != "" && $_GET['year'] != "") {
          $firstName = $_GET['fname'];
          $lastName = $_GET['lname'];
          $codes = $_GET['code'];
          $courses = $_GET['course'];
          $professions = $_GET['profession'];
          $years = $_GET['year'];

          $info = $studentsService->updateStudents($conn, $_GET['edit'], $firstName, $lastName, $codes, $courses, $professions, $years);
          header('Location: students_page.php');
        }
      }

      if (isset($_GET['delete'])) {
        $studentsService->deleteStudents($conn, $_GET['delete']);

        header('Location: students_page.php');
      }

      $output = '';
      if (isset($_POST["import"])) {
        $extension = end(explode(".", $_FILES["excel"]["name"])); // For getting Extension of selected file
        $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
        if (in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
        {
          $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
          include("../Classes/PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
          $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

          $output .= "<label class='text-success'>Data Inserted</label><br /><table class='table table-bordered'>";
          foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();
            for ($row = 2; $row <= $highestRow; $row++) {
              $output .= "<tr>";
              $firstName = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
              $lastName = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
              $code = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
              $course = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
              $profession = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
              $year = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(5, $row)->getValue());

              $query = "INSERT INTO students(firstName,lastName,codes,courses,professions,years) VALUES ('" . $firstName . "', '" . $lastName . "', '" . $code . "','" . $course . "', '" . $profession . "', '" . $year . "')";
              mysqli_query($connect, $query);
              $output .= '<td>' . $firstName . '</td>';
              $output .= '<td>' . $lastName . '</td>';
              $output .= '<td>' . $code . '</td>';
              $output .= '<td>' . $course . '</td>';
              $output .= '<td>' . $profession . '</td>';
              $output .= '<td>' . $year . '</td>';
              $output .= '</tr>';
            }
          }
          $output .= '</table>';
        } else {
          $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
        }
        header('Location: students_page.php');
      }

      if(isset($_POST["massdelete"]) && isset($_POST["deleteId"])){
        foreach($_POST["deleteId"] as $deleteId){
          $delete = "DELETE FROM students WHERE id_student = $deleteId";
          mysqli_query($connect, $delete);
        }
        header('Location: students_page.php');
      }
      ?>
      <?php
      include_once "../Pages/student_form.php";
      ?>

    </div>
    <script src="../js/extras/bootstrap.min.js"></script>
    <script src="../js/extras/jquery.min.js"></script>
    <script src="../js/extras/main.js"></script>
    <script src="../js/extras/owl.carousel.min.js"></script>
    <script src="../js/extras/popper.js"></script>
</body>

</html>