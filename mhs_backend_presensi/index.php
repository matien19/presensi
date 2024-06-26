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
  <title>Mahasiswa Panel | Presensi </title>

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
                <h3 class="card-title"><i class="nav-icon fas fa-clipboard"></i> Presensi </h3>
                </div>
                </font>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                      <th style="width:5%">No</th>
                      <th style="width:25%">Mata Kuliah</th>
                      <th>Dosen Pengampu</th>
                      <th><center>Kelas</center></th>
                      <th><center>Presentase</center></th>
                      <th><center>Aksi</center></th>
                    </tr>
                    </thead>
                  <tbody>
                  <?php
                      $no = 1;
                      $aktif = 'A';
                      $nimmhs = $_SESSION['user'];
                      $pertemuan = 16;
                      $hadir = 'Y';
                      $query_periode = mysqli_query($con, "SELECT Id FROM tbl_periode WHERE stat='$aktif'");
                      $data_periode_aktif = mysqli_fetch_assoc($query_periode);
                      $periode_aktif = $data_periode_aktif['Id'];
                      $query = "SELECT * FROM tbl_pesertamatkul WHERE id_periode ='$periode_aktif' AND nim='$nimmhs'";
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
                                  $id_klsmatkul = $data['id_klsmatkul'];
                                   $queryklsmatkul= mysqli_query($con, "SELECT * FROM tbl_klsmatkul WHERE Id ='$id_klsmatkul'");
                                   $datakls=mysqli_fetch_array($queryklsmatkul);
                                   $idmk=$datakls['kode_matkul'];
                                   $querimk = mysqli_query($con, "SELECT * FROM tbl_matkul WHERE kode_matkul='$idmk'");
                                    $datamk= mysqli_fetch_array($querimk);
                                    $kode_mk=$idmk;
                                    $nama_mk=$datamk['nama_ind'];
                                    $nama_mk_eng = $datamk['nama_eng'];
                                    $kelas=$datakls['kelas'];

                                    ?>
                                    <b><?=$kode_mk;?></b>
                                    <br> <?= $nama_mk;?>
                                    <br> <?= $nama_mk_eng;?>
                                   </h6>  
                                  </td>

                                  <td>
                                   <h6>
                                   <?php
                                    $nid = $datakls['nid'];
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
                                    <?php 
                                  $query_hadir = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE nim = $nimmhs AND id_klsmatkul='$id_klsmatkul' AND kehadiran = '$hadir'") or die(mysqli_error($con));
                                  $kehadiran = mysqli_num_rows($query_hadir);
                                  $presentase = ($kehadiran/$pertemuan)*100;
                                  echo $presentase.'%';
                                  ?>
                                  </center>
                                 </td>

                                <td>
                                  <center>
                                    <?php
                                     $state = 'Y';
                                     $query = "SELECT * FROM tbl_temp_presensi WHERE id_klsmatkul ='$id_klsmatkul' AND state='$state'";
                                     $sql_temp = mysqli_query($con, $query) or die (mysqli_error($con));
                                      if (mysqli_num_rows($sql_temp) > 0) { ?>
                                        <a href="presensi.php?id=<?=$id_klsmatkul;?>&nim=<?=$nimmhs;?>" class="btn btn-primary btn-sm">
                                          <i class="fas fa-qrcode"></i>
                                           Presensi 
                                        </a>
                                       
                                        <?php } 
                                      ?>
                                       <a href="histori.php?id_klsmk=<?=$id_klsmatkul;?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                            Histori
                                        </a> 
                                  
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
