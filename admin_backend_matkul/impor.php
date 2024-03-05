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

    if (isset($_POST['impor']))
    {
        $file = $_FILES['file']['name'];
        $ekstensi = explode (".", $file);
        $file_name = "file".round(microtime(true)).".".end($ekstensi);
        $sumber = $_FILES['file']['tmp_name'];
        $target_dir ="template/";
        $target_file = $target_dir.$file_name;
        $upload = move_uploaded_file($sumber, $target_file);      

        $file_excel = PHPExcel_IOFactory::load($target_file);
        $data_excel = $file_excel->getActiveSheet()->toArray(null, true,true,true);

        for ($j=2; $j <= count($data_excel); $j++)
        {
       $kd_matkul     = $data_excel[$j]['B'];
       $nama_ind      = addslashes($data_excel[$j]['C']);
       $nama_eng      = addslashes($data_excel[$j]['D']);
       $sks           = $data_excel[$j]['E'];

       
    
       $query_pengguna = mysqli_query($con, "SELECT kode_matkul FROM tbl_matkul WHERE kode_matkul='$kd_matkul'") or die(mysqli_error($con));

         if (mysqli_num_rows($query_pengguna) > 0){

         } else
         {
          mysqli_query($con, "INSERT INTO tbl_matkul VALUES ('','$kd_matkul','$nama_ind','$nama_eng',$sks)");           }
         }
    unlink($target_file);
    }
    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Mata Kuliah telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_matkul";

  }, 1000);
</script>
</body>
</html>