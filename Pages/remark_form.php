<div id="id02" class="modal">

  <form class="modal-content animate" method="get">
    <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close">&times;</span>
    <div class="container">
      Vārds: <input type="text" name="fname" />
      Uzvārds: <input type="text" name="lname" />
      Piezīme: <textarea style="margin-bottom:15px;" type="text" name="names"></textarea>
      <input type="submit" class="btn btn-success" name="newRemark" value="Pievienot" />

      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="btn btn-danger">Cancel</button>

    </div>

  </form>
</div>

<div id="id01" style="<?php if ($_GET['edit']) {
                        echo 'display:block;';
                      } ?>" class="modal">





  <form class="modal-content animate" method="get">




    <span onclick="document.getElementById('id01').style.display='none';window.location = '../Pages/remark_page.php'" class="close" title="Close">&times;</span>
    <div class="container">
      Vārds: <input type="text" name="fname" value="<?= $remarksService->getRemarksByID($conn, $_GET['edit'])->getFirstName(); ?> " />
      Uzvārds: <input type="text" name="lname" value="<?= $remarksService->getRemarksByID($conn, $_GET['edit'])->getLastName(); ?> " />
      <label>Piezīme:</label>
      <textarea style="margin-bottom:15px;" type="text" name="names"><?= $remarksService->getRemarksByID($conn, $_GET['edit'])->getRnames(); ?></textarea>

      <button type="submit" class="btn btn-success" name="edit" value="<?= $_GET['edit'] ?>">Update</button>

      <button type="button" onclick="document.getElementById('id01').style.display='none'; window.location = '../Pages/remark_page.php'" class="btn btn-danger">Cancel</button>

    </div>



  </form>
</div>