<div id="id01" class="modal" style="width:30%; overflow: scroll;  <?php if ($_GET['edit']) {
                                                                    echo 'display:block;';
                                                                  } ?>">

  <div class="modal-dialog">
    <div class="modal-content">
      <form method="get">

        <div class="modal-header">
          <h4 class="modal-title">Studentu Rediģēšana</h4>
          <span onclick="document.getElementById('id01').style.display='none';window.location = '../Pages/students_page.php'" class="btn-close" title="Close">&times;</span>
        </div>
        <div class="modal-body ">

          Vards: <input type="text" name="fname" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getFirstName(); ?> " />
          Uzvārds: <input type="text" name="lname" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getLastName(); ?> " />

          Personas kods: <input type="text" name="code" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getCodes(); ?> " />
          Kurss: <input type="text" name="course" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getCourses(); ?> " />
          Profesija: <input type="text" name="profession" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getProfessions(); ?> " />

          Iestāšanas gads: <input type="text" name="year" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getYears(); ?> " />
          Telefons: <input type="text" name="phone" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getPhones(); ?> " />
          Pēdeja skola: <textarea type="text" name="lastSchool"><?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getLatsSchools(); ?>&#13;&#10; </textarea>
        </div>



        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="edit" value="<?= $_GET['edit'] ?>">Atjaunināt</button>
          <button type="button" onclick="document.getElementById('id01').style.display='none'; window.location = '../Pages/students_page.php'" class="btn btn-danger">Aizvērt</button>
        </div>
      </form>
    </div>
  </div>