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

$nid = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dosen Panel | Kelas Mata Kuliah </title>

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
               
              <a href="expordosen.php" class="btn btn-success ">
                  <i class="nav-icon fas fa-file-excel"></i> Export Excel
                </a>
               
              <a href="eksporpdfall.php?nid=<?= $nid; ?>" class="btn btn-danger" target="_blank" rel="noopener noreferrer">
                  <i class="nav-icon fas fa-file"></i> Export PDF
                </a>
                 
                <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                      <th style="width:5%">No</th>
                      <th style="width:17%">Mata Kuliah</th>
                      <th>Dosen Pengampu</th>
                      <th><center>Kelas</center></th>
                      <th style="width:5%"><center>SKS</center></th>
                      <th><center>Jumlah Mahasiswa</center></th>
                      <th><center>Presentase</center></th>
                      <th><center>Aksi</center></th>
                    </tr>
                    </thead>
                    <tbody>
                   <?php
                      $no = 1;
                      $aktif = 'A';
                      $hadir = 'Y';
                      $pertemuan = 16;
                      $query_periode = mysqli_query($con, "SELECT Id FROM tbl_periode WHERE stat='$aktif'");
                      $data_periode_aktif = mysqli_fetch_assoc($query_periode);
                      $periode_aktif = $data_periode_aktif['Id'];
                      $query = "SELECT * FROM tbl_klsmatkul WHERE id_periode ='$periode_aktif' AND nid='$nid'";
                      $sql_klsmatkul = mysqli_query($con, $query) or die (mysqli_error($con));
                      if (mysqli_num_rows($sql_klsmatkul) > 0)
                      {
                        while($data = mysqli_fetch_array($sql_klsmatkul)) {
                          ?>
                            <tr>
                                 <td>
                                  <?=$no++;?>
                                  </td>

                                  <td>
                                   <h6>
                                    <?php
                                    $kelas = $data['kelas'];
                                    $kode_mk = $data['kode_matkul'];
                                    $query_mk = mysqli_query($con, "SELECT nama_ind, nama_eng, sks FROM tbl_matkul WHERE kode_matkul ='$kode_mk'");
                                    $data_mk = mysqli_fetch_assoc($query_mk);
                                    $nama_mk = $data_mk['nama_ind'];
                                    $nama_mk_eng = $data_mk['nama_eng'];
                                    $sks = $data_mk['sks'];
                                    ?>
                                    <b><?=$kode_mk;?></b>
                                    <br> <?= $nama_mk;?>
                                    <br> <?= $nama_mk_eng;?>
                                   </h6>  
                                  </td>

                                  <td>
                                   <h6>
                                   <?php
                                    $query_dosen = mysqli_query($con, "SELECT nama FROM tbl_dosen WHERE nid ='$nid' ");
                                    $data_dosen = mysqli_fetch_assoc($query_dosen);
                                    $nama_dosen = $data_dosen['nama'];
                                    ?>
                                    <b><?=$nid;?></b>
                                    <br> <?= $nama_dosen;?>
                                   </h6>
                                 </td>

                                 <td>
                                  <center>
                                  <?= $kelas;?>
                                  </center>
                                 </td>
                                 <td>
                                  <center>
                                  <?= $sks;?>
                                  </center>
                                 </td>
                                 <td>
                                  <?php 
                                  $id_klsmk = $data['Id'];
                                  $querycekklsmk = mysqli_query($con, "SELECT COUNT(nim) AS jumlahmhs FROM tbl_pesertamatkul WHERE id_klsmatkul='$id_klsmk'") or die (mysqli_error($con));
                                  $data_jumlah = mysqli_fetch_assoc($querycekklsmk);
                                  $jumlahmhs = $data_jumlah['jumlahmhs'];
                                  echo $jumlahmhs; 
                                                                    
                                  ?>
                                  <td>
                                  <center>
                                   <h6>
                                   <?php 
                                   $query_total_peserta = mysqli_query($con, "SELECT * FROM tbl_pesertamatkul WHERE id_klsmatkul='$id_klsmk' AND id_periode ='$periode_aktif'") or die(mysqli_error($con));
                                   $total_peserta = mysqli_num_rows($query_total_peserta);
                                   $total_presensi = $pertemuan*$total_peserta;
                                   $query_total_hadir = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE id_klsmatkul='$id_klsmk' AND kehadiran = '$hadir'") or die(mysqli_error($con));
                                   $total_hadir = mysqli_num_rows($query_total_hadir);
                                   $presentase = ($total_hadir/$total_presensi)*100;
                                   echo $presentase.'%';
                                   ?>
                                   
                                   </h6>
                                  </center>
                                 </td>
                                  <center>
                                  </center>
                                 </td>

                                <td style="width:45%;">
                                  <center>
                                <a href="presensi.php?id_klsmk=<?=$id_klsmk;?>" class="btn btn-info btn-sm">
                                  <i class="fas fa-qrcode"></i>
                                   Presensi
                                </a>
                                <a href="#" class="btn btn-success btn-sm" >
                                  <i class="fas fa-file-excel"></i>
                                   Export Excel
                                </a> 
                                <a href="eksporpdf.php?id_klsmk=<?= $id_klsmk?>" class="btn btn-danger btn-sm" target="_blank" rel="noopener noreferrer">
                                  <i class="fas fa-file"></i>
                                  Export PDF
                                </a> 
                                <a href="histori.php?id_klsmk=<?=$id_klsmk;?>"class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Histori</a> 
                              </center>
                                </td>
                                   
                              </tr>

                            <?php
                          }

                        }
                        else
                        {
                          echo "<tr><td colspan=\"7\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
                        }

                        ?>
                   </tbody>
                    <tfoot>

                    </tfoot>
                  </table>
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
</body>
</html>
