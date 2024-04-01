<?php 
require_once '../database/config.php';
$hal = 'mahasiswa';
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
  <title>Admin Panel | Mahasiswa </title>

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
                <h3 class="card-title"> <i class="nav-icon fas fa-users"></i> Data Mahasiswa</h3>
                </div>
                </font>
                <!-- /.card-header -->
                <div class="card-body">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tambahmahasiswa" style="background-color:#86090f">
                <i class="nav-icon fas fa-plus"></i>  Tambah Data
                </button>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-importdata">
                  <i class="nav-icon fas fa-file-excel"></i> Import Data
                </button>
                 <a href="reset.php" class="btn btn-danger" onclick="return confirm('Anda akan menghapus seluruh data Mahasiswa?')">
                  <i class="nav-icon fas fa-times"></i> Reset Data
                </a>
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>jurusan</th>
                    <th><center>Kontak</center></th>
                    <th><center>Kelamin</center></th>
                    <th><center>Status</center></th>
                    <th><center>Foto</center></th>
                    <th><center>Aksi</center></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no = 1;
                      $query = "SELECT * FROM tbl_mahasiswa";
                      $sql_periode = mysqli_query($con, $query) or die (mysqli_error($con));
                          if (mysqli_num_rows($sql_periode) > 0)
                          {
                            while($data = mysqli_fetch_array($sql_periode))
                            {
                              $kd_jurusan = $data['kode_jurusan']
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
                                   <h6>
                                   <?php
                                   $query_jurusan = mysqli_query($con, "SELECT nama FROM tbl_jurusan WHERE kode_jurusan='$kd_jurusan'");
                                   if (mysqli_num_rows($query_jurusan) > 0 ) {
                                    while ($data_jurusan = mysqli_fetch_assoc($query_jurusan))
                                    {
                                    $nama_jurusan = $data_jurusan['nama'];
                                    echo $nama_jurusan;
                                    }
                                   
                                  }
                                    
                                   ?>
                                   </h6>
                                 </td>

                                 <td>
                                  <center>
                                   <h6>
                                   
                                   <a href="https://wa.me/<?=$data['nohp'];?>" class="btn btn-success btn-sm" target="blank">
                                   <i class="fas fa-phone"></i> <?=$data['nohp'];?>
                                   </a> 
                                   </h6>
                                  </center>
                                 </td>

                                 <td>
                                  <?php
                                  $stt = $data['kelamin'];
                                  if ($stt=='L')
                                    {
                                     ?>
                                     <center>
                                     <button type="button" class="btn btn-default btn-sm"> 
                                      Laki - Laki
                                     </button>
                                     </center>
                                     <?php 
                                    }
                                    else
                                    {
                                      ?>
                                    <center>
                                     <button type="button" class="btn btn-default btn-sm"> 
                                     Perempuan
                                     </button>
                                     </center>
                                     <?php 
                                    }
                                  ?>
                                 </td>

                              
                                 <td>
                                  <?php
                                  $stt = $data['stat'];
                                  $encodeid = sha1($data['nim']);
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
                                  <center>
                                  <?php 
                                  if (($data['kelamin'] == 'L') && ($data['foto'] == ''))
                                  {
                                    ?>
                                    <button class="btn" style="background-color:transparent"  data-toggle="modal" data-target="#modal-gantifoto" data-nimmhs="<?=$data['nim'];?>" data-fotomhs="template/img/student-lanang.png"  >
                                     <img src="template/img/student-lanang.png" width="32px" height="32px" alt="">
                                    </button> 
                                    <?php 
                                  }
                                  elseif (($data['kelamin'] == 'P') && ($data['foto'] == ''))
                                  {
                                    ?>
                                     <button class="btn" style="background-color:transparent"  data-toggle="modal" data-target="#modal-gantifoto" data-nimmhs="<?=$data['nim'];?>" data-fotomhs="template/img/student-wadon.png"  >
                                     <img src="template/img/student-wadon.png" width="32px" height="32px" alt="">
                                    </button> 
                                    <?php 
                                  }
                                  else 
                                  {
                                    ?>
                                    <button class="btn" style="background-color:transparent"  data-toggle="modal" data-target="#modal-gantifoto" data-nimmhs="<?=$data['nim'];?>" data-fotomhs="<?=$data['foto'];?>"  >
                                    <img src="<?= $data['foto']; ?>" width="32px" height="32px" >
                                </button> 
                                    <?php
                                  }


                                  ?>
                                  </center>
                                 </td>
                                <td>
                                  <center>
                                <a href="resetpw.php?nim=<?= $data['nim']; ?>" class="btn btn-warning btn-sm" onclick="return confirm('Anda akan mereset password Mahasiswa [ <?=$data['nim'] .' - '. $data['nama']; ?> ]?')">
                                  <i class="fas fa-edit"></i>
                                   Reset Password
                              </a> 
                                   <?php 
                                   $kelamin = $data['kelamin'];
                                   $status = $data['stat'];
                                       //inisialisasi kelamin
                                                if ($kelamin == 'L' ) {
                                                  $kelamin2 = 'Laki-laki';
                                                }
                                                else {
                                                  $kelamin2 = 'Perempuan';
                                                }
                                                //inisialisasi status
                                                if ($status == 'A' ) {
                                                  $status2 = 'Aktif';
                                                }
                                                else {
                                                  $status2 = 'Nonaktif';
                                                }

                                   ?>
                                <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-editmahasiswa" data-nim="<?=$data['nim'];?>" data-nama="<?=$data['nama'];?>" data-kelamin="<?=$kelamin2;?>" data-nohp="<?=$data['nohp'];?>" data-status="<?=$status2?>" data-jurusan="<?=$data['kode_jurusan'];?>">
                                  <i class="fas fa-edit"></i>
                                   Edit 
                                </button> 
                                   
                                <a href="delete.php?id=<?=$encodeid;?>&real=<?=$data['nim'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda akan menghapus data Mahasiswa [ <?=$data['nim'] .' - '. $data['nama']; ?> ] ?')">
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
                          echo "<tr><td colspan=\"8\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
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
<div class="modal fade" id="modal-tambahmahasiswa">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-plus"></i> 
                Tambah Data mahasiswa
              </font>
              </h5>
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="create.php" method="POST" >
            <div class="modal-body">
              <div class="form-group">
                <label for="nim">NIM</label>
                <input type="number" name="nim" class="form-control"  placeholder="Masukan NIM">
              </div>
              <div class="form-group">
                <label for="Nama">Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama">
              </div>
              <div class="form-group">
                <label for="kontak">Kontak</label>
                <input type="text" name="kontak" class="form-control" placeholder="Masukan kontak +628xxx">
              </div>
              <div class="form-group">
                <label for="tahun akademik">Kelamin</label>
                        <select class="form-control" name="kelamin">
                          <option>Laki-laki</option>
                          <option>Perempuan</option>
                        </select>
              </div>
              <div class="form-group">
                <label for="tahun akademik">Status</label>
                        <select class="form-control" name="status">
                          <option>Aktif</option>
                          <option>Nonanktif</option>
                        </select>
              </div>
              <div class="form-group">
                <label for="matkul">Jurusan</label>
                    </select>
                        <select class="form-control" name="jurusan">
                    <?php
                    $sql_jurusan =  mysqli_query($con, "SELECT * FROM tbl_jurusan") or die (mysqli_error($con));
                    
                    while($data_jurusan = mysqli_fetch_array($sql_jurusan)){
                      ?>
                      <option value = "<?=$data_jurusan['kode_jurusan'];?>"><b> <?=$data_jurusan['kode_jurusan'];?></b> - [ <?=$data_jurusan['nama'];?> ]</option>
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
</div>
<!-- modal edit data mhs -->
<div class="modal fade" id="modal-editmahasiswa">
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
                <label for="nim">NIM</label>
                <input type="number" name="nim" class="form-control"  placeholder="Masukan NIM" disabled>
                <input type="number" name="nim2" class="form-control"  placeholder="Masukan NIM" hidden >
              </div>
              <div class="form-group">
                <label for="Nama">Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama">
              </div>
              <div class="form-group">
                <label for="kontak">Kontak</label>
                <input type="text" name="kontak" class="form-control" placeholder="Masukan kontak +628xxx">
              </div>
              <div class="form-group">
                <label for="Kelamin">Kelamin</label>
                        <select class="form-control" name="kelamin">
                          <option>Laki-laki</option>
                          <option>Perempuan</option>
                        </select>
              </div>
              <div class="form-group">
                <label for="status">Status</label>
                        <select class="form-control" name="status">
                          <option>Aktif</option>
                          <option>Nonaktif</option>
                        </select>
              </div>
              <div class="form-group">
                <label for="matkul">Jurusan</label>
                    </select>
                        <select class="form-control" name="jurusan">
                    <?php
                    $sql_jurusan =  mysqli_query($con, "SELECT * FROM tbl_jurusan") or die (mysqli_error($con));
                    
                    while($data_jurusan = mysqli_fetch_array($sql_jurusan)){
                      ?>
                      <option value = "<?=$data_jurusan['kode_jurusan'];?>"><b> <?=$data_jurusan['kode_jurusan'];?></b> - [ <?=$data_jurusan['nama'];?> ]</option>
                      <?php
                    }
                    ?>
                    </select>
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

      
          <!-- modal ganti foto mhs -->
<div class="modal fade" id="modal-gantifoto">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#86090f">
              <h5 class="modal-title">
              <font color="ffffff">
              <i class="nav-icon fas fa-image"></i> 
                Ganti Foto
              </font>

              </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="gantifoto.php" method="POST" id="import" enctype="multipart/form-data"> 
            <div class="modal-body">
              
                    <center>
                      <img src="" id="fotomhs" name="fotomhs" width="200px" height="200px"/>
                      </center>
              <div class="form-group">
                <label for="Nama">Ambil file Foto</label>
                <input type="file" id="filefoto" name="filefoto" class="form-control" accept=".png,.jpg" required>
                <input type="text" id="nimmhs" name="nimmhs" class="form-control" hidden>
              </div>


            </div>
            <div class="modal-footer pull-right">
              <button type="submit" class="btn btn-danger" name="gantifoto" style="background-color:#86090f"><i class="nav-icon fas fa-upload"></i>Upload Foto</button>
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
$('#modal-editmahasiswa').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
     var nim          = $(e.relatedTarget).data('nim');
     var nama         = $(e.relatedTarget).data('nama');
     var kelamin      = $(e.relatedTarget).data('kelamin');
     var nohp         = $(e.relatedTarget).data('nohp');
     var status       = $(e.relatedTarget).data('status');
     var jurusan       = $(e.relatedTarget).data('jurusan');
     
     $(e.currentTarget).find('input[name="nim"]').val(nim);
     $(e.currentTarget).find('input[name="nim2"]').val(nim);
     $(e.currentTarget).find('input[name="nama"]').val(nama);
     $(e.currentTarget).find('select[name="kelamin"]').val(kelamin);
     $(e.currentTarget).find('input[name="kontak"]').val(nohp);
     $(e.currentTarget).find('select[name="status"]').val(status);
     $(e.currentTarget).find('select[name="jurusan"]').val(jurusan);

});
</script>

<script type="text/javascript">
$('#modal-gantifoto').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
     var nimmhs          = $(e.relatedTarget).data('nimmhs');
     var fotomhs          = $(e.relatedTarget).data('fotomhs');
     
     $(e.currentTarget).find('input[name="nimmhs"]').val(nimmhs);
     document.getElementById('fotomhs').src = fotomhs;
    
});
</script>


</body>
</html>
