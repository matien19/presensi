<?php 
require_once '../database/config.php';
$hal = 'matkul';
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
                <h3 class="card-title"><i class="nav-icon fas fa-archway"></i> Data Mata Kuliah</h3>
                </div>
                </font>
                <!-- /.card-header -->
                <div class="card-body">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tambahdata" style="background-color:#86090f">
                <i class="nav-icon fas fa-plus"></i>  Tambah Data
                </button>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-importdata">
                  <i class="nav-icon fas fa-file-excel"></i> Import Data
                </button>
                 <a href="reset.php" class="btn btn-danger" onclick="return confirm('Anda akan menghapus seluruh data Mata Kuliah ?')">
                  <i class="nav-icon fas fa-times"></i> Reset Data
                </a>
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                    <th>No</th>
                    <th>Kode Mata Kuliah</th>
                    <th>Nama Indonesia</th>
                    <th><center>Nama Inggris</center></th>
                    <th><center>Aksi</center></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no = 1;
                      $query = "SELECT * FROM tbl_matkul";
                      $sql_matkul = mysqli_query($con, $query) or die (mysqli_error($con));
                          if (mysqli_num_rows($sql_matkul) > 0)
                          {
                            while($data = mysqli_fetch_array($sql_matkul))
                            {
                              $id = $data['Id'];
                                ?>
                            <tr>
                                 <td>
                                  <?=$no++;?>
                                  </td>

                                  <td>
                                   <h6>
                                   <?=$data['kode_matkul'];?>
                                   </h6>  
                                  </td>

                                  <td>
                                   <h6>
                                   <?=$data['nama_ind'];?>
                                   </h6>
                                 </td>
                                  <td>
                                   <h6>
                                   <?=$data['nama_eng'];?>
                                   </h6>
                                 </td>

                               
                                <td>
                                  <center>
                                <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-editdata" data-id="<?=$data['Id'];?>" data-kd_matkul="<?=$data['kode_matkul'];?>" data-nama_ind="<?=$data['nama_ind'];?>" data-nama_eng="<?=$data['nama_eng'];?>">
                                  <i class="fas fa-edit"></i>
                                   Edit 
                                </button> 
                                   
                                <a href="delete.php?id=<?=$data['Id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda akan menghapus data dosen [ <?=$data['kode_matkul'] .' - '. $data['nama_ind']; ?> ] ?')">
                                  <i class="fas fa-trash"></i>
                                   Hapus
                              </a> 
                              </center>
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

<!-- modal tambah data -->
<div class="modal fade" id="modal-tambahdata">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-plus"></i> 
                Tambah Data Mata Kuliah
              </font>
              </h5>
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="create.php" method="POST" >
            <div class="modal-body">
              <div class="form-group">
                <label for="kdmatkul">Kode Mata Kuliah</label>
                <input type="text" name="kd_matkul" class="form-control"  placeholder="Masukan Kode Mata kuliah">
              </div>
              <div class="form-group">
                <label for="Nama">Nama Indonesia</label>
                <input type="text" name="nama_ind" class="form-control" placeholder="Masukan Nama Indonesia">
              </div>
              <div class="form-group">
                <label for="kontak">Nama Inggris</label>
                <input type="text" name="nama_eng" class="form-control" placeholder="Masukan kontak Inggris">
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

<!-- modal edit data mhs -->
<div class="modal fade" id="modal-editdata">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-edit"></i> 
                Edit Data mahasiswa
              </font>

              </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="update.php" method="POST" >
            <div class="modal-body">
            <div class="form-group">
                <input type="text" name="id" class="form-control"  value="<?=$id?>" hidden>
              </div>
            <div class="form-group">
                <label for="kdmatkul">Kode Mata Kuliah</label>
                <input type="text" name="kd_matkul" class="form-control">
              </div>
              <div class="form-group">
                <label for="Nama">Nama Indonesia</label>
                <input type="text" name="nama_ind" class="form-control">
              </div>
              <div class="form-group">
                <label for="kontak">Nama Inggris</label>
                <input type="text" name="nama_eng" class="form-control">
              </div>
            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-danger" name="editdata" style="background-color:#86090f"><i class="nav-icon fas fa-edit"></i>Edit Data</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
      <!-- /.modal -->

      <!-- modal edit data mhs -->
<div class="modal fade" id="modal-importdata">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-file-excel"></i> 
                Import Data mahasiswa
              </font>

              </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="impor.php" method="POST" id="import" enctype="multipart/form-data"> 
            <div class="modal-body">
              <div class="form-group">
                <label for="Nama">Ambil file Excel</label>
                <input type="file" id="file" name="file" class="form-control" accept=".xls,.xlsx" required>
              </div>
             <h6>Template Excel</h6>
              <a href="download.php?filename=templatemhs.xls" class="btn btn-success btn-sm">
                  <i class="nav-icon fas fa-file-excel"></i> Download
                </a>
            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-danger" name="impor" style="background-color:#86090f"><i class="nav-icon fas fa-file-excel"></i>Import Data</button>
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

<script type="text/javascript">
$('#modal-editdata').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
     var id           = $(e.relatedTarget).data('id');
     var kd_matkul         = $(e.relatedTarget).data('kd_matkul');
     var nama_ind      = $(e.relatedTarget).data('nama_ind');
     var nama_eng         = $(e.relatedTarget).data('nama_eng');
     
     $(e.currentTarget).find('input[name="id"]').val(id);
     $(e.currentTarget).find('input[name="kd_matkul"]').val(kd_matkul);
     $(e.currentTarget).find('input[name="nama_ind"]').val(nama_ind);
     $(e.currentTarget).find('input[name="nama_eng"]').val(nama_eng);

});
</script>

</body>
</html>
