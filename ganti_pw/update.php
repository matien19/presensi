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
      
      if (isset($_POST['ganti_pw']))
      {
        $id = @$_GET['id'];
        $passwordlama      = trim(mysqli_real_escape_string($con, $_POST['passwordlama']));
        $enc_passwordlama = SHA1($passwordlama);
        $password      = trim(mysqli_real_escape_string($con, $_POST['password']));
        $repassword   = trim(mysqli_real_escape_string($con, $_POST['repassword']));
        $query_pengguna = mysqli_query($con, "SELECT * FROM tbl_pengguna WHERE Id='$id'") or die (mysqli_eror($con));
        $data = mysqli_fetch_assoc($query_pengguna);
        $passlama_db = $data['password'];

        if ($enc_passwordlama == $passlama_db) {
          if ($password !== $repassword){
            echo '
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("Chek Password", "Password baru harus Sama!", "warning");
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
                window.location.href = "../auth/logout.php";
                }, 2000);
            </script>
            ';
          }          
        } else {
          echo '
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("Password Lama Salah!", "Silahkan hubungi Admin untuk reset Password jika lupa", "warning");
                setTimeout(function(){ 
                window.location.href = "../ganti_pw";
                }, 5000);
            </script>
            ';

        }
        
      }
      
    ?>


</script> 
</body>
</html>