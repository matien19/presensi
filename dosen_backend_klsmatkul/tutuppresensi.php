

<?php 
require_once "../database/config.php";
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="wrapper" style="zoom:90%" !important>
<?php
      
      $id_klsmatkul = @$_GET['id'];
      $state_on = "Y";
      $state_off = "N";

      mysqli_query($con, "UPDATE tbl_temp_presensi SET state='$state_off' WHERE id_klsmatkul='$id_klsmatkul' AND state='$state_on'") or die (mysqli_error($con));
    ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Presensi Ditutup", "success");
  
  setTimeout(function(){ 
   window.location.href = "../dosen_backend_klsmatkul";

  }, 1500);
</script> 

</body>
</html>
