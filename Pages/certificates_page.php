<?php
ini_set('display_errors', '1');
include_once("../extras/includes.php");
$connect = mysqli_connect("localhost", "admin", "admin", "KVD");
?>

<!doctype html>
<html>

<head>
  <title>Audzekņu Tabula</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


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
          <a href="../index.php" style="color: #818181;"><span class="fa fa-home mr-3"></span>Galvenā lapa</a>
        </li>
        <li>
          <a href="../Pages/students_page.php" style="color: #818181;"><span class="fa fa-user mr-3"></span>Auzdekņi</a>
        </li>
        <li>
          <a href="../Pages/remark_page.php" style="color: #818181;"><span class="fa fa-sticky-note mr-3"></span>Piezīmes</a>
        </li>
        <li>
          <a href="../Pages/certificates_page.php" style="color: #f1f1f1;"><span class="fa fa-sticky-note mr-3"></span>Sertifikāti</a>
        </li>

      </ul>

    </nav>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5 ">
      <?php

      $certificatesService = new CertificatesService();

      include_once "../table/certificates_table.php";


      ?>

      <div class="modal fade" id="myModal" method="get">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">

              <h4 class="modal-title">Sertifikātu pievienošana</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <form>
                <?php
                include_once("../extras/includes.php");
                $rows = mysqli_query($conn, "SELECT id_student, concat(firstName,' ',lastName) as students FROM students");
                $certificatesService = new CertificatesService();
                $studentsService = new StudentsService();
                ?>
                Students<select name="students" class="students">

                  <?php foreach ($rows as $row) : ?>
                    <option value="<?php echo ($row["id_student"]); ?>">

                      <?php echo ($row["students"]); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                Izglītiba: <input type="text" name="ce_name" id="ce_name" />
                Kods: <input type="text" name="ce_code" id="ce_code" onkeyup="c_code(this)" maxlength="18"  />
                Priekšmets: <textarea style="margin-bottom:15px;" type="text" name="items" id="ce_items"></textarea>
                Iestāšanas gads: <input type="text" name="ce_year" id="ce_years" onkeypress="if (isNaN(String.fromCharCode(event.keyCode))) return false;" maxlength="4" min="0" max="9999" />

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">

              <input type="submit" class="btn btn-success" name="newCertificates" value="Pievienot" onclick="return Validation_certificate()" />
              </form>

              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Aizvērt</button>
            </div>

          </div>
        </div>
      </div>




      <?php
      if (isset($_GET['newCertificates'])) {
        if ($_GET['students'] != "" && $_GET['ce_name'] != "" && $_GET['ce_code'] != "" && $_GET['items'] != "" && $_GET['ce_year'] != "") {
          $students_id = $_GET['students'];
          $ce_names = $_GET['ce_name'];
          $ce_codes = $_GET['ce_code'];
          $items = $_GET['items'];
          $ce_years = $_GET['ce_year'];
          $info = $certificatesService->insertCertificates($conn, $students_id, $ce_names, $ce_codes, $items, $ce_years);
        }
        header('Location: certificates_page.php');
      }
      if (isset($_GET['edit'])) {
        if (isset($_GET['students']) && $_GET['ce_name'] != "" && $_GET['ce_code'] != "" && $_GET['items'] != "" && $_GET['ce_year'] != "") {
          $students_id = $_GET['students'];
          $ce_names = $_GET['ce_name'];
          $ce_codes = $_GET['ce_code'];
          $items = $_GET['items'];
          $ce_years = $_GET['ce_year'];

          $info = $certificatesService->updateCertificates($conn, $_GET['edit'], $students_id, $ce_names, $ce_codes, $items, $ce_years);
          header('Location: certificates_page.php');
        }
      }

      if (isset($_GET['delete'])) {
        $certificatesService->deleteCertificates($conn, $_GET['delete']);

        header('Location: certificates_page.php');
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
              $ce_names = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
              $ce_codes = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
              $items = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
              $ce_year = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, $row)->getValue());

              $query = "INSERT INTO certificates(students_id,ce_names,ce_codes,items,ce_years) VALUES ('" . $students_id . "', '" . $ce_names . "', '" . $ce_codes . "','" . $items . "', '" . $ce_year . "')";
              mysqli_query($connect, $query);
              $output .= '<td>' . $students_id . '</td>';
              $output .= '<td>' . $ce_names . '</td>';
              $output .= '<td>' . $ce_codes . '</td>';
              $output .= '<td>' . $items . '</td>';
              $output .= '<td>' . $ce_year . '</td>';
              $output .= '</tr>';
            }
          }
          $output .= '</table>';
        } else {
          $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
        }
        header('Location: certificates_page.php');
      }

      if (isset($_POST["massdelete"]) && isset($_POST["deleteId"])) {
        foreach ($_POST["deleteId"] as $deleteId) {
          $delete = "DELETE FROM certificates WHERE id_ce = $deleteId";
          mysqli_query($connect, $delete);
        }
        header('Location: certificates_page.php');
      }
      include_once "../form/certificates_form.php";
      ?>


    </div>
</body>

</html>