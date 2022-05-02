<div id="id02" class="modal1">
  <form class="modal-content animate" method="get">
    <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close">&times;</span>
    <div class="container">

      Vārds: <input type="text" name="fname" />
      Uzvārds: <input type="text" name="lname" list="last_list" />
      <datalist id="last_list">
      </datalist>
      Personas kods: <input type="text" name="code" />
      Kurss: <input type="text" name="course" list="courses_list">
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
      Profesija: <input type="text" name="profession" list="professions_list">
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
      Iestāšanas gads: <input type="text" name="year" />



      <input type="submit" class="btn btn-success" name="newStudents" value="Pievienot" />

      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="btn btn-danger">Cancel</button>
    </div>
  </form>
</div>
<div id="id01" style="<?php if ($_GET['edit']) {
                        echo 'display:block;';
                      } ?>" class="modal1">


  <form class="modal-content animate" method="get">
    <span onclick="document.getElementById('id01').style.display='none';window.location = '../Pages/students_page.php'" class="close" title="Close">&times;</span>
    <div class="container">

      Vards: <input type="text" name="fname" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getFirstName(); ?> " />
      Uzvārds: <input type="text" name="lname" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getLastName(); ?> " />

      Personas kods: <input type="text" name="code" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getCodes(); ?> " />
      Kurss: <input type="text" name="course" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getCourses(); ?> " />
      Profesija: <input type="text" name="profession" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getProfessions(); ?> " />

      Iestāšanas gads: <input type="text" name="year" value="<?= $studentsService->getStudentsByID($conn, $_GET['edit'])->getYears(); ?> " />




      <button type="submit" class="btn btn-success" name="edit" value="<?= $_GET['edit'] ?>">Update</button>
      <button type="button" onclick="document.getElementById('id01').style.display='none'; window.location = '../Pages/students_page.php'" class="btn btn-danger">Cancel</button>

    </div>
  </form>
</div>