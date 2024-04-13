<?php 
include_once '../database/config.php';
$hal = 'laporan';
if (isset($_SESSION['peran']))
{
  if ($_SESSION['peran']!='dosen') 
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
  <title>Dosen Panel | Dashboard </title>

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
include '../sidebar_dosen.php';
?>

<?php

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
  <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <!-- Bar chart -->
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Grafik Presensi
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

              <div id="chart_div" style="width: 900px; height: 500px;"></div>
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
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      <?php
      $aktif = 'A';
      $query_periode = mysqli_query($con, "SELECT * FROM tbl_periode WHERE stat='$aktif'") or die(mysqli_error($con));
      $data_periode = mysqli_fetch_assoc($query_periode);
      $id_periode_aktif = $data_periode['Id'];
      $tahun = $data_periode['tahun'];
      $semester = $data_periode['semester']; 
      $bulan_awal = $data_periode['bulan_awal']; 
      $bulan_akhir = $data_periode['bulan_akhir']; 
      $int_bulan_awal = intval($bulan_awal);
      $int_bulan_akhir = intval($bulan_awal);
      $array_bulan = array();
      for($i=1;$i<=6;$i++){
        if($int_bulan_awal>=13){
          $int_bulan_awal-=12;
        }
        $array_bulan[] = $int_bulan_awal;
        $int_bulan_awal++;
        
      }

      $kehadiran = 'Y';
      $tidak_hadir = 'N';
      
      $bulan_1 = str_pad($array_bulan[0], 2, '0', STR_PAD_LEFT);
      $query_hadir_bulan_01 = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE kehadiran='$kehadiran' AND id_periode='$id_periode_aktif' AND bulan='$bulan_1'")or die(mysqli_error($con));
      $jumlah_hadir_bulan_01 = mysqli_num_rows($query_hadir_bulan_01);
      if($jumlah_hadir_bulan_01 == 0){
        $jumlah_hadir_bulan_01 = 0;
      }
      $query_tidak_hadir_bulan_01 = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE kehadiran='$tidak_hadir' AND id_periode='$id_periode_aktif' AND bulan='$bulan_1'")or die(mysqli_error($con));
      $jumlah_tidak_hadir_bulan_01 = mysqli_num_rows($query_tidak_hadir_bulan_01);
      if($jumlah_tidak_hadir_bulan_01 == 0){
        $jumlah_tidak_hadir_bulan_01 = 0;
      }
      $total_absen_bulan_01 = $jumlah_hadir_bulan_01 + $jumlah_tidak_hadir_bulan_01;
      if ($total_absen_bulan_01==0){
        $presentase_hadir_bulan_01 = 0;
        $presentase_tidak_hadir_bulan_01 = 0;
      }else{
        $presentase_hadir_bulan_01 = number_format(($jumlah_hadir_bulan_01/$total_absen_bulan_01)*100,2);
      $presentase_tidak_hadir_bulan_01 = number_format(($jumlah_tidak_hadir_bulan_01/$total_absen_bulan_01)*100,2);
      }
      
      $bulan_2 = str_pad($array_bulan[1], 2, '0', STR_PAD_LEFT);
      $query_hadir_bulan_02 = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE kehadiran='$kehadiran' AND id_periode='$id_periode_aktif' AND bulan='$bulan_2'")or die(mysqli_error($con));
      $jumlah_hadir_bulan_02 = mysqli_num_rows($query_hadir_bulan_02);
      if($jumlah_hadir_bulan_02 == 0){
        $jumlah_hadir_bulan_02 = 0;
      }
      $query_tidak_hadir_bulan_02 = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE kehadiran='$tidak_hadir' AND id_periode='$id_periode_aktif' AND bulan='$bulan_2'")or die(mysqli_error($con));
      $jumlah_tidak_hadir_bulan_02 = mysqli_num_rows($query_tidak_hadir_bulan_02);
      if($jumlah_tidak_hadir_bulan_02 == 0){
        $jumlah_tidak_hadir_bulan_02 = 0;
      }
      $total_absen_bulan_02 = $jumlah_hadir_bulan_02 + $jumlah_tidak_hadir_bulan_02;
      if ($total_absen_bulan_02==0){
        $presentase_hadir_bulan_02 = 0;
        $presentase_tidak_hadir_bulan_02 = 0;
      }else{
        $presentase_hadir_bulan_02 = number_format(($jumlah_hadir_bulan_02/$total_absen_bulan_02)*100,2);
      $presentase_tidak_hadir_bulan_02 = number_format(($jumlah_tidak_hadir_bulan_02/$total_absen_bulan_02)*100,2);
      }
      $bulan_3 = str_pad($array_bulan[2], 2, '0', STR_PAD_LEFT);
      $query_hadir_bulan_03 = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE kehadiran='$kehadiran' AND id_periode='$id_periode_aktif' AND bulan='$bulan_3'")or die(mysqli_error($con));
      $jumlah_hadir_bulan_03 = mysqli_num_rows($query_hadir_bulan_03);
      if($jumlah_hadir_bulan_03 == 0){
        $jumlah_hadir_bulan_03 = 0;
      }
      $query_tidak_hadir_bulan_03 = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE kehadiran='$tidak_hadir' AND id_periode='$id_periode_aktif' AND bulan='$bulan_3'")or die(mysqli_error($con));
      $jumlah_tidak_hadir_bulan_03 = mysqli_num_rows($query_tidak_hadir_bulan_03);
      if($jumlah_tidak_hadir_bulan_03 == 0){
        $jumlah_tidak_hadir_bulan_03 = 0;
      }

      $total_absen_bulan_03 = $jumlah_hadir_bulan_03 + $jumlah_tidak_hadir_bulan_03;
      if ($total_absen_bulan_03==0){
        $presentase_hadir_bulan_03 = 0;
        $presentase_tidak_hadir_bulan_03 = 0;
      }else{
        $presentase_hadir_bulan_03 = number_format(($jumlah_hadir_bulan_03/$total_absen_bulan_03)*100,2);
      $presentase_tidak_hadir_bulan_03 = number_format(($jumlah_tidak_hadir_bulan_03/$total_absen_bulan_03)*100,2);
      }
      
      $bulan_4 = str_pad($array_bulan[3], 2, '0', STR_PAD_LEFT);
      $query_hadir_bulan_04 = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE kehadiran='$kehadiran' AND id_periode='$id_periode_aktif' AND bulan='$bulan_4'")or die(mysqli_error($con));
      $jumlah_hadir_bulan_04 = mysqli_num_rows($query_hadir_bulan_04);
      if($jumlah_hadir_bulan_04 == 0){
        $jumlah_hadir_bulan_04 = 0;
      }
      $query_tidak_hadir_bulan_04 = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE kehadiran='$tidak_hadir' AND id_periode='$id_periode_aktif' AND bulan='$bulan_4'")or die(mysqli_error($con));
      $jumlah_tidak_hadir_bulan_04 = mysqli_num_rows($query_tidak_hadir_bulan_04);
      if($jumlah_tidak_hadir_bulan_04 == 0){
        $jumlah_tidak_hadir_bulan_04 = 0;
      }
      $total_absen_bulan_04 = $jumlah_hadir_bulan_04 + $jumlah_tidak_hadir_bulan_04;
      if ($total_absen_bulan_04==0){
        $presentase_hadir_bulan_04 = 0;
        $presentase_tidak_hadir_bulan_04 = 0;
      }else{
        $presentase_hadir_bulan_04 = number_format(($jumlah_hadir_bulan_04/$total_absen_bulan_04)*100,2);
      $presentase_tidak_hadir_bulan_04 = number_format(($jumlah_tidak_hadir_bulan_04/$total_absen_bulan_04)*100,2);
      }
      
      
      $bulan_5 = str_pad($array_bulan[4], 2, '0', STR_PAD_LEFT);
      $query_hadir_bulan_05 = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE kehadiran='$kehadiran' AND id_periode='$id_periode_aktif' AND bulan='$bulan_5'")or die(mysqli_error($con));
      $jumlah_hadir_bulan_05 = mysqli_num_rows($query_hadir_bulan_05);
      if($jumlah_hadir_bulan_05 == 0){
        $jumlah_hadir_bulan_05 = 0;
      }
      $query_tidak_hadir_bulan_05 = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE kehadiran='$tidak_hadir' AND id_periode='$id_periode_aktif' AND bulan='$bulan_5'")or die(mysqli_error($con));
      $jumlah_tidak_hadir_bulan_05 = mysqli_num_rows($query_tidak_hadir_bulan_05);
      if($jumlah_tidak_hadir_bulan_05 == 0){
        $jumlah_tidak_hadir_bulan_05 = 0;
      }
      $total_absen_bulan_05 = $jumlah_hadir_bulan_05 + $jumlah_tidak_hadir_bulan_05;
      if ($total_absen_bulan_05==0){
        $presentase_hadir_bulan_05 = 0;
        $presentase_tidak_hadir_bulan_05 = 0;
      }else{
        $presentase_hadir_bulan_05 = number_format(($jumlah_hadir_bulan_05/$total_absen_bulan_05)*100,2);
      $presentase_tidak_hadir_bulan_05 = number_format(($jumlah_tidak_hadir_bulan_05/$total_absen_bulan_05)*100,2);
      }
     
      $bulan_6 = str_pad($array_bulan[5], 2, '0', STR_PAD_LEFT);
      $query_hadir_bulan_06 = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE kehadiran='$kehadiran' AND id_periode='$id_periode_aktif' AND bulan='$bulan_6'")or die(mysqli_error($con));
      $jumlah_hadir_bulan_06 = mysqli_num_rows($query_hadir_bulan_06);
      if($jumlah_hadir_bulan_06 == 0){
        $jumlah_hadir_bulan_06 = 0;
      }
      $query_tidak_hadir_bulan_06 = mysqli_query($con, "SELECT * FROM tbl_presensi WHERE kehadiran='$tidak_hadir' AND id_periode='$id_periode_aktif' AND bulan='$bulan_6'")or die(mysqli_error($con));
      $jumlah_tidak_hadir_bulan_06 = mysqli_num_rows($query_tidak_hadir_bulan_06);
      if($jumlah_tidak_hadir_bulan_06 == 0){
        $jumlah_tidak_hadir_bulan_06 = 0;
      }
      $total_absen_bulan_06 = $jumlah_hadir_bulan_06 + $jumlah_tidak_hadir_bulan_06;
      if ($total_absen_bulan_06==0){
        $presentase_hadir_bulan_06 = 0;
        $presentase_tidak_hadir_bulan_06 = 0;
      }else{
        $presentase_hadir_bulan_06 = number_format(($jumlah_hadir_bulan_06/$total_absen_bulan_06)*100,2);
      $presentase_tidak_hadir_bulan_06 = number_format(($jumlah_tidak_hadir_bulan_06/$total_absen_bulan_06)*100,2);
      }

      ?>
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate) 
        var data = google.visualization.arrayToDataTable([
          ['Bulan', 'Kehadiran', 'Ketidak hadiran', 'Rata-rata kehadiran'],
          ['<?=$array_bulan[0];?>',  <?=$presentase_hadir_bulan_01;?>,<?=$presentase_tidak_hadir_bulan_01;?>, <?=$presentase_hadir_bulan_01;?>],
          ['<?=$array_bulan[1];?>',  <?=$presentase_hadir_bulan_02;?>,<?=$presentase_tidak_hadir_bulan_02;?>, <?=$presentase_hadir_bulan_02;?>],
          ['<?=$array_bulan[2];?>',  <?=$presentase_hadir_bulan_03;?>,<?=$presentase_tidak_hadir_bulan_03;?>, <?=$presentase_hadir_bulan_03;?>],
          ['<?=$array_bulan[3];?>',  <?=$presentase_hadir_bulan_04;?>,<?=$presentase_tidak_hadir_bulan_04;?>, <?=$presentase_hadir_bulan_04;?>],
          ['<?=$array_bulan[4];?>',  <?=$presentase_hadir_bulan_05;?>,<?=$presentase_tidak_hadir_bulan_05;?>, <?=$presentase_hadir_bulan_05;?>],
          ['<?=$array_bulan[5];?>',  <?=$presentase_hadir_bulan_06;?>,<?=$presentase_tidak_hadir_bulan_06;?>, <?=$presentase_hadir_bulan_06;?>]
        ]);
<?php 

?>
        var options = { 
          title : 'Grafik Presensi Periode Akademik <?=$tahun .' '. $semester;?>',
          vAxis: {title: 'Persentase Kehadiran'},
          hAxis: {title: 'Bulan'},
          seriesType: 'bars',
          series: {2: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
</body>
</html>
