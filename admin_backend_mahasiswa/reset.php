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
      $peran = 'mhs';
      mysqli_query($con, "TRUNCATE TABLE tbl_mahasiswa") or die (mysqli_eror($con));
      mysqli_query($con, "DELETE from tbl_pengguna WHERE peran='$peran'") or die (mysqli_eror($con));
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
