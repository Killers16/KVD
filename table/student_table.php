    <?php
    ini_set('display_errors', '1');
    include_once("../extras/includes.php");
    ?>
    <div class="content">
      <div class="container">
        <div class="table-responsive">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ADD">
            Pievienot
          </button>

          <form method="post" style="display: inline-block;" action="../export/export_students.php">
            <input type="submit" name="export" class="btn btn-success" value="Eksportēt" />

          </form>
          <form method="post" style="display: inline-block;" enctype="multipart/form-data">
            <input class="btn" type="file" name="excel" />
            <input type="submit" name="import" class="btn btn-info" value="Importēt" />
          </form>
          <form method="post">
            <button type="submit" class="btn btn-danger" name="massdelete">Dzēst</button>
            <?php
            $rows = mysqli_query($conn, 'SELECT `id_student`,`firstName`,`lastName`,codes ,`courses`,`professions`,`years`, concat(SUBSTRING(`phones`,0)," +371 ",SUBSTRING(`phones`,1)) as phones,`lastSchools`  FROM `students`
            ORDER BY `firstName`,`lastName`');
            ?>

            <table class="table table-striped custom-table">
              <div class="form-group pull-right">
                <input class="form-control" id="myInput" type="text" placeholder="Meklēt...">
              </div>
              <thead>
                <tr>
                  <th scope="col">
                    <label class="control control--checkbox">
                      <input type="checkbox" id="selectAllCheckbox" onclick="checkAll();" class="js-check-all" name="deleteId[]" value="<?php echo $row['id_student']; ?>">
                      <div class="control__indicator"></div>
                    </label>
                  </th>
                  <th scope="col">ID</th>
                  <th scope="col">Vārds</th>
                  <th scope="col">Uzvārds</th>
                  <th scope="col">Personas kods</th>
                  <th scope="col">Kurss</th>
                  <th scope="col">Profesija</th>
                  <th scope="col">Gads</th>
                  <th scope="col">Numurs </br>Ieprekšeja skola</th>
                  <th scope="col">Funkcijas</th>

                </tr>
              </thead>
              <tbody id="myTable">
                <?php $i = 1;
                foreach ($rows as $row) : ?>

                  <tr scope="row">
                    <td>
                      <label class="control control--checkbox">
                        <input type="checkbox" name="deleteId[]" value="<?php echo $row['id_student']; ?>">
                        <div class="control__indicator"></div>
                      </label>
                    </td>
                    <td>
                      <?php echo $i++; ?>
                    </td>
                    <td class="pl-0">
                      <?php echo $row["firstName"]; ?>
                    </td>
                    <td>
                      <?php echo $row["lastName"]; ?>
                    </td>
                    <td>
                      <?php echo $row["codes"]; ?>
                    </td>
                    <td>
                      <?php echo $row["courses"]; ?>
                    </td>
                    <td>
                      <?php echo $row["professions"]; ?>
                    </td>
                    <td><?php echo $row["years"]; ?></td>
                    </td>
                    <td >
                      <?php echo $row["phones"]; ?></br><hr/>
                      <?php echo $row["lastSchools"];?>
                     
                    </td>
                    <td>
                      <a href=<?= "?delete=" . $row['id_student'] ?>>Dzēst</a> |
                      <a href="<?= "?edit=" . $row['id_student'] ?>" onclick="document.getElementById('id01')".style.display="block">Rediģēt</a>

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
        $("#myInput").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

          });

        });
      });
    </script>
    <script src="../js/extras/main.js"></script>