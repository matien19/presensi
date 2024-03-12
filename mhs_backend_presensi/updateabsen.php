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
      
      $id_klsmatkul        = @$_GET['id'];
      $nim                 = @$_GET['nim'];
      $hari_ini = date('Y-m-d H:i:s');
      $hadir ='Y';
      mysqli_query($con, "UPDATE tbl_presensi SET kehadiran='$hadir' WHERE id_klsmatkul='$id_klsmatkul' AND nim='$nim'") or die (mysqli_eror($con));

    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Berhasil Absen", "success");
  
  setTimeout(function(){ 
   window.location.href = "../mhs_backend_presensi";

  }, 2000);
</script> 
</body>
</html>