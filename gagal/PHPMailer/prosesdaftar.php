<?php 
require_once "../_config/config.php";
require "../assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['insertdata']))
{
  $uuid = Uuid::uuid4()->toString();
  $namadpn = trim(mysqli_real_escape_string($con, $_POST['namadepan']));
  $namabl = trim(mysqli_real_escape_string($con, $_POST['namabelakang']));
  $sebutan = trim(mysqli_real_escape_string($con, $_POST['sebutan']));
  $nama = $sebutan." ".$namadpn." ".$namabl;
  $perusahaan = trim(mysqli_real_escape_string($con, $_POST['perusahaan']));
  $email  = trim(mysqli_real_escape_string($con, $_POST['email']));
  $tgldaftar = trim(mysqli_real_escape_string($con, $_POST['tgl']));
  $alamat = trim(mysqli_real_escape_string($con, $_POST['alamatpos']));
  $nohp = trim(mysqli_real_escape_string($con, $_POST['nomorkontak']));
  $password = sha1(trim(mysqli_real_escape_string($con, $_POST['password'])));
  $status ="Aktif";
  $pelangganluar="PL";

  $passworkirimemail = trim(mysqli_real_escape_string($con, $_POST['password']));

    $cekemail = "SELECT * FROM tbl_pelanggan_eksternal WHERE Username = '$email'";
    $queryemail = mysqli_query($con,$cekemail);

    if(mysqli_num_rows($queryemail) > 0)
    {
     echo "<script>alert('Transaksi Gagal! Email Sudah terdaftar');</script>";
     echo "<script>window.location='daftar.php';</script>";
  
    }
    else
    {
    $query =   mysqli_query($con, "INSERT INTO tbl_pelanggan_eksternal (Id, Nama, Perusahaan, Username, Password, Tgl_Daftar, Alamat, No_Hp, Status, Decryptpass) VALUES 
    ('$uuid', '$nama', '$perusahaan', '$email', '$password', '$tgldaftar' ,'$alamat', '$nohp', '$status', '$passworkirimemail')") or die (mysqli_eror($con));

   $querypl =   mysqli_query($con, "INSERT INTO tb_user (Id, username, password, nama, role, status) VALUES 
    ('$uuid', '$email', '$password', '$nama', '$pelangganluar','$status')") or die (mysqli_eror($con));


   mysqli_query($con, $query);
   mysqli_query($con, $querypl);

    $mail = new PHPMailer(true);
    try {
        //Server settings
     //   $mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'labmipaterpaduuii@gmail.com';                     // SMTP username
        $mail->Password   = 'labterpaduuii2019!';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('labmipaterpaduuii@uii.ac.id', '[UII]-LAB MIPA TERPADU');
        $mail->addAddress($email, $nama);     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = '[AKUN BARU]-NO-REPLY LAB MIPA UII';
        $mail->Body    = '
                          <b>INFORMASI PENDAFTARAN AKUN BARU</b>
                          <p> ======================================================= </p
                          <p>Email / Username : <b>'.$email.'</b></p>
                          <p>Password : <b>'.$passworkirimemail.'</b> </p>
                          <p>Perusahaan : <b>'.$perusahaan.'</b></p>
                          <p>Alamat POS :<b>'.$alamat.'</b></p>
                          <p> ======================================================= </p

                          <p>Mohon disimpan username dan password anda untuk akses ke sistem </p>
                          <p>Hormat Kami,</p> 
                          <p>Manajemen LAB TERPADU UII</p>
                          <p>---------------------------------------------------------</p>
                          ';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
     //   echo 'Message has been sent';
    } catch (Exception $e) {
     //   echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

      echo "<script>alert('Pendaftaran Berhasil! silahkan login menggunakan email dan password yang sudah anda buat, salinan kami kirimkan ke email anda');</script>";
      echo "<script>window.location='login.php';</script>";
    }    

    elseif (isset($_POST['lupadata']))
    {
      
      $email = trim(mysqli_real_escape_string($con, $_POST['email']));

    $cekemail = "SELECT * FROM tbl_pelanggan_eksternal WHERE Username = '$email'";
    $queryemail = mysqli_query($con,$cekemail);

    if(mysqli_num_rows($queryemail) > 0)
    {

      $mail = new PHPMailer(true);
    try {
        //Server settings
     //   $mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'labmipaterpaduuii@gmail.com';                     // SMTP username
        $mail->Password   = 'labterpaduuii2019!';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('labmipaterpaduuii@uii.ac.id', '[UII]-LAB MIPA TERPADU');
        $mail->addAddress($email, $nama);     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = '[AKUN BARU]-NO-REPLY LAB MIPA UII';
        $mail->Body    = '
                          <b>INFORMASI PENDAFTARAN AKUN BARU</b>
                          <p> ======================================================= </p
                          <p>Email / Username : <b>'.$email.'</b></p>
                          <p>Password : <b>'.$passworkirimemail.'</b> </p>
                          <p>Perusahaan : <b>'.$perusahaan.'</b></p>
                          <p>Alamat POS :<b>'.$alamat.'</b></p>
                          <p> ======================================================= </p

                          <p>Mohon disimpan username dan password anda untuk akses ke sistem </p>
                          <p>Hormat Kami,</p> 
                          <p>Manajemen LAB TERPADU UII</p>
                          <p>---------------------------------------------------------</p>
                          ';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
     //   echo 'Message has been sent';
    } catch (Exception $e) {
     //   echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

      echo "<script>alert('salinan Informasi Login Telah kami kirimkan ke email anda, Tunggu beberapa saat anda akan menerima notifikasi via email');</script>";
      echo "<script>window.location='login.php';</script>";
      }    
    }
  }

}
