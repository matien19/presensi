<?php
require_once "../database/config.php";

                  $id_klsmk = @$_GET['id_klsmk'];
                  $nim = @$_GET['nim'];
                  $tanggal = @$_GET['tanggal'];
                  $hadir = 'Y';

                    mysqli_query($con, "UPDATE tbl_presensi SET kehadiran='$hadir' WHERE id_klsmatkul='$id_klsmk' AND nim='$nim' AND tanggal='$tanggal'") or die(mysqli_error($con));

                  ?>