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
<form class="" action="" method="post">
<div class="content">
  <div class="container">
    <div class="table-responsive">
    <button type="submit" class="btn btn-danger" name="massdelete">Delete</button> 
      <?php
      $rows = mysqli_query($conn, "SELECT * FROM remarks");
      ?>
      
      <table class="table table-striped custom-table">
        <div class="form-group pull-right">
          <input class="form-control" id="myInput" type="text" placeholder="Search..">
        </div>
        <thead>
          <tr>
            <th scope="col">
            <label class="control control--checkbox">
              <input type="checkbox" id="selectAllCheckbox" onclick="checkAll();" class="js-check-all" name="deleteId[]" value="<?php echo $row['id_remarks']; ?>">
              <div class="control__indicator"></div>
              </label>
            </th>
            <th scope="col">ID</th>
            <th scope="col">Vards</th>
            <th scope="col">Uzvards</th>
            <th scope="col">Piezēme</th>
            <th scope="col">Funkcijas</th>

          </tr>
        </thead>
        <tbody id="myTable">
          <?php  $i = 1;
        foreach($rows as $row) : ?>
            
            <tr scope="row">
              <td>
                <label class="control control--checkbox">
                  <input type="checkbox" name="deleteId[]"  value="<?php echo $row['id_remarks']; ?>">
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
              <td><?php echo $row["names"]; ?></td>
             

              </td>
              <td><a href=<?= "?delete=" . $row['id_remarks'] ?> class="more">Delete</a> |
                <a href=<?= "?edit=" . $row['id_remarks'] ?> onclick="document.getElementById('id01').style.display='block'">Edit</a>
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
<script src="../js/extras/bootstrap.min.js"></script>
<script src="../js/extras/jquery.min.js"></script>
<script src="../js/extras/main.js"></script>
<script src="../js/extras/owl.carousel.min.js"></script>
<script src="../js/extras/popper.js"></script>

      
          
    