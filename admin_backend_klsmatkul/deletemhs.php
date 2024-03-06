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
        $id         = @$_GET['id'];
        $nim        = @$_GET['nim'];
        mysqli_query($con, "DELETE FROM tbl_pesertamatkul WHERE nim='$nim' AND id_klsmatkul='$id'") or die (mysqli_eror($con));  
    ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Data Kelas Mata Kuliah telah dihapus", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_klsmatkul/klsmatkul.php?id=<?=$id;?>";

  }, 1000);
</script> 
</body>
</html>
