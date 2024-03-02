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
  $nid = @$_GET['nid'];
  $encpass = 'pass'.$nid;
  $pass = sha1($encpass);
      mysqli_query($con, "UPDATE tbl_pengguna SET password='$pass' WHERE username='$nid'") or die (mysqli_eror($con));
    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Dosen telah direset", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_dosen";

  }, 1000);
</script> 
</body>
</html>
