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
      
      $tahun      = trim(mysqli_real_escape_string($con, $_POST['tahunakademik']));
      $semester   = trim(mysqli_real_escape_string($con, $_POST['semester']));
      $status     = "T";

      $querycek   =  mysqli_query($con, "SELECT * FROM tbl_periode WHERE tahun ='$tahun' AND semester='$semester'") or die (mysqli_eror($con));

       if (mysqli_num_rows($querycek) > 0)
       {
           echo "<script>alert('Maaf, Transaksi Gagal! Data Tahun dan Semester yang diinput sudah ada..');</script>";
           echo "<script>window.location='../admin_backend_periode';</script>";

       }
      else
       {
           mysqli_query($con, "INSERT INTO tbl_periode VALUES ('','$tahun','$semester','$status')") or die (mysqli_eror($con));
       }
          
    }

    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Periode telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_periode";

  }, 1000);
</script>
</body>
</html>