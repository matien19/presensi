<?php 
require_once '../database/config.php';
$hal = 'presensi';
$nimMhs = $_SESSION['user'];
function p() {
    $p ='p';
return $p;
}
if (isset($_SESSION['peran']))
{
  if ($_SESSION['peran']!='mhs') 
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
  <title>Mahasiswa Panel | Presensi </title>

<?php 
include "../linksheet.php";
?>
<style>
        #video-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        #video {
            width: 100%;
            height: auto;
            border: 2px solid #333;
        }
        #output {
            margin-top: 10px;
            font-size: 18px;
        }
    </style>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-cogitllapse
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
include '../sidebar_mhs.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background-color:#86090f">
               <font color="ffffff">
                <h3 class="card-title"><i class="nav-icon fas fa-calendar-alt"></i> presensi</h3>
                </div>
                </font>
                <!-- /.card-header -->
                <div class="card-body">
                  <?php
                  $id_klsmatkul = @$_GET['id'];
                  $nimmhs = @$_GET['nim'];
                  echo $id_klsmatkul."--".$nimmhs;
                  
                  ?>
                <div id="video-container">
                <video id="video" playsinline></video>
                    <canvas id="canvas" style="display: none;"></canvas>
                    <div id="output"></div>
                </div>
                <input type="text" id="qrValue" placeholder="Scanned QR Code Value" />
                <script>
                  var previousValue = '';

                  // Start checking for changes every 500 milliseconds
                  setInterval(function() {
                      var inputValue = document.getElementById('qrValue').value;
                      if (inputValue !== previousValue) {
                          // Redirect to the desired page
                          window.location.href = "updateabsen.php?id=<?=$id_klsmatkul;?>&nim=<?=$nimmhs;?>";
                          // Update the previous value
                          previousValue = inputValue;
                      }
                  }, 150);
              </script>
                <button id="startButton">Start Camera</button>
                <input type="text" id="nim" name="nim" value="<?= $nimMhs;?>"/> 
                <audio id="sound" src="sound.mp3" preload="auto"></audio>
                </div>
                <!-- /.card-body -->
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
<script src="https://cdn.jsdelivr.net/npm/jsqr"></script>
    <script>
        const video = document.getElementById('video');
        const canvasElement = document.getElementById('canvas');
        const canvas = canvasElement.getContext('2d');
        const output = document.getElementById('output');
        const qrValueInput = document.getElementById('qrValue');
        const nim = document.getElementById('nim').value;
        const sound = document.getElementById('sound');
        const startButton = document.getElementById('startButton');

        startButton.addEventListener('click', function() {
            startCamera();
        });

        function startCamera() {
            navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
                .then(function(stream) {
                    video.srcObject = stream;
                    video.setAttribute("playsinline", true);
                    video.play();
                    requestAnimationFrame(tick);
                    startButton.style.display = 'none'; // Hide the start button after starting the camera
                })
                .catch(function(err) {
                    console.error("Error accessing the webcam: " + err);
                });
        }

        function tick() {
            if (video.readyState === video.HAVE_ENOUGH_DATA) {
                canvasElement.height = video.videoHeight;
                canvasElement.width = video.videoWidth;
                canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
                const imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
                const code = jsQR(imageData.data, imageData.width, imageData.height, {
                    inversionAttempts: "dontInvert",
                });
                if (code) {
                    output.innerText = code.data;
                    qrValueInput.value = code.data;
                    

                    
                    playSound(); // Play sound when QR code is scanned
                }
            }
            requestAnimationFrame(tick);
        }

        function playSound() {
            sound.currentTime = 0; // Rewind sound to start
            sound.play();
        }
    </script>

</body>
</html>
