<?php 
require_once '../database/config.php';

$hal = 'laporan';
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
  <title>Admin Panel | Grafik </title>

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

<?php
$aktif = 'A';
$hadir = 'Y';
$pertemuan = 16;
$isi_data = array();
$peresn = array();
$query_periode = mysqli_query($con, "SELECT Id FROM tbl_periode WHERE stat='$aktif'");
$data_periode_aktif = mysqli_fetch_assoc($query_periode);
$periode_aktif = $data_periode_aktif['Id'];
$query = "SELECT * FROM tbl_klsmatkul WHERE id_periode ='$periode_aktif'";
$sql_klsmatkul = mysqli_query($con, $query) or die (mysqli_error($con));
if (mysqli_num_rows($sql_klsmatkul) > 0)
{
  while($data = mysqli_fetch_array($sql_klsmatkul)) {
    $id_klsmk = $data['Id'];

    //matkul
    $kelas = $data['kelas'];
    $kode_mk = $data['kode_matkul'];
    $query_mk = mysqli_query($con, "SELECT nama_ind, nama_eng, sks FROM tbl_matkul WHERE kode_matkul ='$kode_mk'");
    $data_mk = mysqli_fetch_assoc($query_mk);
    $nama_mk = $data_mk['nama_ind'];
    $nama_mk_eng = $data_mk['nama_eng'];
    $sks = $data_mk['sks'];

    //dosen
    $nid = $data['nid'];
    $query_dosen = mysqli_query($con, "SELECT nama FROM tbl_dosen WHERE nid ='$nid' ");
    $data_dosen = mysqli_fetch_assoc($query_dosen);
    $nama_dosen = $data_dosen['nama'];

    //presentase
    $query_total_peserta = mysqli_query($con, "SELECT * FROM tbl_pesertamatkul WHERE id_klsmatkul='$id_klsmk' AND id_periode ='$periode_aktif'") or die(mysqli_error($con));
    $total_peserta = mysqli_num_rows($query_total_peserta);
    if ($total_peserta == 0) {
     $presentase = 0;
    } else {
     $total_presensi = $pertemuan*$total_peserta;
     $query_total_hadir = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE id_klsmatkul='$id_klsmk' AND kehadiran = '$hadir'") or die(mysqli_error($con));
     $total_hadir = mysqli_num_rows($query_total_hadir);
    $presentase = ($total_hadir/$total_presensi)*100;

    }
                                  
    $isi_data[] = $nama_mk;

  }
}

$data_js = json_encode($isi_data);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
  <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <!-- Bar chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Bar Chart
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="bar-chart" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
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
<script>
      /*
     * BAR CHART
     * ---------
     */
     var array_js = <?= $data_js; ?>;
    // Membuat array untuk ticks dengan menggunakan array JavaScript yang diperoleh dari PHP
    var ticks = [];
    for (var i = 0; i < array_js.length; i++) {
        // Menambahkan nomor urutan yang dimulai dari 1
        var nomor_urutan = i + 1;
        ticks.push([nomor_urutan, array_js[i]]);
    }
    //  console.log(ticks)

     var bar_data = {
      data : [[1,10], [2,8], [3,4], [4,13], [5,17], [6,9]],
      bars: { show: true }
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
         bars: {
          show: true, barWidth: 0.2, align: 'center',
        },
      },
      colors: ['#3c8dbc'],
      xaxis : {
        ticks: ticks
      }
    })
    /* END BAR CHART */
</script>
</body>
</html>
