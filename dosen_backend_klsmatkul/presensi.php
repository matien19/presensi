<?php 
require_once '../database/config.php';
$hal = 'klsmatkul';
if (isset($_SESSION['peran']))
{
  if ($_SESSION['peran']!='dosen') 
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
  <title>Dosen Panel | Presensi </title>

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
include '../sidebar_dosen.php';
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
                    $hari_ini = date('d-m-Y');
                    $hari_ini2 = date('Y-m-d');
                    $id_klsmk = @$_GET['id_klsmk'];
                    $state = 'Y';
                    $validasi = "0";
                    $query_jumlah_pertemuan = mysqli_query($con, "SELECT COUNT(id_klsmatkul) AS pertemuan FROM tbl_pertemuan WHERE id_klsmatkul='$id_klsmk' ") or die(mysqli_error($con));
                    $data_pertemuan = mysqli_fetch_assoc($query_jumlah_pertemuan);
                    if ($data_pertemuan == 0) {
                      $pertemuan = 1;
                      
                    }else{
                      $pertemuan_ke = $data_pertemuan['pertemuan'];
                    $query_cek_validasi = mysqli_query($con, "SELECT validasi FROM tbl_pertemuan WHERE id_klsmatkul='$id_klsmk' AND pertemuan='$pertemuan_ke'") or die(mysqli_error($con)) ;
                    $data_validasi = mysqli_fetch_assoc($query_cek_validasi);
                    if ($data_validasi != null) {
                      $validasi = $data_validasi['validasi'];
                    } else{
                      $validasi = 0;
                    }
                    if ($validasi ==  1 ) {
                      $pertemuan = $pertemuan_ke + 1;
                    }else {
                      $pertemuan = $pertemuan_ke;
                    }
                    }
                    
                    $query_peserta_mk = mysqli_query($con, "SELECT id_klsmatkul, tbl_pesertamatkul.nim, nama FROM tbl_pesertamatkul, tbl_mahasiswa WHERE tbl_pesertamatkul.nim = tbl_mahasiswa.nim AND id_klsmatkul='$id_klsmk' ") or die (mysqli_error($con));
                    
                    while($datapeserta = mysqli_fetch_array($query_peserta_mk)) {
                      
                    $kehadiran = 'N';
                    $nimmhs = $datapeserta['nim'];
                    $querycekmhs = mysqli_query($con, "SELECT id_klsmatkul, nim FROM tbl_presensi WHERE id_klsmatkul='$id_klsmk' AND nim='$nimmhs' AND tanggal='$hari_ini2'") or die (mysqli_error($con));
                    if (mysqli_num_rows($querycekmhs) == 0){
                    $bulan = date( 'F', strTotime($hari_ini2));
     
                     mysqli_query($con, "INSERT INTO tbl_presensi VALUES ('$id_klsmk','$hari_ini2','$nimmhs','$kehadiran','$bulan')");
                    }
                    
                    $query_cektgl = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE id_klsmatkul='$id_klsmk' AND tanggal ='$hari_ini2'") or die (mysqli_error($con));
                      if (mysqli_num_rows($query_cektgl) > 0){
                      
                       $query_state = mysqli_query($con, "SELECT state FROM tbl_temp_presensi WHERE id_klsmatkul='$id_klsmk'") or die (mysqli_error($con));
                      
                         if (mysqli_num_rows($query_state) > 0){
                          mysqli_query($con, "UPDATE tbl_temp_presensi SET state='$state' WHERE id_klsmatkul='$id_klsmk'") or die (mysqli_error($con));
                          
                         } else {
                          mysqli_query($con, "INSERT INTO tbl_temp_presensi VALUES ('$id_klsmk','$state')") or die (mysqli_error($con));
                         }
                      }
                    }
                    $query_cek_pertemuan = mysqli_query($con, "SELECT * FROM tbl_pertemuan WHERE id_klsmatkul='$id_klsmk' AND tanggal='$hari_ini2'") or die(mysqli_error($con));
                    if (mysqli_num_rows($query_cek_pertemuan) > 0){
                      
                    }else {
                      mysqli_query($con, "INSERT INTO tbl_pertemuan VALUES ('$id_klsmk','$validasi','$hari_ini2','$pertemuan')") or die(mysqli_error($con));
                    }

                    
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
                    <div class="row">
                      <div class="col-lg-12">
                        Pertemuan Ke :
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                      <form class="form-horizontal" action="presensi_history.php?id_klsmk=<?=$id_klsmk;?>" method="POST" >
                        <div class="form-group">
                        <select class="form-control" name="pertemuan" requried>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        </select>
                        </div>
                      </div>

                        <div class="col-lg-6">
                        <label for="tahun akademik"></label>
                        <button type="submit" class="btn btn-primary btn-md" name="cari">
                        <i class="nav-icon fas fa-search"></i> Tampilkan
                       </button>
                  </form>
                </div>
              </div>
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
                      <tr>
                        <td><b>Pertemuan Ke</b></td>
                        <td><?=$pertemuan;?></td>
                      </tr>
                      </tbody>
                    </table>
                    <a href="../dosen_backend_klsmatkul" class="btn btn-warning btn-sm">
                      <i class="nav-icon fas fa-chevron-left"></i> kembali
                    </a>
                    <a href="tutuppresensi.php?id=<?=$id_klsmk;?>&pertemuan=<?=$pertemuan;?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda akan menutup Presensi ?')">Tutup Presensi</a>
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
                    $nama_qr = $nama_dosen.'-'.$nama_ind.'-'.$kelas.'-'.$hari_ini;
                    QRcode::png($id_klsmk, $penyimpanan.$nama_qr.'.png', QR_ECLEVEL_L, 10, 5); 

                    // menampilkan qrcode
                    $file_qr = $penyimpanan.$nama_qr.'.png';
                  ?>
                  <center>
                    <?php

                  echo '<img src="'.$file_qr.'">';
                  ?>
            
                  <h6>Digenerate oleh : <b><?=$nama_dosen;?></b> 
                  <br> pada : <?= $hari_ini;?> 
                  <br> Berakhir Pada : <label for="timer"><div id="timer"></div></label>
                 </h6>
                  </center>
                  </div>
                  <div class="col-lg-6" >
                  <div id="presensi">
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
        $('#presensi').load('tablepresensi.php?id_klsmk=<?= $id_klsmk;?>', function(){
           setTimeout(refreshTable, 5000);
        });
    }
</script>
<script type="text/javascript">
    function countdownTimer() {
        var countDownDate = new Date().getTime() + 600000; // 1 menit (60000 milidetik)
        
        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";
            
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "Waktu telah habis!";
                window.location.href = "tutuppresensi.php?id=<?= $id_klsmk;?>";
            }
        }, 1000);
    }
    countdownTimer();
</script>

</body>
</html>
