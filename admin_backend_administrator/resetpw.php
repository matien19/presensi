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
  $id = @$_GET['id'];
  $username = @$_GET['username'];
  $encpass = 'pass'.$username;
  $pass = sha1($encpass);
      mysqli_query($con, "UPDATE tbl_pengguna SET password='$pass' WHERE username='$id'") or die (mysqli_eror($con));

    ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  swal("Berhasil", "Reset Password Data Admin telah berhasil", "success");
  
  setTimeout(function(){ 
   window.location.href = "../admin_backend_administrator";

  }, 1000);
</script> 
</body>
</html>
