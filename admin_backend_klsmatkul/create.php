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
      
      $nid      = trim(mysqli_real_escape_string($con, $_POST['dosen']));
      $kode_mk   = trim(mysqli_real_escape_string($con, $_POST['matkul']));
      $kelas   = trim(mysqli_real_escape_string($con, $_POST['kelas']));
      $id_periode = @$_GET['id_periode'];

      $querycek_klsmk =  mysqli_query($con, "SELECT * FROM tbl_klsmatkul WHERE kode_matkul='$kode_mk' AND nid='$nid' AND id_periode='$id_periode' AND kelas='$kelas'") or die (mysqli_eror($con));

       if (mysqli_num_rows($querycek_klsmk) > 0)
       {
        echo '
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
          swal("Peringatan", "Data Kelas Mata Kuliah yang diinput sudah ada!!", "warning");
          
          setTimeout(function(){ 
          window.location.href = "../admin_backend_klsmatkul";

          }, 1500);
          </script>

        ';
       }
      else
       {
        mysqli_query($con, "INSERT INTO tbl_klsmatkul VALUES ('','$nid','$kode_mk','$id_periode','$kelas')") or die (mysqli_eror($con));
        echo '
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
          swal("Berhasil", "Data Dosen telah ditambahkan", "success");
          
          setTimeout(function(){ 
          window.location.href = "../admin_backend_klsmatkul";

          }, 1500);
          </script>

        ';
       }
    }

    ?>


</body>
</html>