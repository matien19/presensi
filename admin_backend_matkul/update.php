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
      
      if (isset($_POST['editdata']))
      {
        
        $id         = trim(mysqli_real_escape_string($con, $_POST['id']));
        $kd_matkul  = trim(mysqli_real_escape_string($con, $_POST['kd_matkul']));
        $nama_ind   = trim(mysqli_real_escape_string($con, $_POST['nama_ind']));
        $nama_eng   = trim(mysqli_real_escape_string($con, $_POST['nama_eng']));
       
        mysqli_query($con, "UPDATE tbl_matkul SET kode_matkul='$kd_matkul', nama_ind='$nama_ind', nama_eng='$nama_eng' WHERE Id='$id'") or die (mysqli_error($con));
      }
      
  ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Mata Kuliah telah diedit", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_matkul";

  }, 2000);
</script> 
</body>
</html>