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
  $nim = @$_GET['nim'];
  $encpass = 'pass'.$nim;
  $pass = sha1($encpass);
      mysqli_query($con, "UPDATE tbl_pengguna SET password='$pass' WHERE username='$nim'") or die (mysqli_eror($con));
    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Mahasiswa telah direset", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_mahasiswa";

  }, 1000);
</script> 
</body>
</html>
