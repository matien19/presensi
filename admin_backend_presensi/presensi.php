<?php 
require_once '../database/config.php';
$hal = 'presensi';
if (isset($_SESSION['peran']))
{
  if ($_SESSION['peran']!='Admin') 
  {
  echo "<script>window.location='../auth/logout.php';</script>";
  }
  
}
else
{
  echo "<script>window.location='../auth/logout.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel | presensi </title>

<?php 
include "../linksheet.php";
?>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php
include '../navbar.php';
?>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

<?php
include '../sidebar_admin.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background-color:#86090f">
               <font color="ffffff">
                <h3 class="card-title"> <i class="nav-icon fas fa-clipboard"></i></i> Data Presensi</h3>
                </div>
                </font>
                <!-- /.card-header -->
                <div class="card-body">
               <div class="row">
                <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-6">
                    <?php
                    $hari_ini = date('d F Y H:i');
                    $hari_ini2 = date('Y-m-d H:i:s');
                    $id_klsmk = @$_GET['id_klsmk'];
                    $query_peserta_mk = mysqli_query($con, "SELECT id_klsmatkul, tbl_pesertamatkul.nim, nama FROM tbl_pesertamatkul, tbl_mahasiswa WHERE tbl_pesertamatkul.nim = tbl_mahasiswa.nim AND id_klsmatkul='$id_klsmk' ") or die (mysqli_error($con));
                    
                    while($datapeserta = mysqli_fetch_array($query_peserta_mk)) {
                      
                    $kehadiran = 'N';
                    $nimmhs = $datapeserta['nim'];
                    $querycekmhs = mysqli_query($con, "SELECT id_klsmatkul, nim FROM tbl_presensi WHERE id_klsmatkul='$id_klsmk' AND nim='$nimmhs'") or die (mysqli_error($con));
                    if (mysqli_num_rows($querycekmhs) == 0){
                     mysqli_query($con, "INSERT INTO tbl_presensi VALUES ('$id_klsmk','$hari_ini2','$nimmhs','$kehadiran')");
                    
                    $query_cektgl = mysqli_query($con, "SELECT id_klsmatkul, tgl_presensi FROM tbl_tglpresensi WHERE id_klsmatkul='$id_klsmk' AND tgl_presensi='$hari_ini2'") or die (mysqli_error($con));
                      if (mysqli_num_rows($query_cektgl) == 0){
                       mysqli_query($con, "INSERT INTO tbl_presensi VALUES ('',$id_klsmk','$hari_ini2')");
                      }
                    } else {
                    }

                    }
                    
                    $enc_idklsmk = SHA1($id_klsmk);
                    $sql_kelasmatkul = mysqli_query($con, "SELECT tbl_periode.tahun as tahun,tbl_periode.semester as semester, tbl_periode.id as id_periode, tbl_dosen.nama as nama_dosen,tbl_matkul.nama_ind as nama_mk_ind,tbl_matkul.nama_eng as nama_mk_eng,tbl_klsmatkul.kelas as kelas FROM tbl_periode,tbl_dosen,tbl_matkul,tbl_klsmatkul WHERE tbl_klsmatkul.id='$id_klsmk' AND tbl_klsmatkul.nid = tbl_dosen.nid AND tbl_periode.Id=tbl_klsmatkul.id_periode AND tbl_matkul.kode_matkul=tbl_klsmatkul.kode_matkul") or die (mysqli_error($con));
                    $dataklsmatkul = mysqli_fetch_assoc($sql_kelasmatkul);
                    $tahun = $dataklsmatkul['tahun'];
                    $semester = $dataklsmatkul['semester'];
                    $id_periode = $dataklsmatkul['id_periode'];
                    $nama_dosen = $dataklsmatkul['nama_dosen'];
                    $nama_ind = $dataklsmatkul['nama_mk_ind'];
                    $nama_eng = $dataklsmatkul['nama_mk_eng'];
                    $kelas = $dataklsmatkul['kelas'];
                    ?>
                  <table class="table table-bordered table-sm">  
                      <tbody>
                      <tr>
                          <td><b>Tahun Akademik</b></td>
                          <td><?= $tahun. ' - ' .$semester;?></td>
                      </tr>
                      <tr>
                        <td><b>Dosen Pengampu</b></td>
                        <td><?= $nama_dosen; ?></td>
                      </tr>
                      <tr>
                        <td><b>Mata Kuliah</b></td>
                        <td><?=$nama_ind;?></td>
                      </tr>
                      <tr>
                        <td><b>Kelas</b></td>
                        <td><?=$kelas;?></td>
                      </tr>
                      </tbody>
                    </table>
                    <?php
                    
                    
                    // memanggil library php qrcode
                    include "phpqrcode/qrlib.php"; 

                    // nama folder tempat penyimpanan file qrcode
                    $penyimpanan = "qr_temp/";

                    // membuat folder dengan nama "temp"
                    if (!file_exists($penyimpanan))
                    mkdir($penyimpanan);

                    // perintah untuk membuat qrcode dan menyimpannya dalam folder temp
                    // atur level pemulihan datanya dengan QR_ECLEVEL_L | QR_ECLEVEL_M | QR_ECLEVEL_Q | QR_ECLEVEL_H
                    // atur pixel qrcode pada parameter ke 4
                    // atur jarak frame pada parameter ke 5
                    QRcode::png($id_klsmk, $penyimpanan.$id_klsmk.round(microtime(true)).'.png', QR_ECLEVEL_L, 10, 5); 

                    // menampilkan qrcode
                    $file_qr = $penyimpanan.$id_klsmk.round(microtime(true)).'.png';
                  ?>
                  <center>
                    <?php

                  echo '<img src="'.$file_qr.'">';
                  ?>
            
                  <h6>Digenerate oleh : <b><?=$nama_dosen;?></b> 
                  <br> pada : <?= $hari_ini;?> </h6>
                  </center>

                  </div>

                  <div class="col-lg-6" >
                  <div id="presensi">
                    <?php
                    include "tablepresensi.php";
                    ?>
                 
                  </div>
                  </div>
                </div>
               </div>
               </div>

      
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            </div>
      </div>
      <!-- /.container-fluid -->
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php 
include "../footer.php";
?>

</div>
<!-- ./wrapper -->

<?php 
include "../script.php";
?>
<script type="text/javascript">
    $(document).ready(function(){
      refreshTable();
    });

    function refreshTable(){
        $('#presensi').load('tablepresensi.php', function(){
           setTimeout(refreshTable, 10000);
        });
    }
</script>


</body>
</html>