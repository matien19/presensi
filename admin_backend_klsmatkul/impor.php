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
        $target_dir ="template/import/";
        $target_file = $target_dir.$file_name;
        $upload = move_uploaded_file($sumber, $target_file);      

        $file_excel = PHPExcel_IOFactory::load($target_file);
        $data_excel = $file_excel->getActiveSheet()->toArray(null, true,true,true);

        for ($j=4 ; $j <= count($data_excel); $j++)
        {
          $kode_mk  = $data_excel[$j]['B'];
          $nid      = $data_excel[$j]['C'];
          $kelas    = $data_excel[$j]['D'];
          $id_periode = @$_GET['id_periode'];
          $kosong = '';

          $querycek_klsmk =  mysqli_query($con, "SELECT * FROM tbl_klsmatkul WHERE kode_matkul='$kode_mk' AND nid='$nid' AND id_periode='$id_periode' AND kelas='$kelas'") or die (mysqli_eror($con));

          if (mysqli_num_rows($querycek_klsmk) == 0)
          {
                $query_ceknid = mysqli_query($con, "SELECT nid FROM tbl_dosen WHERE nid = '$nid'") or die (mysqli_eror($con));
                $query_cek_kdmk = mysqli_query($con, "SELECT kode_matkul FROM tbl_matkul WHERE kode_matkul = '$kode_mk'") or die (mysqli_eror($con));
                if ((mysqli_num_rows($query_ceknid) > 0) && (mysqli_num_rows($query_cek_kdmk)) > 0 ) 
                {
                  mysqli_query($con, "INSERT INTO tbl_klsmatkul VALUES ('','$nid','$kode_mk','$id_periode','$kelas')") or die (mysqli_eror($con));
                }else{
                }
          }
          else
          {
          
          }
         }
      }

    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data mahasiswa telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_klsmatkul";

  }, 1000);
</script>
</body>
</html>