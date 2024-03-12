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
      
      $nim          = trim(mysqli_real_escape_string($con, $_POST['mhs']));
      $id_klsmk     = @$_GET['id'];
      $id_periode   = @$_GET['id_periode'];

      $querycek_mhs =  mysqli_query($con, "SELECT * FROM tbl_pesertamatkul WHERE id_klsmatkul='$id_klsmk' AND nim='$nim' AND id_periode='$id_periode'") or die (mysqli_eror($con));
       if (mysqli_num_rows($querycek_mhs) > 0)
       {
        echo '
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
          swal("Peringatan", "Data Mahasiswa yang diinput sudah ada di Kelas!!", "warning");
          
          setTimeout(function(){ 
          window.location.href = "../admin_backend_klsmatkul/klsmatkul.php?id='.$id_klsmk.'";

          }, 1500);
          </script>
        ';
       }
      else
       {
        mysqli_query($con, "INSERT INTO tbl_pesertamatkul VALUES ('$id_klsmk','$nim','$id_periode')") or die (mysqli_eror($con));
        echo '
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
          swal("Berhasil", "Data Mahasiswa telah ditambahkan", "success");
          
          setTimeout(function() { 
          window.location.href = "../admin_backend_klsmatkul/klsmatkul.php?id='.$id_klsmk.'";

          }, 1500);
          </script>

        ';
       }
    }

    ?>


</body>
</html>