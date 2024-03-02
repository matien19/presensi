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
      
      $id = @$_GET['real'];
      mysqli_query($con, "DELETE FROM tbl_periode WHERE Id='$id'") or die (mysqli_eror($con));
    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Periode telah dihapus", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_periode";

  }, 1000);
</script> 
</body>
</html>
