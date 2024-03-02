<?php 
require_once '../database/config.php';
$hal = 'periode';
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
  <title>Admin Panel | Dashboard </title>

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
                <h3 class="card-title"><i class="nav-icon fas fa-calendar-alt"></i> Periode Akademik</h3>
                </div>
                </font>
                <!-- /.card-header -->
                <div class="card-body">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tambahperiode" style="background-color:#86090f">
                <i class="nav-icon fas fa-plus"></i>  Tambah Data
                </button>
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Tahun</th>
                      <th>Semester</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                  <tbody>
                  <?php
                      $no = 1;
                      $query = "SELECT * FROM tbl_periode";
                      $sql_periode = mysqli_query($con, $query) or die (mysqli_error($con));
                          if (mysqli_num_rows($sql_periode) > 0)
                          {
                            while($data = mysqli_fetch_array($sql_periode))
                            {
                                ?>
                            <tr>
                                 <td>
                                  <?=$no++;?>
                                  </td>

                                  <td>
                                   <h6>
                                   <?=$data['tahun'];?>
                                   </h6>  
                                  </td>

                                  <td>
                                   <h6>
                                   <?=$data['semester'];?>
                                   </h6>
                                 </td>

                                 <td>
                                  <?php
                                  $stt = $data['status'];
                                  if ($stt=='T')
                                    {
                                     ?>
                                     <center>
                                     <button type="button" class="btn btn-default btn-sm"> 
                                      Tidak Aktif
                                     </button>
                                     </center>
                                     <?php 
                                    }
                                    else
                                    {
                                      ?>
                                    <center>
                                     <button type="button" class="btn btn-success btn-sm"> 
                                      Aktif
                                     </button>
                                     </center>
                                     <?php 
                                    }
                                  ?>
                                 </td>

                                <td>
                                  <?php
                                  if ($stt=='T')
                                    {
                                      $encodeid = sha1($data['Id']);
                                     ?>
                                    <center>
                                      <a href="update.php?id=<?=$encodeid;?>&real=<?=$data['Id'];?>" 
                                      class="btn btn-primary btn-sm" onclick="return confirm('Anda yakin akan mengaktifkan periode [ <?=$data['tahun'];?> - <?=$data['semester'];?> ] ?')"><i class="fas fa-sync"></i> Aktifkan</a> 

                                      <a href="delete.php?id=<?=$encodeid;?>&real=<?=$data['Id'];?>" 
                                      class="btn btn-danger btn-sm" onclick="return confirm('Anda akan menghapus data periode [ <?=$data['tahun'];?> - <?=$data['semester'];?> ] ?')"><i class="fas fa-trash"></i> Hapus</a> 
                                     </center>

                                     <?php 
                                    }
                                    else
                                    {
                                      ?>
                                    <center>
                                      <p>
                                        Tidak Ada Aksi
                                      </p>
                                     </center>

                                     <?php 
                                    }
                                  ?>
                                </td>
                                   
                              </tr>

                            <?php
                          }

                        }
                        else
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

<div class="modal fade" id="modal-tambahperiode">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-plus"></i> 
                Tambah Periode Akademik
              </font>
              </h5>
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="create.php" method="POST" >
            <div class="modal-body">
              <div class="form-group">
                <label for="tahun akademik">Tahun Akademik</label>
                        <select class="form-control" name="tahunakademik">
                          <option>2018</option>
                          <option>2019</option>
                          <option>2020</option>
                          <option>2021</option>
                          <option>2022</option>
                          <option>2023</option>
                          <option>2024</option>
                        </select>
              </div>
              <div class="form-group">
                <label for="tahun akademik">Semester</label>
                        <select class="form-control" name="semester">
                          <option>Ganjil</option>
                          <option>Genap</option>
                        </select>
              </div>
            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-danger" name="tambahdata" style="background-color:#86090f"><i class="nav-icon fas fa-plus"></i>Tambah Data</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
</div>
<!-- ./wrapper -->
<?php 
include "../script.php";
?>
</body>
</html>
