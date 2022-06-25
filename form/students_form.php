<div id="id01" class="modal" style="width:auto; overflow:auto !important; overflow-x: hidden; <?php if ($_GET['edit']) {
                                                                    echo 'display:block;';
                                                                  } ?>">

  <div class="modal-dialog">
    <div class="modal-content">
      <form method="GET">
        <div class="modal-header">
          <h4 class="modal-title">Studentu Rediģēšana</h4>
          <span onclick="document.getElementById('id01').style.display='none';window.location = '../Pages/students_page.php'" class="btn-close" title="Close"></span>
        </div>
        <div class="modal-body ">

          Vards: <input type="text" name="fname"  value="<?=$studentsService->getStudentsByID($conn, $_GET['edit'])->getFirstName();?>" />
          Uzvārds: <input type="text" name="lname" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getLastName();?>" />
          Personas kods: <input type="text" name="code" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getCodes();?>" id="code_edit" onkeyup="passcode_edit(this)" maxlength="12" onkeypress="if (isNaN(String.fromCharCode(event.keyCode))) return false;" />
          Kurss: <input type="text" list="courses_list" name="course" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getCourses(); ?>" />
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
          Profesija: <input type="text" name="profession" list="professions_list" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getProfessions();?>" />
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
          Iestāšanas gads: <input type="text" name="year" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getYears();?>"maxlength="4" onkeypress="if (isNaN(String.fromCharCode(event.keyCode))) return false;"/>
          Telefons: <input type="text" name="phone" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getPhones();?>" maxlength="8" onkeypress="if (isNaN(String.fromCharCode(event.keyCode))) return false;"/>
          Pēdeja skola: <textarea type="text" name="lastSchool" id = "lastSchools"><?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getLastSchools(); ?></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="edit" value="<?= $_GET['edit'] ?>">Atjaunināt</button>
          <button type="button" onclick="document.getElementById('id01').style.display='none'; window.location = '../Pages/students_page.php'" class="btn btn-danger">Aizvērt</button>
        </div>
      </form>
    </div>
  </div>