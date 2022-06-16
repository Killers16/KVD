<div id="id01" class="modal" style="width:auto; overflow:auto !important; overflow-x: hidden; <?php if ($_GET['edit']) {
                                                                    echo 'display:block;';
                                                                  } ?>">

  <div class="modal-dialog">
    <div class="modal-content">
      <form method="get">

        <div class="modal-header">
          <h4 class="modal-title">Studentu Rediģēšana</h4>
          <span onclick="document.getElementById('id01').style.display='none';window.location = '../Pages/students_page.php'" class="btn-close" title="Close"></span>
        </div>
        <div class="modal-body ">

          Vards: <input type="text" name="fname" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getFirstName(); ?> " />
          Uzvārds: <input type="text" name="lname" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getLastName(); ?> " />

          Personas kods: <input type="text" name="code" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getCodes(); ?> " id="code_edit" onkeyup="passcode_edit(this)" maxlength="12" onkeypress="if (isNaN(String.fromCharCode(event.keyCode))) return false;" />
          Kurss: <input type="text" name="course" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getCourses(); ?> " />
          Profesija: <input type="text" name="profession" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getProfessions(); ?> " />

          Iestāšanas gads: <input type="text" name="year" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getYears(); ?> "maxlength="4" onkeypress="if (isNaN(String.fromCharCode(event.keyCode))) return false;"/>
          Telefons: <input type="text" name="phone" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getPhones(); ?> " maxlength="8" onkeypress="if (isNaN(String.fromCharCode(event.keyCode))) return false;"/>
          Pēdeja skola: <textarea type="text" name="lastSchool"><?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getLastSchools(); ?>&#13;&#10; </textarea>
        </div>



        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="edit" value="<?= $_GET['edit'] ?>">Atjaunināt</button>
          <button type="button" onclick="document.getElementById('id01').style.display='none'; window.location = '../Pages/students_page.php'" class="btn btn-danger">Aizvērt</button>
        </div>
      </form>
    </div>
  </div>