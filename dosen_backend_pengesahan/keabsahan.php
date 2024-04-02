<?php
require_once '../database/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pengesahan</title>
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets_adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets_adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <img src="../img/logo_upb.png" alt="" width="250px">
  </div>
  <!-- User name -->
  <center>
  <div class="lockscreen-name"><h5 for="judul"><b> SISTEM PRESENSI MAHASISWA </b><br>
UNIVERSITAS PERADABAN</h5></div>
<br>
<h6>Menyatakan :</h6>
  <!-- START OCK SCREEN ITEM -->
    <!-- lockscreen image -->
    <!-- <img src="../img/verified.jpg" alt="User Image" width="70px" height="70px" > -->
  <button type="button" class="btn btn-success">Dokumen ini telah disahkan oleh :
  </button>
  </center>
     <br>
  <div class="row">
    <?php 
    $nama = @$_GET['nama'];
    $tahun = @$_GET['tahun'];
    $matkul = @$_GET['matkul'];
    $tanggal = @$_GET['tanggal'];
    ?>
    <table class="table table-bordered table-sm">
    <tbody>
                      <tr>
                          <td><b>Tahun Akademik</b></td>
                          <td>:</td>
                          <td><?=$tahun;?></td>
                      </tr>
                      <tr>
                        <td><b>Dosen Pengampu</b></td>
                        <td>:</td>
                        <td><?=$nama;?></td>
                      </tr>
                      <tr>
                        <td><b>Mata Kuliah</b></td>
                        <td>:</td>
                        <td><?=$matkul;?></td>
                      </tr>
                      <tr>
                        <td><b>Tanggal Pengesahan</b></td>
                        <td>:</td>
                        <td><?=$tanggal;?></td>
                      </tr>
                      </tbody>
    </table>
  </div>
  
  <!-- /.lockscreen-item -->

 

<!-- jQuery -->
<script src="../assets_adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets_adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>