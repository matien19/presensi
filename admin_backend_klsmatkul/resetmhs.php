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
      $id  = @$_GET['id'];
     
        mysqli_query($con, "DELETE FROM tbl_pesertamatkul WHERE id_klsmatkul='$id' ") or die (mysqli_eror($con));
    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Mahasiswa terdaftar telah direset", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_klsmatkul/klsmatkul.php?id=<?=$id;?>";

  }, 1000);
</script> 
</body>
</html>
