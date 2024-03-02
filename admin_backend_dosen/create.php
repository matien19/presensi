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
      
      $nid      = trim(mysqli_real_escape_string($con, $_POST['nid']));
      $nama   = trim(mysqli_real_escape_string($con, $_POST['nama']));
      $kontak   = trim(mysqli_real_escape_string($con, $_POST['kontak']));
      $kelamin   = trim(mysqli_real_escape_string($con, $_POST['kelamin']));
      $status   = trim(mysqli_real_escape_string($con, $_POST['status']));
      $encpass = 'pass'.$nid;
      $pass = sha1($encpass);
      $peran = 'dosen';
      $foto  = "";

      //inisialisasi kelamin
      if ($kelamin == 'Laki-laki' ) {
        $kelamin2 = 'L';
      }
      else {
        $kelamin2 = 'P';
      }
      //inisialisasi status
      if ($status == 'Aktif' ) {
        $status2 = 'A';
      }
      else {
        $status2 = 'T';
      }

      $querycek   =  mysqli_query($con, "SELECT * FROM tbl_dosen WHERE nid ='$nid'") or die (mysqli_error($con));

       if (mysqli_num_rows($querycek) > 0)
       {
           echo "<script>alert('Maaf, Transaksi Gagal! Data Dosen yang diinput sudah ada..');</script>";
           echo "<script>window.location='../admin_backend_dosen';</script>";

       }
      else
       {
           mysqli_query($con, "INSERT INTO tbl_dosen VALUES ('$nid','$nama','$kontak','$kelamin2','$status2','$foto')") or die (mysqli_error($con));
           mysqli_query($con, "INSERT INTO tbl_pengguna VALUES ('','$nid','$pass','$peran','$nama')") or die (mysqli_error($con));
       }
          
    }

    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Dosen telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_dosen";

  }, 1000);
</script>
</body>
</html>