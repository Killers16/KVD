<?php
if(isset($_POST['buttonDelete'])) {
	if(isset($_POST['id_remarks'])) {
		foreach ($_POST['id_remarks'] as $id_remarks) {
			$stmt = $conn->prepare('delete from remarks where id_remarks = :id_remarks');
			$stmt->bindValue('id_remarks', $id_remarks);
			$stmt->execute();
		}
	}
}
header("location: /KVD/Pages/remark_page.php");
