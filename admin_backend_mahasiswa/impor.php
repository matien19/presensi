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
       $nim       = $data_excel[$j]['B'];
       $nama      = addslashes($data_excel[$j]['C']);
       $nohp      = $data_excel[$j]['D'];
       $kelamin   = $data_excel[$j]['E'];
       $stat      = $data_excel[$j]['F'];
       $encpass   = 'pass'.$nim;
       $pass      = sha1($encpass);
       $peran     = 'mhs';
       $kosong = '';
    
         mysqli_query($con, "INSERT INTO tbl_mahasiswa VALUES ('$nim','$nama','$kelamin','$nohp','$stat','$kosong')");      
         mysqli_query($con, "DELETE FROM tbl_mahasiswa WHERE nim='$kosong'");      

         $query_pengguna = mysqli_query($con, "SELECT username FROM tbl_pengguna WHERE username='$nim'") or die(mysqli_error($con));

         if (mysqli_num_rows($query_pengguna) > 0){

         }else{
            mysqli_query($con, "INSERT INTO tbl_pengguna VALUES ('','$nim','$pass','$peran','$nama')") or die(mysqli_error($con)); 
            mysqli_query($con, "DELETE FROM tbl_pengguna WHERE id='$kosong'") or die(mysqli_error($con)); 

         }
        }
    unlink($target_file);
    }
    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data mahasiswa telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_mahasiswa";

  }, 1000);
</script>
</body>
</html>