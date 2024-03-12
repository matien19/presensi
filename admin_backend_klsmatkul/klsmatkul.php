<?php 
require_once '../database/config.php';
$hal = 'klsmatkul';
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
  <title>Admin Panel | Tahun Periode </title>

<?php 
include "../linksheet.php";
?>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-cogitllapse
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
                <h3 class="card-title"><i class="nav-icon fas fa-calendar-alt"></i> Detail Kelas Mata kuliah</h3>
                </div>
                </font>
                <!-- /.card-header -->
                <div class="card-body">
                    <?php
                    $id_klsmatkul = @$_GET['id'];
                    $sql_kelasmatkul = mysqli_query($con, "SELECT tbl_periode.tahun as tahun,tbl_periode.semester as semester, tbl_periode.id as id_periode, tbl_dosen.nama as nama_dosen,tbl_matkul.nama_ind as nama_mk_ind,tbl_matkul.nama_eng as nama_mk_eng,tbl_klsmatkul.kelas as kelas FROM tbl_periode,tbl_dosen,tbl_matkul,tbl_klsmatkul WHERE tbl_klsmatkul.id='$id_klsmatkul' AND tbl_klsmatkul.nid = tbl_dosen.nid AND tbl_periode.Id=tbl_klsmatkul.id_periode AND tbl_matkul.kode_matkul=tbl_klsmatkul.kode_matkul") or die (mysqli_error($con));
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
                  <div class="col-lg-6">
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
                      </tbody>
                    </table>
                  </div>

                  <div class="col-lg-6">
                    <table class="table table-bordered table-sm">
                      <tbody>
                      <tr>
                          <td><b>Kelas</b> </td>
                          <td><?=$kelas;?></td>
                      </tr>
                      <tr>
                        <td><b>Kode Jurusan</b></td>
                        <td>isi kode jurusan</td>
                      </tr>
                      <tr>
                        <td><b>Kode Kurikulum</b></td>
                        <td>isi kode Kurikulum</td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
             
                <br>
        <div class="row">
          <div class="col-lg-12">
                <a href="../admin_backend_klsmatkul" class="btn btn-warning">
                  <i class="nav-icon fas fa-chevron-left"></i> kembali
                </a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tambahdata" style="background-color:#86090f">
                <i class="nav-icon fas fa-plus"></i>  Tambah Data
                </button>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-importdata">
                  <i class="nav-icon fas fa-file-excel"></i> Import Data
                </button>
                <a href="resetmhs.php?id=<?= $id_klsmatkul;?>" class="btn btn-danger" onclick="return confirm('Anda akan menghapus seluruh data mahasiswa terdaftar?')">
                  <i class="nav-icon fas fa-times"></i> Reset Data
                </a>
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                      <th style="width:5%">No</th>
                      <th><center>NIM</center></th>
                      <th><center>Nama</center></th>
                      <th><center>Aksi</center></th>
                    </tr>
                    </thead>
                  <tbody>
                  <?php
                      $no = 1;
                      $query_peserta_mk = mysqli_query($con, "SELECT id_klsmatkul, tbl_pesertamatkul.nim, nama FROM tbl_pesertamatkul, tbl_mahasiswa WHERE tbl_pesertamatkul.nim = tbl_mahasiswa.nim AND id_klsmatkul='$id_klsmatkul' ") or die (mysqli_error($con));

                          if (mysqli_num_rows($query_peserta_mk) > 0)
                          {
                            while($data = mysqli_fetch_array($query_peserta_mk))
                            {
                        
                                ?>
                            <tr>
                                 <td>
                                  <?=$no++;?>
                                  </td>

                                  <td>
                                   <h6>
                                   <?=$data['nim'];?>
                                   </h6>  
                                  </td>

                                  <td>
                                   <h6>
                                   <?=$data['nama'];?>
                                   </h6>
                                 </td>

                                <td>
                                     <center>
                                      <a href="deletemhs.php?id=<?= $id_klsmatkul;?>&nim=<?=$data['nim'];?>" 
                                      class="btn btn-danger btn-sm" onclick="return confirm('Anda akan menghapus data mahasiswa [ <?=$data['nama'];?> - <?=$data['nim'];?> ] ?')"><i class="fas fa-trash"></i> Hapus</a> 
                                     </center>
                                </td>
                                   
                              </tr>

                            <?php
                          }

                        }
                        else
                        {
                          echo "<tr><td colspan=\"4\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
                        }

                          ?>
                     </tbody>
                    <tfoot>

                    </tfoot>
                  </table>
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

<div class="modal fade" id="modal-tambahdata">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-plus"></i> 
                Tambah Mahasiswa Kelas Mata Kuliah
              </font>
              </h5>
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="createmhs.php?id=<?=$id_klsmatkul;?>&id_periode=<?=$id_periode;?>" method="POST" >
            <div class="modal-body">
              <div class="form-group">
                <label for="mhs">Pilih Mahasiswa</label>
                <select class="form-control" name="mhs">
                    <?php
                    $sql_mhs =  mysqli_query($con, "SELECT nim, Nama FROM tbl_mahasiswa") or die (mysqli_error($con));
                    while($data_mhs = mysqli_fetch_array($sql_mhs)){
                      ?>
                      <option value = "<?=$data_mhs['nim'];?>"><b><?=$data_mhs['nim'];?></b> - <?=$data_mhs['Nama'];?></option>
                      <?php
                    }
                    ?>
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
      <div class="modal fade" id="modal-importdata">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-file-excel"></i> 
                Import Data Kelas Mata Kuliah
              </font>

              </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="impormhs.php?id_periode=<?=$id_periode;?>" method="POST" id="import" enctype="multipart/form-data"> 
            <div class="modal-body">
              <div class="form-group">
                <label for="Nama">Ambil file Excel</label>
                <input type="file" id="file" name="file" class="form-control" accept=".xls,.xlsx" required>
                <input type="text" id="text" name="id_klsmk" class="form-control" value="<?=$id_klsmatkul;?>" hidden>
              </div>
             <h6>Template Excel</h6>
              <a href="download.php?filename=templatemhskls.xls" class="btn btn-success btn-sm">
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
</body>
</html>
