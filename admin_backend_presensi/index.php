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
               
              <a href="expordosen.php" class="btn btn-success ">
                  <i class="nav-icon fas fa-file-excel"></i> Export Excel
                </a>
               
              <a href="expormk.php" class="btn btn-danger ">
                  <i class="nav-icon fas fa-file"></i> Export PDF
                </a>
                 
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                    <th>No</th>
                    <th>Dosen</th>
                    <th>Mata Kuliah</th>
                    <th><center>Kelas</center></th>
                    <th><center>Presentase</center></th>
                    <th><center>Aksi</center></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no = 1;
                      $aktif = 'A';
                      $query_periode = mysqli_query($con, "SELECT Id FROM tbl_periode WHERE stat='$aktif'");
                      $data_periode_aktif = mysqli_fetch_assoc($query_periode);
                      $periode_aktif = $data_periode_aktif['Id'];
                      $query = "SELECT * FROM tbl_klsmatkul WHERE id_periode ='$periode_aktif'";
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
                                    $nid = $data['nid'];
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
                                   <h6>
                                   0%
                                   </h6>
                                  </center>
                                 </td>
                                 
                                <td>
                                <center>
                               
                                 
                                <a href="presensi.php?id_klsmk=<?=$data['Id'];?>&dosen=<?=$nid;?>" class="btn btn-primary btn-sm">
                                  <i class="fas fa-qrcode"></i>
                                   QR Absen 
                              </a> 
                                <a href="#" class="btn btn-success btn-sm" >
                                  <i class="fas fa-file-excel"></i>
                                   Export Excel
                              </a> 
                                <a href="#" class="btn btn-danger btn-sm">
                                  <i class="fas fa-file"></i>
                                  Export PDF
                              </a> 
                                <a href="histori.php?id_klsmk=<?=$data['Id'];?>" class="btn btn-warning btn-sm">
                                  <i class="fas fa-edit"></i>
                                   Histori
                              </a> 
                                   
                               
                              </center>
                                </td>
                                   
                              </tr>

                            <?php
                        }

                        }else
                        {
                          echo "<tr><td colspan=\"5\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
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
