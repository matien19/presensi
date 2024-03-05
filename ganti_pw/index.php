<?php 
require_once '../database/config.php';
$id = $_SESSION['id'];
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
            <div class="card card-primary">
              <div class="card-header"  style="background-color:#86090f">
                <h3 class="card-title">Ganti Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <form class="form-horizontal" action="update.php?id=<?=$id;?>" method="POST" >
                <div class="card-body">
                <div class="form-group">
                    <input type="number" name="id" class="form-control" value="<?=$id;?>" hidden >
                  </div>
                  <div class="form-group">
                    <label for="pass">Password Baru</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukan Password">
                  </div>
                  <div class="form-group">
                    <label for="pass">Konfirmasi Password</label>
                    <input type="password" name="repassword" class="form-control"  placeholder="Masukan Ulang Password">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" >
                  <button type="submit" class="btn btn-primary"  name="ganti_adm" style="background-color:#86090f">Submit</button>
                </div>
              </form>
            </div>
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

<!-- ./wrapper -->

<?php 
include "../script.php";
?>

</body>
</html>
