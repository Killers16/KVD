<?php
ini_set('display_errors', '1');
include_once($_SERVER["DOCUMENT_ROOT"] . "/KVD/extras/includes.php");

?>

<!doctype html>
<html lang="en">

<head>
  <title>Piezīmes Tabula</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/sidebar/style.css">
  <link rel="stylesheet" href="../css/form/style.css">

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

      <form method="post" action="../export/export_remarks.php">
        <input type="submit" name="export" class="btn btn-success" value="Export" />
      </form>

      <form method="post" enctype="multipart/form-data">
        <label>Select Excel File</label>
        <input type="file" name="excel" />
        <input type="submit" name="import" class="btn btn-info" value="Import" style="display:block;" />
      </form>
      <?php

      $remarksService = new RemarksService();

      include_once "../Pages/remark_table.php";
      ?>

      <?php
      if (isset($_GET['newRemark'])) {

        if ($_GET['fname'] != "" && $_GET['lname'] != "" && $_GET['names'] != "") {
          $firstName = $_GET['fname'];
          $lastName = $_GET['lname'];
          $Rnames = $_GET['names'];

          $info = $remarksService->insertRemarks($conn, $firstName, $lastName, $Rnames);
        }

        header('Location: remark_page.php');
      }

      if (isset($_GET['edit'])) {
        if (isset($_GET['fname']) && $_GET['lname'] != "" && $_GET['names'] != "") {
          $firstName = $_GET['fname'];
          $lastName = $_GET['lname'];
          $Rnames = $_GET['names'];

          $info = $remarksService->updateRemarks($conn, $_GET['edit'], $firstName, $lastName, $Rnames);
          header('Location: remark_page.php');
        }
      }

      if (isset($_GET['delete'])) {
        $remarksService->deleteRemarks($conn, $_GET['delete']);

        header('Location: remark_page.php');
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
              $name = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
              $last = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
              $msg = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
              $query = "INSERT INTO remarks(firstName,lastName,names) VALUES ('" . $name . "', '" . $last . "', '" . $msg . "')";
              mysqli_query($connect, $query);
              $output .= '<td>' . $name . '</td>';
              $output .= '<td>' . $last . '</td>';
              $output .= '<td>' . $msg . '</td>';
              $output .= '</tr>';
            }
          }
          $output .= '</table>';
        } else {
          $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
        }
        header('Location: remark_page.php');
      }

      ?>

      <?php
      include_once "../Pages/remark_form.php";
      ?>


    </div>

  </div>

</body>

</html>