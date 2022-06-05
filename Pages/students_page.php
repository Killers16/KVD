<?php
ini_set('display_errors', '1');
include_once("../extras/includes.php");
$connect = mysqli_connect("localhost", "admin", "admin", "KVD");
$studentsService = new StudentsService();
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
          <a href="/index.php" style="color: #818181;"><span class="fa fa-home mr-3"></span>Galvenā lapa</a>
        </li>
        <li>
          <a href="../Pages/students_page.php" style="color: #f1f1f1;"><span class="fa fa-user mr-3"></span>Auzdekņi</a>
        </li>
        <li>
          <a href="../Pages/remark_page.php" style="color: #818181;"><span class="fa fa-sticky-note mr-3"></span>Piezīmes</a>
        </li>
        <li>
          <a href="../Pages/certificates_page.php" style="color: #818181;"><span class="fa fa-sticky-note mr-3"></span>Sertifikāti</a>
        </li>
      </ul>
    </nav>
    </style>
    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5 ">
      <?php
      include_once "../table/student_table.php";
      ?>
      <!--ADD Students -->
      <div class="modal fade" id="ADD">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="GET">
              <!-- Modal header -->
              <div class="modal-header">
                <h4 class="modal-title">Studentu pievienošana</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <!-- Modal body -->
              <div class="modal-body">
                Vārds: <input type="text" name="fname" id="fname" />
                Uzvārds: <input type="text" name="lname" list="last_list" id="lname" />
                <datalist id="last_list">
                </datalist>
                Personas kods: <input type="text" name="code" id="code" onkeyup="passcode(this)" maxlength="14" />
                Kurss: <input type="text" name="course" list="courses_list" id="course">
                <datalist id="courses_list">
                  <option>1.d</option>
                  <option>1.g</option>
                  <option>1.k</option>
                  <option>1.l</option>
                  <option>1.m</option>
                  <option>1.p</option>
                  <option>2.d</option>
                  <option>2.g</option>
                  <option>2.k</option>
                  <option>2.l</option>
                  <option>2.m1</option>
                  <option>2.m2</option>
                  <option>3.d</option>
                  <option>3.g</option>
                  <option>3.k</option>
                  <option>3.l</option>
                  <option>3.m</option>
                  <option>3.p</option>
                  <option>4.d</option>
                  <option>4.g</option>
                  <option>4.k</option>
                  <option>4.m</option>
                  <option>4.p</option>
                  <option>A1.g</option>
                  <option>A1.m</option>
                  <option>A1.pd</option>
                  <option>A2.g</option>
                  <option>A2.m</option>
                  <option>A2.pd</option>

                </datalist>
                Profesija: <input type="text" name="profession" list="professions_list" id="profession"/>
                <datalist id="professions_list">
                  <option>Programmēšana un datortīklu administrēšana</option>
                  <option>Grāmatvedība un finanses</option>
                  <option>Mārketings un pārdošana</option>
                  <option>Namu pārvaldīšana</option>
                  <option>Datorsistēmas, datubāzes un datortīkli</option>
                  <option>Grāmatvedība</option>
                  <option>Komerczinības</option>
                  <option>Reklāmas dizains</option>
                  <option>Programmēšana</option>
                  <option>Telemehānika un loģistika</option>
                </datalist>
                Iestāšanas gads: <input type="text" name="year" id="year" onkeypress="if (isNaN(String.fromCharCode(event.keyCode))) return false;" maxlength="4" min="0" max="9999" />
                Telefons: <input type="text" name="phone" id="phones" />
                Pēdeja skola:<textarea type="text" name="lastSchool" id="lastSchools"></textarea>
              </div>
              <!-- Start footer -->
              <div class="modal-footer">
                <input type="submit" class="btn btn-success" name="newStudents" value="Pievienot" onclick="return Validation_students()" />
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Aizvērt</button>
              </div>
              <!-- End footer -->
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--END ADD Students -->



    <?php
    if (isset($_GET['newStudents'])) {
      if ($_GET['fname'] != "" && $_GET['lname'] != "" && $_GET['code'] != "" && $_GET['course'] != "" && $_GET['profession'] != "" && $_GET['year'] != "" && $_GET['phone'] != "" && $_GET['lastSchool']) {
        $firstName = $_GET['fname'];
        $lastName = $_GET['lname'];
        $codes = $_GET['code'];
        $courses = $_GET['course'];
        $professions = $_GET['profession'];
        $years = $_GET['year'];
        $phones = $_GET['phone'];
        $lastSchools = $_GET['lastSchool'];
        $info = $studentsService->insertStudents($conn, $firstName, $lastName, $codes, $courses, $professions, $years, $phones, $lastSchools);
      }
      header('Location: students_page.php');
    }
    if (isset($_GET['edit'])) {
      if (isset($_GET['fname']) && $_GET['lname'] != "" && $_GET['code'] && $_GET['course'] && $_GET['profession'] != "" && $_GET['year'] != "" && $_GET['phone'] != "" && $_GET['lastSchool']) {
        $firstName = $_GET['fname'];
        $lastName = $_GET['lname'];
        $codes = $_GET['code'];
        $courses = $_GET['course'];
        $professions = $_GET['profession'];
        $years = $_GET['year'];
        $phones = $_GET['phone'];
        $lastSchools = $_GET['lastSchool'];
        $info = $studentsService->updateStudents($conn, $_GET['edit'], $firstName, $lastName, $codes, $courses, $professions, $years, $phones, $lastSchools);
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
            $phone = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
            $lastSchool = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
            $query = "INSERT INTO students(firstName,lastName,codes,courses,professions,years,phones,lastSchools) VALUES ('" . $firstName . "', '" . $lastName . "', '" . $code . "','" . $course . "', '" . $profession . "', '" . $year . "', '" . $phone . "', '" . $lastSchool . "')";
            mysqli_query($connect, $query);
            $output .= '<td>' . $firstName . '</td>';
            $output .= '<td>' . $lastName . '</td>';
            $output .= '<td>' . $code . '</td>';
            $output .= '<td>' . $course . '</td>';
            $output .= '<td>' . $profession . '</td>';
            $output .= '<td>' . $year . '</td>';
            $output .= '<td>' . $phones . '</td>';
            $output .= '<td>' . $lastSchools . '</td>';
            $output .= '</tr>';
          }
        }
        $output .= '</table>';
      } else {
        $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
      }
      header('Location: students_page.php');
    }

    if (isset($_POST["massdelete"]) && isset($_POST["deleteId"])) {
      foreach ($_POST["deleteId"] as $deleteId) {
        $delete = "DELETE FROM students WHERE id_student = $deleteId";
        mysqli_query($connect, $delete);
      }
      header('Location: students_page.php');
    }

    if (isset($_POST['export'])) {
    }
    include_once("../form/students_form.php");
    ?>

   
    

</body>

</html>