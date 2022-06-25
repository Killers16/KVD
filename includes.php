<?php
error_reporting(error_reporting() & ~E_NOTICE);
include_once("../services/certificates_service.php");
include_once("../services/students_service.php");
include_once("../services/remarks_service.php");
include_once("../data/students.php");
include_once("../data/remarks.php");
include_once("../data/certificates.php");
include_once("../config.php");
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet"> -->

<link rel="stylesheet" href="../css/sidebar/style.css">
<link rel="stylesheet" href="../css/form/style.css">
<link rel="stylesheet" href="../css/table/style.css">
<link rel="stylesheet" href="../css/extras/owl.carousel.min.css">

<script src="../js/script.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>-->
<!--<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
