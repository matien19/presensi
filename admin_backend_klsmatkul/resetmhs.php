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
      $peran = 'dosen';
      mysqli_query($con, "TRUNCATE TABLE tbl_klsmatkul") or die (mysqli_eror($con));
      mysqli_query($con, "TRUNCATE TABLE tbl_pesertamatkul") or die (mysqli_eror($con));
    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Kelas Mata Kuliah telah direset", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_klsmatkul?id=<?$id_klsmk;?>";

  }, 1000);
</script> 
</body>
</html>
