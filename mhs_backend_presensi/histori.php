<?php 
require_once '../database/config.php';
$hal = 'presensi';
if (isset($_SESSION['peran']))
{
  if ($_SESSION['peran']!='mhs') 
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
  <title>Mahasiswa Panel | Histori presensi </title>

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
include '../sidebar_mhs.php';
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
                 
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr >
                    <th style="width:5%" rowspan="2">No</th>
                    <th rowspan="2"><center>Nama Mahasiswa</center></th>
                    <th colspan="16"><center>Pertemuan</center></th>
                    </tr>
                    <tr>
                                  <td width:3%>
                                  <center>
                                   <h6>
                                   1
                                   </h6>
                                  </center>
                                 </td>
                                <td width:3%>
                                  <center>
                                   <h6>
                                   2
                                   </h6>
                                  </center>
                                 </td>
                                <td width:3%>
                                  <center>
                                   <h6>
                                   3
                                   </h6>
                                  </center>
                                 </td>
                                <td width:3%>
                                  <center>
                                   <h6>
                                   4
                                   </h6>
                                  </center>
                                 </td>
                                <td width:3%>
                                  <center>
                                   <h6>
                                   5
                                   </h6>
                                  </center>
                                 </td>
                                <td width:3%>
                                  <center>
                                   <h6>
                                   6
                                   </h6>
                                  </center>
                                 </td>
                                <td width:3%>
                                  <center>
                                   <h6>
                                   7
                                   </h6>
                                  </center>
                                 </td>
                                <td width:3%>
                                  <center>
                                   <h6>
                                   UTS
                                   </h6>
                                  </center>
                                 </td>
                                <td width:3%>
                                  <center>
                                   <h6>
                                   9
                                   </h6>
                                  </center>
                                 </td>
                                <td width:3%>
                                  <center>
                                   <h6>
                                   10
                                   </h6>
                                  </center>
                                 </td>
                                <td width:3%>
                                  <center>
                                   <h6>
                                   11
                                   </h6>
                                  </center>
                                 </td>
                                <td width:3%>
                                  <center>
                                   <h6>
                                   12
                                   </h6>
                                  </center>
                                 </td>
                                <td width:3%>
                                  <center>
                                   <h6>
                                   13
                                   </h6>
                                  </center>
                                 </td>
                                <td width:3%>
                                  <center>
                                   <h6>
                                   14
                                   </h6>
                                  </center>
                                 </td>
                                <td width:3%>
                                  <center>
                                   <h6>
                                   15
                                   </h6>
                                  </center>
                                 </td>
                                <td width:3%>
                                  <center>
                                   <h6>
                                   UAS
                                   </h6>
                                  </center>
                                 </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no = 1;
                      $id_klsmk = @$_GET['id_klsmk'];
                      $sql_klsmk = mysqli_query($con, "SELECT nim FROM tbl_pesertamatkul WHERE id_klsmatkul = '$id_klsmk'") or die(mysqli_error($con));
                      if (mysqli_num_rows($sql_klsmk) > 0) {
                      while ($data = mysqli_fetch_array($sql_klsmk)) {
                        $nim = $data['nim'];
                        $sql_mhs = mysqli_query($con, "SELECT nama FROM tbl_mahasiswa WHERE nim = '$nim'") or die(mysqli_error($con));
                        $nama_mhs = mysqli_fetch_assoc($sql_mhs);
                        $nama = $nama_mhs['nama'];
                                ?>
                            <tr>
                                 <td>
                                  <?=$no++;?>
                                  </td>

                                 <td>
                                  <center>
                                   <h6>
                                   <?=$nama;?>
                                   </h6>
                                  </center>
                                 </td>
                                 
                                 <?php
                                 $sql_presensi =  mysqli_query($con, "SELECT kehadiran FROM tbl_presensi WHERE id_klsmatkul = '$id_klsmk' AND nim = '$nim'") or die(mysqli_error($con));
                                 $jumlah = mysqli_num_rows($sql_presensi);
                                 $data_kehadiran = mysqli_fetch_array($sql_presensi);
                                 
                                 for ($i=1; $i<=16;$i++) {
                                  $src = '../img/ket/not.png';
                                  if ($i <= $jumlah) {
                                    $absen = $data_kehadiran['kehadiran'];
                                    if ($absen == 'Y') {
                                      $src = '../img/ket/ya.png';
                                    }
                                  } 
                                  echo '<td>
                                  <center>
                                   <h6>
                                   <img src="'.$src.'" alt="absen" width="20px">
                                   </h6>
                                  </center>
                                 </td>';
                                 }
                                 ?>
                                 
                              </tr>

                            <?php
                      }

                        }else
                        {
                          echo "<tr><td colspan=\"18\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
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
