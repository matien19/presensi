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
        $file_name = "filemhskls".round(microtime(true)).".".end($ekstensi);
        $sumber = $_FILES['file']['tmp_name'];
        $target_dir ="template/import/";
        $target_file = $target_dir.$file_name;
        $upload = move_uploaded_file($sumber, $target_file);      

        $file_excel = PHPExcel_IOFactory::load($target_file);
        $data_excel = $file_excel->getActiveSheet()->toArray(null, true,true,true);

        for ($j=2; $j <= count($data_excel); $j++)
        {
          $id_klsmk = $_POST['id_klsmk'];
          $nim  = $data_excel[$j]['B'];
          $id_periode = @$_GET['id_periode'];
          $kosong = '';

          $querycek_mhs =  mysqli_query($con, "SELECT * FROM tbl_pesertamatkul WHERE id_klsmatkul='$id_klsmk' AND nim='$nim' AND id_periode='$id_periode'") or die (mysqli_eror($con));

          if (mysqli_num_rows($querycek_mhs) == 0)
          {

                $query_ceknim = mysqli_query($con, "SELECT nim FROM tbl_mahasiswa WHERE nim = '$nim'") or die (mysqli_eror($con));
                if ((mysqli_num_rows($query_ceknim) > 0)) 
                {
                  mysqli_query($con, "INSERT INTO tbl_pesertamatkul VALUES ('$id_klsmk','$nim','$id_periode')") or die (mysqli_eror($con));
                }else{
                }
          }
          else
          {
          
          }
         }
      unlink($target_file);

      }

    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data mahasiswa telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_klsmatkul/klsmatkul.php?id=<?=$id_klsmk;?>";

  }, 1000);
</script>
</body>
</html>