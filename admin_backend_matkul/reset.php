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
      mysqli_query($con, "TRUNCATE TABLE tbl_matkul") or die (mysqli_eror($con));
    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Mata Kuliah telah direset", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_matkul";
  }, 1000);
</script> 
</body>
</html>
