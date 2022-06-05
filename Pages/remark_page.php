<?php
ini_set('display_errors', '1');
include_once("../extras/includes.php");
?>

<!doctype html>
<html lang="en">

<head>
  <title>Piezīmes Tabula</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  
  
        

</head>

<body>
<style>
  
</style>
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
          <a href="../index.php" style="color: #818181;"><span class="fa fa-home mr-3" style="color: #818181;"></span>Galvenā lapa</a>
        </li>
        <li>
          <a href="../Pages/students_page.php" style="color: #818181;"><span class="fa fa-user mr-3"></span>Auzdekņi</a>
        </li>
        <li>
          <a href="../Pages/remark_page.php" style="color: #f1f1f1;"><span class="fa fa-sticky-note mr-3"></span>Piezīmes</a>
        </li>
        <li>
          <a href="../Pages/certificates_page.php" style="color: #818181;"><span class="fa fa-sticky-note mr-3"></span>Sertifikāti</a>
        </li>
      </ul>

    </nav>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5 ">

      <?php

      $remarksService = new RemarksService();

      include_once "../table/remark_table.php";
      ?>

      <!--ADD Remark -->
      <div class="modal fade" id="ADD">
        <div class="modal-dialog">
          <div class="modal-content" style="width:96%;">


            <div class="modal-header">

              <h4 class="modal-title">Piezīmju pievienošana</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <form method="get">
                <?php
                $rows = mysqli_query($conn, "SELECT id_student, concat(firstName,' ',lastName) as students FROM students");
                $studentsService = new StudentsService();
                $remarksService = new RemarksService();
                ?>

                Students<select name="students" class="students">

                  <?php foreach ($rows as $row) : ?>
                    <option value="<?php echo ($row["id_student"]); ?>">

                      <?php echo ($row["students"]); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                Piezīme: <textarea style="margin-bottom:15px;" type="text" name="names" id="r_name"></textarea>
            </div>

            <!-- Start footer -->
            <div class="modal-footer">

              <input type="submit" class="btn btn-success" name="newRemark" value="Pievienot" onclick="return Validation_remark()" />
              </form>

              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Aizvērt</button>
            </div>
            <!-- End footer -->
          </div>
        </div>
      </div>
      <!--END ADD Remark -->

     

      <?php
      if (isset($_GET['newRemark'])) {

        if ($_GET['students'] != ""  && $_GET['names'] != "") {
          $students_id = $_GET['students'];
          $Rnames = $_GET['names'];

          $info = $remarksService->insertRemarks($conn, $students_id, $Rnames);
        }

        header('Location: remark_page.php');
      }

      if (isset($_GET['edit'])) {
        if (isset($_GET['students']) &&  $_GET['names'] != "") {
          $students_id = $_GET['students'];

          $Rnames = $_GET['names'];

          $info = $remarksService->updateRemarks($conn, $_GET['edit'], $students_id, $Rnames);
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
              $students_id = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
              $msg = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
              $query = "INSERT INTO remarks(students_id,names) VALUES ('" . $students_id . "','" . $msg . "')";
              mysqli_query($connect, $query);
              $output .= '<td>' . $students_id . '</td>';
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


      if (isset($_POST["massdelete"]) && isset($_POST["deleteId"])) {
        foreach ($_POST["deleteId"] as $deleteId) {
          $delete = "DELETE FROM remarks WHERE id_remarks = $deleteId";
          mysqli_query($connect, $delete);
        }
        header('Location: remark_page.php');
      }

      

      include_once("../form/remarks_form.php")

      
      ?>

    </div>

  </div>

</body>

</html>