<div id="id01" class="modal" style="width:auto;  <?php if ($_GET['edit']) {
                                                  echo 'display:block;';
                                                } ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="GET">
        <div class="modal-header">
          <h4 class="modal-title">Sertifikātu Rediģēšana</h4>
          <span onclick="document.getElementById('id01').style.display='none';window.location = '../Pages/certificates_page.php'" class="btn-close" title="Close"></span>
        </div>
        <div class="modal-body">
          Students<select name="students" class="students">
            <?php $studentsID =  $certificatesService->getCertificatesByID($conn, $_GET['edit'])->getCeStudentsID(); ?>
            <?php foreach ($rows as $row) : ?>
              <option <?php if ($row["id_student"] == $studentsID) echo 'selected'; ?> value="<?php echo ($row["id_student"]); ?>">

                <?php echo ($row["students"]); ?>
              </option>
            <?php endforeach; ?>
          </select>

          Izglītiba: <input type="text" name="ce_name" value="<?= $certificatesService->getCertificatesByID($conn, $_GET['edit'])->getCe_name(); ?> " />

          Sertifikāta Nr: <input type="text" name="ce_code" id="ce_code_edit" value="<?= $certificatesService->getCertificatesByID($conn, $_GET['edit'])->getCe_Codes(); ?> " onkeyup="c_code_edit(this)" maxlength="18"  onkeypress="if (isNaN(String.fromCharCode(event.keyCode))) return false;"/>
          <label>Priekšmets:</label>
          <textarea style="margin-bottom:15px;" type="text" name="items"><?= $certificatesService->getCertificatesByID($conn, $_GET['edit'])->getCeItems(); ?> </textarea>
          Izsniegšanas Gads: <input type="text" name="ce_year" value="<?= $certificatesService->getCertificatesByID($conn, $_GET['edit'])->getCe_Years(); ?> " onkeypress="if (isNaN(String.fromCharCode(event.keyCode))) return false;" maxlength="4"/>
        </div>


        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="edit" value="<?= $_GET['edit'] ?>">Atjaunināt</button>
          <button type="button" onclick="document.getElementById('id01').style.display='none'; window.location = '../Pages/certificates_page.php'" class="btn btn-danger">Aizvērt</button>
        </div>
      </form>
    </div>
  </div>