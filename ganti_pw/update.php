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
      
      if (isset($_POST['ganti_adm']))
      {
        $id = @$_GET['id'];
        $password      = trim(mysqli_real_escape_string($con, $_POST['password']));
        $repassword   = trim(mysqli_real_escape_string($con, $_POST['repassword']));
  
        if ($password !== $repassword){
          echo '
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
          <script>
              swal("Chek Password", "Password harus Sama!", "warning");
              setTimeout(function(){ 
              window.location.href = "../ganti_pw";
              }, 2000);
          </script>
          ';
        } else
        {
          $pass  = sha1($repassword);

          mysqli_query($con, "UPDATE tbl_pengguna SET password='$pass' WHERE Id='$id'") or die (mysqli_eror($con));
          
          echo '
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
          <script>
              swal("Berhasil", "Password berhasil diganti!", "success");
              setTimeout(function(){ 
              window.location.href = "../ganti_pw";
              }, 2000);
          </script>
          ';
        }        
      }
      
    ?>


</script> 
</body>
</html>