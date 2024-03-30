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
      
      $nim      = trim(mysqli_real_escape_string($con, $_POST['nim']));
      $nama   = trim(mysqli_real_escape_string($con, $_POST['nama']));
      $kontak   = trim(mysqli_real_escape_string($con, $_POST['kontak']));
      $kelamin   = trim(mysqli_real_escape_string($con, $_POST['kelamin']));
      $status   = trim(mysqli_real_escape_string($con, $_POST['status']));
      $jurusan   = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
      $encpass = 'pass'.$nim;
      $pass = sha1($encpass);
      $peran = 'mhs';
      $foto ='';

      //inisialisasi kelamin
      if ($kelamin == 'Laki-laki' ) {
        $kelamin = 'L';
      }
      else {
        $kelamin = 'P';
      }
      //inisialisasi status
      if ($status == 'Aktif' ) {
        $status = 'A';
      }
      else {
        $status = 'T';
      }

      $querycek   =  mysqli_query($con, "SELECT * FROM tbl_mahasiswa WHERE nim ='$nim'") or die (mysqli_error($con));

       if (mysqli_num_rows($querycek) > 0)
       {
           echo "<script>alert('Maaf, Proses Gagal! Data Mahasiswa yang diinput sudah ada..');</script>";
           echo "<script>window.location='../admin_backend_mahasiswa';</script>";

       }
      else
       {
           mysqli_query($con, "INSERT INTO tbl_mahasiswa VALUES ('$nim','$nama','$kelamin','$kontak','$status','$foto','$jurusan')") or die (mysqli_error($con));
           mysqli_query($con, "INSERT INTO tbl_pengguna VALUES ('','$nim','$pass','$peran','$nama')") or die (mysqli_eror($con));

           echo '
           <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
              swal("Berhasil", "Data mahasiswa telah ditambahkan", "success");
              
              setTimeout(function(){ 
              window.location.href = "../admin_backend_mahasiswa";

              }, 1000);
            </script>
           ';
       }
          
    }

    ?>


</body>
</html>