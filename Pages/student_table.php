        <link rel="stylesheet" href="../css/extras/owl.carousel.min.css">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../css/extras/bootstrap.min.css">

        <!-- Style -->
        <link rel="stylesheet" href="../css/table/style.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <?php
        ini_set('display_errors', '1');
        include_once($_SERVER["DOCUMENT_ROOT"] . "/KVD/extras/includes.php");
        $connect = mysqli_connect("localhost", "root", "root", "KVD");

        ?>
        <div class="content">
          <div class="container">
            <div class="table-responsive">

              <?php

              $sqlQuery = "SELECT * FROM students ";
              $resultSet = mysqli_query($conn, $sqlQuery) or die("database error:" . mysqli_error($conn));
              ?>
              <table class="table table-striped custom-table">
                <div class="form-group pull-right">
                  <input class="form-control" id="myInput" type="text" placeholder="Search..">
                </div>
                <thead>
                  <tr>
                    <th scope="col">
                      <label class="control control--checkbox">
                        <input type="checkbox" id="selectAllCheckbox" onclick="checkAll();" class="js-check-all" />
                        <div class="control__indicator"></div>
                      </label>
                    </th>
                    <th scope="col">ID</th>
                    <th scope="col">Vards</th>
                    <th scope="col">Uzvards</th>
                    <th scope="col">Personas kods</th>
                    <th scope="col">Kurss</th>
                    <th scope="col">Profesija</th>
                    <th scope="col">Gads</th>
                    <th scope="col">Funkcijas</th>

                  </tr>
                </thead>
                <tbody id="myTable">
                  <?php while ($developer = mysqli_fetch_assoc($resultSet)) { ?>
                    <tr scope="row">
                      <td>
                        <label class="control control--checkbox">
                          <input type="checkbox" />
                          <div class="control__indicator"></div>
                        </label>
                      </td>
                      <td>
                        <?php echo $developer['id_student']; ?>
                      </td>
                      <td class="pl-0">


                        <?php echo $developer['firstName']; ?>

                      </td>
                      <td>
                        <?php echo $developer['lastName']; ?>

                      </td>
                      <td><?php echo $developer['codes']; ?></td>
                      <td>
                        <?php echo $developer['courses']; ?>

                      </td>
                      <td>
                        <?php echo $developer['professions']; ?>

                      </td>
                      <td>
                        <?php echo $developer['years']; ?>

                      </td>
                      <td><a href=<?= "?delete=" . $developer['id_student'] ?> class="more">Delete</a> |


                        <a href=<?= "?edit=" . $developer['id_student'] ?> onclick="document.getElementById('id01').style.display='block'">Edit</a>
                      </td>
                    </tr>


                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
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
        <script src="../js/extras/bootstrap.min.js"></script>
        <script src="../js/extras/jquery.min.js"></script>
        <script src="../js/extras/main.js"></script>
        <script src="../js/extras/owl.carousel.min.js"></script>
        <script src="../js/extras/popper.js"></script>