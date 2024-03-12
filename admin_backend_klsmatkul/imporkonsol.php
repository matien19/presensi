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

    if (isset($_POST['imporkonsolidasi']))
    {
        $file = $_FILES['filekonsol']['name'];
        $ekstensi = explode (".", $file);
        $file_name = "filekonsol".round(microtime(true)).".".end($ekstensi);
        $sumber = $_FILES['filekonsol']['tmp_name'];
        $target_dir ="template/import/";
        $target_file = $target_dir.$file_name;
        $upload = move_uploaded_file($sumber, $target_file);      

        $file_excel = PHPExcel_IOFactory::load($target_file);
        $data_excel = $file_excel->getActiveSheet()->toArray(null, true,true,true);

        $status = "A";
        $sql_periode = mysqli_query($con, "SELECT Id FROM tbl_periode WHERE stat='$status'") or die (mysqli_error($con));
        $data_periode = mysqli_fetch_assoc($sql_periode);
        $id_periode = $data_periode['Id'];

        for ($j=5; $j <= count($data_excel); $j++)
        {
          $nid              = $data_excel[$j]['B'];
          $kode_matkul      = $data_excel[$j]['C'];
          $kelas            = $data_excel[$j]['D'];
          $nim              = $data_excel[$j]['E'];
          $empty            = "";

          $querycek_klsmk =  mysqli_query($con, "SELECT * FROM tbl_klsmatkul WHERE kode_matkul='$kode_matkul' AND nid='$nid' AND id_periode='$id_periode' AND kelas='$kelas'") or die (mysqli_eror($con));

          if (mysqli_num_rows($querycek_klsmk) == 0)
          {
            
                $query_ceknid = mysqli_query($con, "SELECT nid FROM tbl_dosen WHERE nid = '$nid'") or die (mysqli_eror($con));
                $query_cek_kdmk = mysqli_query($con, "SELECT kode_matkul FROM tbl_matkul WHERE kode_matkul = '$kode_matkul'") or die (mysqli_eror($con));

                if ((mysqli_num_rows($query_ceknid) > 0) && (mysqli_num_rows($query_cek_kdmk)) > 0 ) 
                {
                  mysqli_query($con, "INSERT INTO tbl_klsmatkul VALUES ('','$nid','$kode_matkul','$id_periode','$kelas')") or die (mysqli_eror($con));
                }
          }

          $cekkls  = mysqli_query($con, "SELECT Id FROM tbl_klsmatkul WHERE nid = '$nid' AND kode_matkul = '$kode_matkul' AND id_periode = '$id_periode' AND kelas = '$kelas'") or die (mysqli_error($con));
          $arr     = mysqli_fetch_assoc($cekkls);
          $idkelas = $arr['Id'];
          
          if (mysqli_num_rows($cekkls) > 0 ){
           
            $querycek_mhs =  mysqli_query($con, "SELECT * FROM tbl_pesertamatkul WHERE id_klsmatkul='$idkelas' AND nim='$nim' AND id_periode='$id_periode'") or die (mysqli_eror($con));

            if (mysqli_num_rows($querycek_mhs) == 0)
          {

                $query_ceknim = mysqli_query($con, "SELECT nim FROM tbl_mahasiswa WHERE nim = '$nim'") or die (mysqli_eror($con));
                if ((mysqli_num_rows($query_ceknim) > 0)) 
                {
                  mysqli_query($con, "INSERT INTO tbl_pesertamatkul VALUES ('$idkelas','$nim','$id_periode')") or die (mysqli_eror($con));
                }
          }
          }
          
        }
  
    unlink($target_file);
    }
    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Mata kuliah telah ditambahkan", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_klsmatkul";

  }, 1000);
</script>
</body>
</html>