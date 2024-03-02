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
    if (isset($_POST['tambahdata']))
    {
      $username     = trim(mysqli_real_escape_string($con, $_POST['username']));
      $usernamefix     = strtolower($username);
      $password   = trim(mysqli_real_escape_string($con, $_POST['password']));
      $repassword   = trim(mysqli_real_escape_string($con, $_POST['repassword']));

      if ($password !== $repassword){
        echo '
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Chek Password", "Password harus Sama!", "warning");
            setTimeout(function(){ 
            window.location.href = "../admin_backend_administrator";
            }, 2000);
        </script>
        ';
      } else
      {
        $pass         = sha1($repassword);
        $nama         = trim(mysqli_real_escape_string($con, $_POST['nama']));
        $peran        = 'Admin';
        
        mysqli_query($con, "INSERT INTO tbl_pengguna VALUES ('','$usernamefix','$pass','$peran','$nama')") or die (mysqli_eror($con));
        
        echo '
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
          swal("Berhasil", "Data Admin telah ditambahkan", "success");
          
          setTimeout(function(){ 
          window.location.href = "../admin_backend_administrator";

          }, 1000);
        </script>
        ';
      }
      
    }
    ?>


</body>
</html>