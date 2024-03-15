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
  <title>Admin Panel | Kelas Mata Kuliah </title>

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
                <h3 class="card-title"><i class="nav-icon fas fa-book"></i> Kelas mata Kuliah </h3>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-importkonsolidasi">
                  <i class="nav-icon fas fa-file-excel"></i> Import Data ALL
                </button>
                 <a href="reset.php" class="btn btn-danger" onclick="return confirm('Anda akan menghapus seluruh data kelas mata kuliah?')">
                  <i class="nav-icon fas fa-times"></i> Reset Data
                </a>
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                      <th style="width:5%">No</th>
                      <th style="width:25%">Mata Kuliah</th>
                      <th>Dosen Pengampu</th>
                      <th><center>Kelas</center></th>
                      <th><center>SKS</center></th>
                      <th><center>Jumlah Mahasiswa</center></th>
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
                            while($data = mysqli_fetch_array($sql_klsmatkul))
                            {
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
                                  <center>
                                  </center>
                                 </td>

                                <td>
                                  <center>
                                <a href="klsmatkul.php?id=<?=$data['Id'];?>" class="btn btn-info btn-sm">
                                  <i class="fas fa-edit"></i>
                                   Detail
                                </a>
                                <a href="delete.php?id=<?=$data['Id'];?>"class="btn btn-danger btn-sm" onclick="return confirm('Anda akan menghapus data Kelas Mata Kuliah [ <?=$kode_mk;?> - <?=$nama_mk;?> ] ?')"><i class="fas fa-trash"></i> Hapus</a> 
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

<div class="modal fade" id="modal-tambahdata">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-plus"></i> 
                Tambah Kelas Mata Kuliah
              </font>
              </h5>
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="create.php?id_periode=<?=$periode_aktif;?>" method="POST" >
            <div class="modal-body">
              <div class="form-group">
                <label for="dosen">Dosen</label>
                    </select>
                        <select class="form-control" name="dosen">
                    <?php
                    $sql_dosen =  mysqli_query($con, "SELECT nid, nama FROM tbl_dosen") or die (mysqli_error($con));
                    
                    while($data_dosen = mysqli_fetch_array($sql_dosen)){
                      ?>
                      <option value = "<?=$data_dosen['nid'];?>"><b><?=$data_dosen['nid'];?></b> - <?=$data_dosen['nama'];?></option>
                      <?php
                    }
                    ?>
                    </select>
              </div>
              <div class="form-group">
                <label for="matkul">Mata Kuliah</label>
                    </select>
                        <select class="form-control" name="matkul">
                    <?php
                    $sql_mk =  mysqli_query($con, "SELECT kode_matkul, nama_ind, nama_eng FROM tbl_matkul") or die (mysqli_error($con));
                    
                    while($data_mk = mysqli_fetch_array($sql_mk)){
                      ?>
                      <option value = "<?=$data_mk['kode_matkul'];?>"><b> <?=$data_mk['kode_matkul'];?></b> - [ <?=$data_mk['nama_ind'];?> ]  - [ <?=$data_mk['nama_eng'];?> ]</option>
                      <?php
                    }
                    ?>
                    </select>
              </div>
              <div class="form-group">
                <label for="kelas">Kelas</label>
                <input name="kelas" type="text" id="kelas" size="2" class="form-control" maxlength="2" placeholder="Masukan Kelas" onKeyPress="return goodchars(event,'ABCDEFGHIJKLMNOPQRSTUVWXYZ',this)" required/>
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
    <!-- modal import data mhs -->
<div class="modal fade" id="modal-importkonsolidasi">
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
            <form class="form-horizontal" action="imporkonsol.php" method="POST" id="import" enctype="multipart/form-data"> 
            <div class="modal-body">
              <div class="form-group">
                <label for="Nama">Ambil file Excel</label>
                <input type="file" id="file" name="filekonsol" class="form-control" accept=".xls,.xlsx" required>
                
              </div>
              
              <div class="row">
              <div class="form-group" >
              <center>
              <h6><b>Template Excel</b></h6>
              <a href="download.php?filename=templateklsmk-mhs.xls" class="btn btn-success btn-sm">
                  <i class="nav-icon fas fa-file-excel"></i> Download
                </a>
              </center>
            </div>
            
              </div>
              
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-danger" name="imporkonsolidasi" style="background-color:#86090f"><i class="nav-icon fas fa-file-excel"></i>Import Data</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
</div>
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
            <form class="form-horizontal" action="impor.php?id_periode=<?=$periode_aktif;?>" method="POST" id="import" enctype="multipart/form-data"> 
            <div class="modal-body">
              <div class="form-group">
                <label for="Nama">Ambil file Excel</label>
                <input type="file" id="file" name="file" class="form-control" accept=".xls,.xlsx" required>
              </div>
              
              <div class="row">
              <div class="form-group col-lg-4" >
              <center>
              <h6><b>Template Excel</b></h6>
              <a href="download.php?filename=templateklsmatkul.xls" class="btn btn-success btn-sm">
                  <i class="nav-icon fas fa-file-excel"></i> Download
                </a>
              </center>
            </div>
            <div class="form-group col-lg-4">
            <center>
             <h6><b>Data Dosen</b></h6>
              <a href="expordosen.php" class="btn btn-info btn-sm">
                  <i class="nav-icon fas fa-user-circle"></i> Export
                </a>
                </center>
            </div>
            <div class="form-group col-lg-4">
            <center>
             <h6><b>Data Matkul</b></h6>
              <a href="expormk.php" class="btn btn-warning btn-sm">
                  <i class="nav-icon fas fa-file-excel"></i> Export
                </a>
                </center>
            </div>
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

</div>
<!-- ./wrapper -->
<?php 
include "../script.php";
?>
<script language="javascript">
function getkey(e)
{
if (window.event)
   return window.event.keyCode;
else if (e)
   return e.which;
else
   return null;
}
function goodchars(e, goods, field)
{
var key, keychar;
key = getkey(e);
if (key == null) return true;

keychar = String.fromCharCode(key);
keychar = keychar.toLowerCase();
goods = goods.toLowerCase();

// check goodkeys
if (goods.indexOf(keychar) != -1)
	return true;
// control keys
if ( key==null || key==0 || key==8 || key==9 || key==27 )
   return true;
   
if (key == 13) {
	var i;
	for (i = 0; i < field.form.elements.length; i++)
		if (field == field.form.elements[i])
			break;
	i = (i + 1) % field.form.elements.length;
	field.form.elements[i].focus();
	return false;
	};
// else return false
return false;
}
</script>
</body>
</html>
