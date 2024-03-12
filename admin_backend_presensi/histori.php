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
                 
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                    <th style="width:5%">No</th>
                    <th><center>Nama Mahasiswa</center></th>
                    <th><center>Presentase Hadir</center></th>
                    <th><center>Aksi</center></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no = 1;
                      if ($no){
                                ?>
                            <tr>
                                 <td>
                                  <?=$no++;?>
                                  </td>

                                 <td>
                                  <center>
                                   <h6>
                                   Nama
                                   </h6>
                                  </center>
                                 </td>
                                 
                                 <td>
                                  <center>
                                   <h6>
                                   presentase
                                   </h6>
                                  </center>
                                 </td>
                                 
                                <td>
                                <center>
                                <a href="histori.php" class="btn btn-warning btn-sm">
                                  <i class="fas fa-edit"></i>
                                   Detail
                                </a> 
                              </center>
                                </td>
                                   
                              </tr>

                            <?php
                        }else
                        {
                          echo "<tr><td colspan=\"4\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
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
