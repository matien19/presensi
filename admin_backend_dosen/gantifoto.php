<?php 
require_once "../database/config.php";
require "../assets_adminlte/dist/phpexcel-xls-library/vendor/phpoffice/phpexcel/Classes/PHPExcel.php";
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="wrapper" style="zoom:90%" !important>
  <?php

    if (isset($_POST['gantifoto']))
    {
        $niddosen = trim(mysqli_real_escape_string($con, $_POST['niddosen']));
        $file = $_FILES['filefoto']['name'];
        $ekstensi = explode (".", $file);
        $file_name = "dosen"."-".$niddosen."-".round(microtime(true)).".".end($ekstensi);
        $sumber = $_FILES['filefoto']['tmp_name'];
        $target_dir ="template/img/";
        $target_file = $target_dir.$file_name;
        $upload = move_uploaded_file($sumber, $target_file);      
    
        mysqli_query($con, "UPDATE tbl_dosen SET foto='$target_file' WHERE nid='$niddosen'") or die (mysqli_error($con));
    }
    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Foto Dosen telah diganti", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_dosen";

  }, 1000);
</script>
</body>
</html>