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
      
      $id = @$_GET['id'];
      mysqli_query($con, "DELETE FROM tbl_pengguna WHERE Id='$id'") or die (mysqli_eror($con));
    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Admin telah dihapus", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_administrator";

  }, 1000);
</script> 
</body>
</html>
