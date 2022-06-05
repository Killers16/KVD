
<div id="id01" class="modal" style="width:30%;  <?php if ($_GET['edit']) {
                                                  echo 'display:block;';
                                                } ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="GET">
        <div class="modal-header">
          <h4 class="modal-title">Piezīmju Rediģēšana</h4>
          <span onclick="document.getElementById('id01').style.display='none';window.location = '../Pages/remark_page.php'" class="btn-close" title="Close">&times;</span>
        </div>
        <div class="modal-body">
        Students<select name="students" class="students">
        <?php $studentsID =  $remarksService->getRemarksByID($conn, $_GET['edit'])->getReStudentID(); ?>
        <?php foreach ($rows as $row) : ?>
          <option <?php if ($row["id_student"] == $studentsID) echo "selected"; ?> value="<?php echo ($row["id_student"]); ?>">

            <?php echo ($row["students"]); ?>
          </option>
        <?php endforeach; ?>
      </select>

      Piezīme:<textarea type="text" name="names" id="r_name"><?= $remarksService->getRemarksByID($conn, $_GET['edit'])->getRnames(); ?></textarea>
        </div>


        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="edit" value="<?= $_GET['edit'] ?>">Atjaunināt</button>
          <button type="button" onclick="document.getElementById('id01').style.display='none'; window.location = '../Pages/remark_page.php'" class="btn btn-danger">Aizvērt</button>
        </div>
      </form>
    </div>
  </div>


      