<?php
ini_set('display_errors', '1');
include_once("../includes.php");
?>
<div class="content">
  <div class="container">
    <div class="table-responsive">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"> Pievienot</button>
      <form method="post" style="display: inline-block;" action="../export/export_certificates.php">
        <input type="submit" name="export" class="btn btn-success" value="Eksportēt" />
      </form>
      <form method="post" style="display: inline-block;" enctype="multipart/form-data">
        <input class="btn" type="file" name="excel" />
        <input type="submit" name="import" class="btn btn-info" value="Importēt" />
      </form>
      <form method="post">
        <button type="submit" class="btn btn-danger" name="massdelete">Dzēst</button>
        <?php
        $rows = mysqli_query($conn, "SELECT id_ce, concat(`students`.`firstName`,' ',`students`.`lastName`) as 'students',`ce_names`,`ce_codes`,
        `items`,`ce_years` FROM certificates
      INNER JOIN `students` ON	`students`.`id_student`=`certificates`.`students_id` ORDER BY `students`");
        ?>
        <table class="table table-striped custom-table">
          <div class="form-group pull-right">
            <input class="form-control" id="Input" type="text" placeholder="Meklēt...">
          </div>
          <thead>
            <tr>
              <th scope="col">
                <label class="control control--checkbox">
                  <input type="checkbox" id="selectAllCheckbox" onclick="checkAll();" class="js-check-all" name="deleteId[]" value="<?php echo $row['id_ce']; ?>">
                  <div class="control__indicator"></div>
                </label>
              </th>
              <th scope="col">ID</th>
              <th scope="col">Vards/Uzvards</th>
              <th scope="col">Sertifikāta izglitība</th>
              <th scope="col">Sertifikāta Nr.</th>
              <th scope="col">Priekšmeti</th>
              <th scope="col">Izsniegšanas Gads</th>
              <th scope="col">Funkcijas</th>
            </tr>
          </thead>
          <tbody id="Table">
            <?php $i = 1;
            foreach ($rows as $row) : ?>
              <tr scope="row">
                <td>
                  <label class="control control--checkbox">
                    <input type="checkbox" name="deleteId[]" value="<?php echo $row['id_ce']; ?>">
                    <div class="control__indicator"></div>
                  </label>
                </td>
                <td>
                  <?php echo $i++; ?>
                </td>
                <td class="pl-0">
                  <?php echo $row["students"]; ?>
                </td>
                <td>
                  <?php echo $row["ce_names"]; ?>
                </td>
                <td>
                  <?php echo $row["ce_codes"]; ?>
                </td>
                <td>
                  <?php echo $row["items"]; ?>
                </td>
                <td style = "text-align: center;"><?php echo $row["ce_years"]; ?></td>
                </td>
                <td><a href=<?= "?delete=" . $row['id_ce'] ?>>Dzēst</a> |
                  <a href=<?= "?edit=" . $row['id_ce'] ?> onclick="document.getElementById('id01').style.display='block'">Rediģēt</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    </div>
  </div>
</div>
</form>
<script>
  function checkAll() {
    var inputs = document.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
      if (inputs[i].type == "checkbox") {
        inputs[i].checked = selectAllCheckbox.checked;
      }
    }
  }
</script>
<script>
  $(document).ready(function() {
    $("#Input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#Table tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
<script src="../js/main.js"></script>
