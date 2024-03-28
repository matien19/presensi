<?php
require_once "../database/config.php";

                  $id_klsmk = @$_GET['id_klsmk'];
                  $nim = @$_GET['nim'];
                  $hari_ini = date('Y-m-d');
                  $alfa = 'N';

                    mysqli_query($con, "UPDATE tbl_presensi SET kehadiran='$alfa' WHERE id_klsmatkul='$id_klsmk' AND nim='$nim' AND tanggal='$hari_ini'") or die(mysqli_error($con));

                  ?>
