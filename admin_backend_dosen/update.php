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
        
        $nid      = trim(mysqli_real_escape_string($con, $_POST['nid2']));
        $nama   = trim(mysqli_real_escape_string($con, $_POST['nama']));
        $kontak   = trim(mysqli_real_escape_string($con, $_POST['kontak']));
        $kelamin   = trim(mysqli_real_escape_string($con, $_POST['kelamin']));
        $status   = trim(mysqli_real_escape_string($con, $_POST['status']));
      
         //inisialisasi ulang kelamin
      if ($kelamin == 'Laki-laki' ) {
        $kelamin2 = 'L';
      }
      else {
        $kelamin2 = 'P';
      }
      //inisialisasi ulang status
      if ($status == 'Aktif' ) {
        $status2 = 'A';
      }
      else {
        $status2 = 'T';
      }

      mysqli_query($con, "UPDATE tbl_dosen SET nama='$nama',kontak ='$kontak', kelamin ='$kelamin2', stat='$status2' WHERE nid='$nid'") or die (mysqli_eror($con));
      mysqli_query($con, "UPDATE tbl_pengguna SET nama='$nama' WHERE username='$nid'") or die (mysqli_eror($con));
      }
      
    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Dosen telah diedit", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_dosen";

  }, 2000);
</script> 
</body>
</html>