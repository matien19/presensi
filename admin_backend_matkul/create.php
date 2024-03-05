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
    if (isset($_POST['tambahdata']))
    {
      
      $kd_matkul  = trim(mysqli_real_escape_string($con, $_POST['kd_matkul']));
      $nama_ind   = trim(mysqli_real_escape_string($con, $_POST['nama_ind']));
      $nama_eng   = trim(mysqli_real_escape_string($con, $_POST['nama_eng']));
      $sks        = trim(mysqli_real_escape_string($con, $_POST['sks']));

      $querycek   =  mysqli_query($con, "SELECT * FROM tbl_matkul WHERE kode_matkul ='$kd_matkul'") or die (mysqli_error($con));

       if (mysqli_num_rows($querycek) > 0)
       {
           echo '
           <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
              swal("Peringatan", "Kode mata kuliah sudah Ada", "warning");
              
              setTimeout(function(){ 
              window.location.href = "../admin_backend_matkul";

              }, 2000);
            </script>
           ';

       }
      else
       {
           mysqli_query($con, "INSERT INTO tbl_matkul VALUES ('','$kd_matkul','$nama_ind','$nama_eng','$sks')") or die (mysqli_error($con));
           echo '
           <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
              swal("Berhasil", "Data mata kuliah telah ditambahkan", "success");
              
              setTimeout(function(){ 
              window.location.href = "../admin_backend_matkul";

              }, 1000);
            </script>
           ';
       }
          
    }

    ?>

</body>
</html>