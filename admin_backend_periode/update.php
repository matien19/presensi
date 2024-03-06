<?php 
require_once "../database/config.php";
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="wrapper" style="zoom:90%" !important>
  <?php
      
      $id         = @$_GET['real'];
      $aktif      = 'A';
      $nonaktif   = 'T';

      mysqli_query($con, "UPDATE tbl_periode SET stat='$nonaktif'") or die (mysqli_eror($con));

      mysqli_query($con, "UPDATE tbl_periode SET stat='$aktif' WHERE Id='$id'") or die (mysqli_eror($con));
    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Periode telah diaktifkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_periode";

  }, 2000);
</script> 
</body>
</html>